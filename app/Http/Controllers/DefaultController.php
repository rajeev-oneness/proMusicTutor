<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,App\Models\ContactUs;
use App\Models\EmailSubscription,App\Models\Faq,App\Models\User;
use App\Models\Testimonial,App\Models\Instrument,App\Models\Category;
use App\Models\GuitarSeries,App\Models\SubscriptionPlan;

class DefaultController extends Controller
{
    public function welcome(Request $req)
    {
        $data = (object)[];
        $data->faq = Faq::get();
        $data->tutor = User::where('user_type',2)->orderBy('id','ASC')->limit(10)->get();
        $data->testimonial = Testimonial::where('id',1)->get();
        $data->instrument = Instrument::limit(2)->get();
        return view('welcome',compact('data'));
    }

    public function aboutus(Request $req)
    {
        $data = (object)[];
        return view('front.about-us',compact('data'));
    }

    public function contactUsFront(Request $req)
    {
        return view('front.contact-us');
    }

    public function contactUsFrontSave(Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|string|email|max:200',
            'phone' => 'required|numeric',
            'subject' => 'required|string|max:200',
            'description' => 'nullable|string',
        ]);
        $contact = new ContactUs();
            $contact->name = $req->name;
            $contact->email = $req->email;
            $contact->phone = $req->phone;
            $contact->subject = $req->subject;
            $contact->description = emptyCheck($req->description);
        $contact->save();
        $error['success'] = 'Thankyou for contact we will catch you shortly';
        return back()->withErrors($error);
    }

    public function browserGuitar(Request $req)
    {
        $data = (object)[];
        $data->category = Category::get();
        $guitarSeries = GuitarSeries::select('*');
        if(!empty($req->categoryId)){
            $guitarSeries = $guitarSeries->where('categoryId',$req->categoryId);
        }
        $guitarSeries = $guitarSeries->get();
        $data->guitarSeries = $guitarSeries;
        return view('front.guitar.series',compact('data'));
    }

    public function browserGuitarDetails(Request $req,$seriesId)
    {
        $data = GuitarSeries::where('id',$seriesId)->first();
        if($data){
            $data->otherGuitarSeries = GuitarSeries::where('id','!=',$seriesId)->limit(3)->get();
            return view('front.guitar.seriesDetails',compact('data'));    
        }
        return errorResponse('Something went wrong please try after sometime');
    }

    public function subscription(Request $req)
    {
        $data = (object)[];
        $data->subscription = SubscriptionPlan::get();
        return view('front.subscription',compact('data'));
    }

    public function exploreTutor(Request $req,$tutorId = '')
    {
        $tutor = User::where('user_type',2);
        if($tutorId != ''){
            $tutorId = base64_decode($tutorId);
            $tutor = $tutor->where('id',$tutorId);
        }
        $tutor = $tutor->get();
        return response()->json([
            'error' => true,
            'message' => 'This page not created yet',
            'tutor' => $tutor, 
        ]);
        return 'This page not created yet';
    }

    public function subscribeEmail(Request $req)
    {
        $req->validate([
            'email' => 'required|email|string|max:150',
            'agree' => 'nullable|in:1,0',
        ]);
        $email = EmailSubscription::where('email',$req->email)->first();
        if(!$email){
            $email = new EmailSubscription();
            $email->email = $req->email;
            $email->agree = ($req->agree) ? 1 : 0;
        }
        if(auth()->user()){
            $email->createdBy = auth()->user()->id;
        }
        $email->status = 1;
        $email->save();
        $req->session()->put('email_subscribe', '1');
        return back()->with('Success','Email Subscribed Success');
    }

    public function unSubscribeEmail(Request $req)
    {
        $req->validate([
            'email' => 'required|email|string|max:150',
        ]);
        $email = EmailSubscribe::where('email',$req->email)->first();
        if($email){
            $email->delete();
        }
        return successResponse('Email Un-Subscribed Success');
    }

    public function termsAndCondition(Request $req)
    {
        return view('front.policy.terms_condition');
        return response()->json(['error' => true,'message' => 'Something went wrong please try after sometime']);
    }

    public function privacyPolicy(Request $req)
    {
        return view('front.policy.privacyPolicy');
        return response()->json(['error' => true,'message' => 'Something went wrong please try after sometime']);
    }

    public function refundPolicy(Request $req)
    {
        return view('front.policy.refundPolicy');
        return response()->json(['error' => true,'message' => 'Something went wrong please try after sometime']);
    }
}
