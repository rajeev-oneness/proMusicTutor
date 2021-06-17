<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function aboutus(Request $req)
    {
        return view('front.about-us');
    }

    public function browserGuitar(Request $req)
    {
        return view('front.guitar.series');
    }

    public function browserGuitarDetails(Request $req,$seriesId)
    {
        return view('front.guitar.seriesDetails');
    }

    public function subscription(Request $req)
    {
        return view('front.subscription');
    }
}
