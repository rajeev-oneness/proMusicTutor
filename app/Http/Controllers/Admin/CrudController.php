<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\Difficulty;
use App\Models\AskedQuestion;
use App\Models\TermsAndCondition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request,Hash,DB;
use App\Models\ContactUs,App\Models\Faq;
use App\Models\User,App\Models\UserType;
use App\Models\Instrument,App\Models\Category;
use App\Models\Testimonial,App\Models\Setting;

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
                $user->image = imageUpload($image);
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
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $faq = Faq::find($req->id);
            if($faq){
                $faq->delete();
                return successResponse('Faq rfcd Success');  
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
            'address' => 'required|string|max:200',
            'quote' => 'required',
            'image' => '',
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $req->name;
        $testimonial->quote = $req->quote;
        $testimonial->address = $req->address;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $testimonial->image = imageUpload($image);;
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
            'address' => 'required|string|max:200',
            'quote' => 'required',
            'image' => '',
        ]);
        $testimonial = Testimonial::find($req->testimonialId);
        $testimonial->name = $req->name;
        $testimonial->quote = $req->quote;
        $testimonial->address = $req->address;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $testimonial->image = imageUpload($image);
        }
        $testimonial->save();
        return redirect(route('admin.testimonial'))->with('Success','Testimonial Updated SuccessFully');
    }

    public function deleteTestimonial(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
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
/********************************** Policy Setting ***************************************/
    public function policyData(Request $req)
    {
        $policy = Setting::whereIn('key',['refundPolicy','termsCondition','privacyPolicy'])->get();
        return view('admin.setting.policy.index',compact('policy'));
    }

    public function policyDataEdit(Request $req,$settingId)
    {
        $policy = Setting::where('id',$settingId)->first();
        return view('admin.setting.policy.edit',compact('policy'));
    }

    public function policyDataUpdate(Request $req,$settingId)
    {
        $req->validate([
            'settingId' => 'required|numeric|min:1|in:'.$settingId,
            'heading' => 'required|string|max:200',
            'description' => 'required|string',
            'image' => '',
        ]);
        $setting = Setting::where('id',$req->settingId)->first();
        if($setting){
            $setting->heading = $req->heading;
            $setting->description = $req->description;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $setting->image = imageUpload($image);
            }
            $setting->save();
            return redirect(route('admin.setting.policy'))->with('Success','Policy: '.$req->heading.' Updated SuccessFully');
        }
        return errorResponse('Invalid Setting Detected');
    }

    public function contactUsSetting(Request $req)
    {
        return view('admin.setting.contactusSetting');
    }

    public function contactUsSettingUpdate(Request $req,$contactId)
    {
        $req->validate([
            'contactId' => 'required|min:1|numeric|in:'.$contactId,
            'email' => 'required|email',
            'facebook' => 'required|url',
            'image' => '',
        ]);
        $contact = ContactUs::where('id',$contactId)->first();
        $contact->email = $req->email;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $contact->image = imageUpload($image);
        }
        $contact->facebook = $req->facebook;
        $contact->save();
        return back()->with('Success','Contact us Setting Updated SuccessFully');
    }

    public function aboutUsSetting(Request $req)
    {
        $aboutUs = Setting::where('key','aboutus')->first();
        return view('admin.setting.aboutusSetting',compact('aboutUs'));
    }

    public function aboutUsSettingUpdate(Request $req,$settingId)
    {
        $req->validate([
            'settingId' => 'required|min:1|numeric|in:'.$settingId,
            'heading' => 'required|string|max:200',
            'description' => 'required',
            'description' => 'required',
            'description2' => 'nullable',
            'image' => '',
        ]);
        $aboutUs = Setting::where('id',$settingId)->where('key','aboutus')->first();
        $aboutUs->heading = $req->heading;
        $aboutUs->description = $req->description;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $aboutUs->image = imageUpload($image);
        }
        $aboutUs->description2 = emptyCheck($req->description2);
        $aboutUs->save();
        return back()->with('Success','About us Setting Updated SuccessFully');
    }

    public function howItWorksSetting(Request $req)
    {
        $howitswork = Setting::whereIn('key',['howitworkMain','howitworkChild'])->get();
        return view('admin.setting.howitswork.index',compact('howitswork'));
    }

    public function howItWorksDataEdit(Request $req,$settingId)
    {
        $howitswork = Setting::where('id',$settingId)->first();
        return view('admin.setting.howitswork.edit',compact('howitswork'));
    }

    public function howItWorksSettingUpdate(Request $req,$settingId)
    {
        $req->validate([
            'settingId' => 'required|numeric|min:1|in:'.$settingId,
            'heading' => 'required|string|max:200',
            'description' => 'required|string',
            'image' => '',
        ]);
        $setting = Setting::where('id',$req->settingId)->first();
        if($setting){
            $setting->heading = $req->heading;
            $setting->description = $req->description;
            if($req->hasFile('image')){
                $image = $req->file('image');
                $setting->image = imageUpload($image);
            }
            $setting->save();
            return redirect(route('admin.setting.howitWorks'))->with('Success','How-its-work: '.$req->heading.' Updated SuccessFully');
        }
        return errorResponse('Invalid Setting Detected');
    }
    

    // terms-and-conditions
    public function termsAndConditionsSetting(Request $req)
    {
        $termsAndConditions = TermsAndCondition::get();
        return view('admin.setting.TermsAndConditions.index',compact('termsAndConditions'));
    }

    public function termsAndConditionsDataEdit(Request $req,$termsAndConditionId)
    {
        $termsandCondition = TermsAndCondition::where('id',$termsAndConditionId)->first();
        return view('admin.setting.TermsAndConditions.edit',compact('termsandCondition'));
    }

    public function termsAndConditionsSettingUpdate(Request $req,$settingId)
    {
        $req->validate([
            'settingId' => 'required|numeric|min:1|in:'.$settingId,
            'title' => 'required|string|max:200',
            'description' => 'required|string',
        ]);
        $setting = TermsAndCondition::where('id',$req->settingId)->first();
        if($setting){
            $setting->title = $req->title;
            $setting->description = $req->description;
            $setting->page_cleane_url = $req->page_cleane_url;
            $setting->save();
            return redirect(route('admin.setting.termsandConditions'))->with('Success','Terms & Conditions Updated SuccessFully');
        }
        return errorResponse('Invalid Setting Detected');
    }
