<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class DefaultController extends Controller
{
    public function welcome(Request $req)
    {
        $data = (object)[];
        $data->faq = Faq::get();
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

    public function subscribeEmail(Request $req)
    {
        dd('here');
        $req->validate([
            'email' => 'required|email|string|max:150',
        ]);
        $email = EmailSubscribe::where('email',$req->email)->first();
        if(!$email){
            $email = new EmailSubscribe();
                $email->email = $req->email;
            $email->save();
        }
        return successResponse('Email Subscribed Success');
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
