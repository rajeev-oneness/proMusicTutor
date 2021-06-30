<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Hash,DB;
use App\Models\User,App\Models\UserType;
use App\Models\ContactUs,App\Models\Faq;
use App\Models\Testimonial;

class CrudController extends Controller
{
    /****************************** Users ******************************/
    public function getUsers(Request $req)
    {
        $users = User::select('*')->where('user_type','!=',1);
        $users = $users->orderBy('users.id','desc')->get();
        return view('admin.user.index',compact('users'));
    }

    public function manageUser(Request $req)
    {
        $rules = [
            'userId' => 'required|min:1|numeric',
            'action' => 'required|in:block,unblock,delete',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $user = User::find($req->userId);
            if($user){
                if($req->action == 'block'){
                    $user->status = 0;$user->save();
                }elseif($req->action == 'unblock'){
                    $user->status = 1;$user->save();
                }elseif($req->action == 'delete'){
                    $user->delete();
                }
                return successResponse('status Updated Success',$user);
            }
            return errorResponse('Invalid User Id');
        }
        return errorResponse($validator->errors()->first());
    }

    public function createUser(Request $req)
    {
        $userType = UserType::orderBy('id','desc')->get();
        return view('admin.user.create',compact('userType'));
    }

    public function saveUser(Request $req)
    {
        $req->validate([
            'user_type' => 'required|min:1|numeric',
            'image' => '',
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|digits:10|numeric',
            'referral' => 'string|nullable|exists:referrals,code',
        ]);
        DB::beginTransaction();
        try {
            $random = randomGenerator();
            $user = new User();
            $user->user_type = $req->user_type;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->mobile = $req->mobile;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $image->move('upload/users/image/',$random.'.'.$image->getClientOriginalExtension());
                $imageurl = url('upload/users/image/'.$random.'.'.$image->getClientOriginalExtension());
                $user->image = $imageurl;
            }
            $user->password = Hash::make($random);
            $user->save();
            $this->setReferralCode($user,$req->referral);
            DB::commit();
            // sendMail();
            return redirect(route('admin.users'))->with('Success','User Added SuccessFully');
        } catch (Exception $e) {
            DB::rollback();
            $errors['email'] = 'Something went wrong please try after sometime!';
            return back()->withErrors($errors)->withInput($req->all());
        }
    }

/****************************** Contact Us ******************************/
    public function contactUs(Request $req)
    {
        $contactUs = ContactUs::where('id','!=',1)->orderBy('created_at','DESC')->get();
        return view('admin.reports.contact',compact('contactUs'));
    }

    public function saveRemarkOfContactUs(Request $req)
    {
        $req->validate([
            'contactUsId' => 'required|min:1|numeric',
            'remark' => 'required|max:200|string',
        ]);
        $contact = ContactUs::where('id',$req->contactUsId)->first();
        $contact->contactedBy = auth()->user()->id;
        $contact->remarks = $req->remark;
        $contact->save();
        return back()->with('Success','Remarks Saved Success');
    }

/****************************** Referral List ******************************/
    public function getReferredToList(Request $req,$userId)
    {
        $user = User::findorFail($userId);
        return view('admin.referral.referred_to',compact('user'));
    }

/****************************** User List ******************************/
    public function getUserPoints(Request $req,$userId)
    {
        $user = User::findorFail($userId);
        return view('auth.user.point_info',compact('user'));
    }

/****************************** FAQ ******************************/
    public function faq(Request $req)
    {
        $faq = Faq::get();
        return view('admin.setting.faq.index',compact('faq'));
    }

    public function createFaq(Request $req)
    {
        return view('admin.setting.faq.create');
    }

    public function saveFaq(Request $req)
    {
        $req->validate([
            'title' => 'required|max:200',
            'description' => 'required',
        ]);
        $faq = new Faq();
        $faq->title = $req->title;
        $faq->description = $req->description;
        $faq->save();
        return redirect(route('admin.faq'))->with('Success','Faq Added SuccessFully');
    }

    public function editFaq(Request $req, $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.setting.faq.edit',compact('faq'));
    }

    public function updateFaq(Request $req)
    {
        $req->validate([
            'faqId' => 'required|min:1|numeric',
            'title' => 'required|max:200',
            'description' => 'required',
        ]);
        $faq = Faq::find($req->faqId);
        $faq->title = $req->title;
        $faq->description = $req->description;
        $faq->save();
        return redirect(route('admin.faq'))->with('Success','Faq Updated SuccessFully');
    }

    public function deleteFaq(Request $req)
    {
        $rules = [
            'id' => 'required',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $faq = Faq::find($req->id);
            if($faq){
                $faq->delete();
                return successResponse('Faq Deleted Success');  
            }
            return errorResponse('Invalid Faq Id');
        }
        return errorResponse($validator->errors()->first());
    }

/****************************** Testimonials ******************************/
    public function testimonials(Request $req)
    {
        $testimonials = Testimonial::get();
        return view('admin.setting.testimonials.index',compact('testimonials'));
    }

    public function createTestimonial(Request $req)
    {
        return view('admin.setting.testimonials.create');
    }

    public function saveTestimonial(Request $req)
    {
        $req->validate([
            'name' => 'required|max:200',
            'title' => 'required|max:200',
            'designation' => 'required|max:200',
            'quote' => 'required',
            'image' => '',
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $req->name;
        $testimonial->title = $req->title;
        $testimonial->designation = $req->designation;
        $testimonial->quote = $req->quote;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $random = randomGenerator();
            $image->move('upload/admin/testimonial/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('upload/admin/testimonial/'.$random.'.'.$image->getClientOriginalExtension());
            $testimonial->image = $imageurl;
        }
        $testimonial->save();
        return redirect(route('admin.testimonial'))->with('Success','Testimonial Added SuccessFully');
    }

    public function editTestimonial(Request $req, $id)
    {
        $testimonial = Testimonial::where('id',$id)->first();
        return view('admin.setting.testimonials.edit',compact('testimonial'));
    }

    public function updateTestimonial(Request $req)
    {
        $req->validate([
            'testimonialId' => 'required|numeric|min:1',
            'name' => 'required|max:200',
            'title' => 'required|max:200',
            'designation' => 'required|max:200',
            'quote' => 'required',
            'image' => '',
        ]);
        $testimonial = Testimonial::find($req->testimonialId);
        $testimonial->name = $req->name;
        $testimonial->title = $req->title;
        $testimonial->designation = $req->designation;
        $testimonial->quote = $req->quote;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $random = randomGenerator();
            $image->move('upload/admin/testimonial/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('upload/admin/testimonial/'.$random.'.'.$image->getClientOriginalExtension());
            $testimonial->image = $imageurl;
        }
        $testimonial->save();
        return redirect(route('admin.testimonial'))->with('Success','Testimonial Updated SuccessFully');
    }

    public function deleteTestimonial(Request $req)
    {
        $rules = [
            'id' => 'required',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $testimonial = Testimonial::find($req->id);
            if($testimonial){
                $testimonial->delete();
                return successResponse('Testimonial Deleted Success');  
            }
            return errorResponse('Invalid Testimonial Id');
        }
        return errorResponse($validator->errors()->first());
    }
}