/******************************* Instrument ********************************/
    public function instrument(Request $req)
    {
        $instrument = Instrument::get();
        return view('admin.feature.instrument.index',compact('instrument'));
    }

    public function instrumentCreate(Request $req)
    {
        return view('admin.feature.instrument.create');
    }

    public function instrumentStore(Request $req)
    {
        $req->validate([
            'image' => 'required',
            'name' => 'required|string|max:200',
        ]);
        $new = new Instrument();
        $new->name = strtoupper($req->name);
        if($req->hasFile('image')){
            $image = $req->file('image');
            $new->image = imageUpload($image);
        }
        $new->save();
        return redirect(route('admin.instrument'))->with('Success','Instrument Added SuccessFully');
    }

    public function instrumentEdit(Request $req,$instrumentId)
    {
        $instrument = Instrument::where('id',$instrumentId)->first();
        return view('admin.feature.instrument.edit',compact('instrument'));
    }

    public function instrumentUpdate(Request $req,$instrumentId)
    {
        $req->validate([
            'instrumentId' => 'required|min:1|numeric|in:'.$instrumentId,
            'image' => '',
            'name' => 'required|string|max:200',
        ]);
        $update = Instrument::where('id',$instrumentId)->first();
        $update->name = strtoupper($req->name);
        if($req->hasFile('image')){
            $image = $req->file('image');
            $update->image = imageUpload($image);
        }
        $update->save();
        return redirect(route('admin.instrument'))->with('Success','Instrument Updated SuccessFully');
    }

    public function instrumentDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $instrument = Instrument::find($req->id);
            if($instrument){
                $instrument->delete();
                return successResponse('Instrument Deleted Success');  
            }
            return errorResponse('Invalid Instrument Id');
        }
        return errorResponse($validator->errors()->first());
    }

