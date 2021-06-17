<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailSubscription,App\Models\Faq,App\Models\User;

class DefaultController extends Controller
{
    public function welcome(Request $req)
    {
        $data = (object)[];
        $data->faq = Faq::get();
        $data->tutor = User::where('user_type',2)->orderBy('id','ASC')->limit(10)->get();
        return view('welcome',compact('data'));
    }

    public function aboutus(Request $req)
    {
        $data = (object)[];
        return view('front.about-us',compact('data'));
    }

    public function browserGuitar(Request $req)
    {
        $data = (object)[];
        return view('front.guitar.series',compact('data'));
    }

    public function browserGuitarDetails(Request $req,$seriesId)
    {
        $data = (object)[];
        return view('front.guitar.seriesDetails',compact('data'));
    }

    public function subscription(Request $req)
    {
        $data = (object)[];
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
}