/*********************************** Guitar category ****************************/
    public function guitarCategory(Request $req)
    {
        $category = Category::get();
        return view('admin.feature.guitarCategory.index',compact('category'));
    }

    public function guitarCategoryCreate(Request $req)
    {
        return view('admin.feature.guitarCategory.create');
    }

    public function guitarCategoryStore(Request $req)
    {
        $req->validate([
            'image' => 'required',
            'name' => 'required|string|max:200',
        ]);
        $new = new Category();
        $new->name = strtoupper($req->name);
        $new->video_url = $req->media_link;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $new->image = imageUpload($image);
        }

        $new->save();
        return redirect(route('admin.guitar.category'))->with('Success','Category Added SuccessFully');
    }

    public function guitarCategoryEdit(Request $req,$guitarCategoryId)
    {
        $category = Category::where('id',$guitarCategoryId)->first();
        return view('admin.feature.guitarCategory.edit',compact('category'));
    }

    public function guitarCategoryUpdate(Request $req,$guitarCategoryId)
    {
        $req->validate([
            'categoryId' => 'required|min:1|numeric|in:'.$guitarCategoryId,
            'image' => '',
            'name' => 'required|string|max:200',
            'media_link' => 'nullable|url',
        ]);
        $update = Category::where('id',$guitarCategoryId)->first();
        $update->name = strtoupper($req->name);
        if($req->hasFile('image')){
            $image = $req->file('image');
            $update->image = imageUpload($image);
        }
        $update->video_url = $req->media_link;
        $update->save();
        return redirect(route('admin.guitar.category'))->with('Success','Category Updated SuccessFully');
    }

    public function guitarCategoryDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $category = Category::find($req->id);
            if($category){
                $category->delete();
                return successResponse('Category Deleted Success');  
            }
            return errorResponse('Invalid Category Id');
        }
        return errorResponse($validator->errors()->first());
    }

    // -------------Genre-------------------

    public function genre(Request $req)
    {
        $genre = Genre::get();
        return view('admin.feature.genre.index',compact('genre'));
    }
    public function genreCreate(Request $req)
    {
        $category = Category::get();
        // dd($category);
        $genre = Genre::get();
        return view('admin.feature.genre.create',compact('genre','category'));
    }

    public function genreStore(Request $req)
    {
        // echo 'gghgh';exit;
        $req->validate([
            'name' => 'required|max:200',
            'image' => 'required',
            // 'description' => 'required',
            // 'categoryId' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ]);
        $genre = new Genre();
        // $genre->categoryId = $req->categoryId;
        $genre->category = $req->category;
        $genre->title = $req->name;
        $genre->description = $req->description;
        $genre->status = $req->status;
        $genre->slug = $req->slug;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $genre->image = imageUpload($image,'genre');
        }
        $genre->save();

        return redirect(route('admin.genre.view'))->with('Success','Genre Added SuccessFully');
    }
    public function genreEdit(Request $req,$genreId)
    {
        $category = Category::get();
        $genre = Genre::where('id',$genreId)->first();
        return view('admin.feature.genre.edit',compact('genre','category'));
    }

    public function genreUpdate(Request $req,$guitarCategoryId)
    {
        $req->validate([
            'name' => 'required|max:200',
            'image' => 'nullable',
            // 'description' => 'required',
            // 'categoryId' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ]);
        $update = Genre::where('id',$guitarCategoryId)->first();
        $update->category = $req->category;
        $update->title = $req->name;
        $update->description = $req->description;
        $update->status = $req->status;
        $update->slug = $req->slug;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $update->image = imageUpload($image);
        }
        $update->save();
        return redirect(route('admin.genre.view'))->with('Success','Category Updated SuccessFully');
    }

    public function genreDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $genre = Genre::find($req->id);
            if($genre){
                $genre->delete();
                return successResponse('Genre Deleted Success');  
            }
            return errorResponse('Invalid Genre Id');
        }
        return errorResponse($validator->errors()->first());
    }

    // ---------Difficulty------------//

    public function difficulty(Request $req)
    {
        $difficulty = Difficulty::get();
        return view('admin.feature.difficulty.index',compact('difficulty'));
    }
    public function difficultyCreate(Request $req)
    {
        $category = Category::get();
        // dd($category);
        $difficulty = Difficulty::get();
        return view('admin.feature.difficulty.create',compact('difficulty','category'));
    }

    public function difficultyStore(Request $req)
    {
        // echo 'gghgh';exit;
        $req->validate([
            'name' => 'required|max:200',
            'image' => 'required',
            // 'description' => 'required',
            // 'categoryId' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ]);
        $genre = new Difficulty();
        // $genre->categoryId = $req->categoryId;
        $genre->category = $req->category;
        $genre->title = $req->name;
        $genre->description = $req->description;
        $genre->status = $req->status;
        $genre->slug = $req->slug;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $genre->image = imageUpload($image,'genre');
        }
        $genre->save();

        return redirect(route('admin.difficulty.view'))->with('Success','Difficulty Added SuccessFully');
    }
    public function difficultyEdit(Request $req,$difficultyId)
    {
        $category = Category::get();
        $difficulty = Difficulty::where('id',$difficultyId)->first();
        return view('admin.feature.difficulty.edit',compact('difficulty','category'));
    }

    public function difficultyUpdate(Request $req,$difficultyId)
    {
        $req->validate([
            'name' => 'required|max:200',
            'image' => 'nullable',
            // 'description' => 'required',
            // 'categoryId' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ]);
        $update = Difficulty::where('id',$difficultyId)->first();
        $update->category = $req->category;
        $update->title = $req->name;
        $update->description = $req->description;
        $update->status = $req->status;
        $update->slug = $req->slug;
        if($req->hasFile('image')){
            $image = $req->file('image');
            $update->image = imageUpload($image);
        }
        $update->save();
        return redirect(route('admin.difficulty.view'))->with('Success','Difficulty Updated SuccessFully');
    }

    public function difficultyDelete(Request $req)
    {
        $rules = [
            'id' => 'required|numeric|min:1',
        ];
        $validator = validator()->make($req->all(),$rules);
        if(!$validator->fails()){
            $difficulty = Difficulty::find($req->id);
            if($difficulty){
                $difficulty->delete();
                return successResponse('Difficulty Deleted Success');  
            }
            return errorResponse('Invalid Genre Id');
        }
        return errorResponse($validator->errors()->first());
    }

    /**********************************Asked Questions ***************************************/
    public function questionSetting(Request $req)
    {
        $question = AskedQuestion::get();
        return view('admin.setting.question.index',compact('question'));
    }

    public function questionDataEdit(Request $req,$settingId)
    {
        $question = Setting::where('id',$settingId)->first();
        return view('admin.setting.question.edit',compact('question'));
    }

    // public function questionSettingUpdate(Request $req,$settingId)
    // {
    //     $req->validate([
    //         'settingId' => 'required|numeric|min:1|in:'.$settingId,
    //         'heading' => 'required|string|max:200',
    //         'description' => 'required|string',
    //         'image' => '',
    //     ]);
    //     $setting = Setting::where('id',$req->settingId)->first();
    //     if($setting){
    //         $setting->heading = $req->heading;
    //         $setting->description = $req->description;
    //         if($req->hasFile('image')){
    //             $image = $req->file('image');
    //             $setting->image = imageUpload($image);
    //         }
    //         $setting->save();
    //         return redirect(route('admin.setting.policy'))->with('Success','Policy: '.$req->heading.' Updated SuccessFully');
    //     }
    //     return errorResponse('Invalid Setting Detected');
    // }
}
