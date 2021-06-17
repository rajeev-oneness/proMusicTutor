@extends('layouts.master')
@section('title','Guitar Series')
@section('content')
    <section class="banner series_details">
        <div class="container">
            <div class="row m-0">
                <div class="col-12 col-md-5">
                    <h1>Welcome to <span class="d-block">Pro Music Tutor</span></h1>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <form>
                        <div class="form-group row m-0 mb-4">
                            <label class="col-md-3 col-6 col-form-label">Currencies:</label>
                            <div class="col-md-4 col-6">
                                <select class="form-control">
                                    <option>&pound; - GBP</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group row m-0">
                            <input type="text" class="form-control keyword" placeholder="Enter Keyword...">
                            <div class="input-group-append">
                                <button class="btn viewmore" type="button">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 pt-md-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 shadow-lg p-0 mb-4 mb-md-0">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/137857207" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="row m-0">
                        <h5 class="col-6 pt-2 pl-0 pl-md-3">Acoustic Series 1</h5>
                        <a href="#" class="col-6 col-md-5 ml-auto buyfull">BUY FULL SERIES - £18.99</a>
                    </div>
                    <div class="col-12 pt-4 pl-0 pl-md-3">
                        <h6 class="mb-3">Series Description</h6>
                        <p>
                            Learn from Micky Moody the legendary Whitesnake guitarist. In this series Micky's aim is to pass on some of his Acoustic techniques and explores different tunings. Mickey does not teach you every lick not for note. The aim of this series is to provide you with "building blocks" to experiment with these different tunings. Micky takes you through each piece of music and shows you particular chord progressions, licks, styles and techniques. It is a great way to get an "overview" on different tunings and the make a decision on which ones you like, to be able to take them further.
                        </p>
                    </div>
                </div>
                <div class="col-12 mt-4 p-3 p-md-0">
                    <h6 class="mb-3">Tutor Description</h6>
                    <p>
                        Legendary Whitesnake guitarist Micky Moody has done it all in the world of music, and all guitarists from beginners to those more experienced now have the opportunity to learn from the man himself. Micky shares the secrets behind a variety of playing styles and mastering solo sequences, and even provides you an insight into some of Whitesnake’s biggest hits. Micky Moody is still going strong today with recording and touring, and provides all at Pro Music Tutor with the chance to learn from a living legend.
                    </p>
                </div>
                <div class="row mt-5 m-0 col-12 p-0 pl-3 pl-md-0">
                    <ul class="music-cata ">
                        <li><a href="#" class="active">MICKY MOODY'S VIDEO BIO</a></li>
                        <li><a href="#">HECK OUT MICKY MOODY'S PROFILE </a></li>
                        <li><a href="#">ROCK</a></li>
                        <li><a href="#"> MEDIUM</a></li>
                    </ul>
                </div>
                <div class="row m-0 mt-5 col-12 p-0 pl-3 pl-md-0">
                    <h6>TUTOR: <span class="text_orange">MICKY MOODY</span></h6>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 pb-5 mb-5 bg-light">
        <div class="container">
            <div class="row m-0 mb-5">
                <h5 class="pt-2">LESSONS</h5>
                <a href="#" class="buyfull ml-3 ml-md-5">BUY FULL SERIES - £18.99</a>
            </div>
            <div class="row m-0">
                <div class="card col-12 p-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="{{asset('design/img/guitar_4.png')}}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body position-relative">
                                <h5 class="card-title">Acoustic Series 1 - Lesson 1</h5>
                                <p class="card-text">
                                    During this series you will be taught and directed by the legendary 'Whitesnake' guitarist, Micky Moody. Throughtout the lessons he'll demonstrate valuable riffs, licks and ideas across a number of styles, including; Bluegrass, Blues, slide and will demonstrate some of his own work using unusual tuning methods. He will demonstrate some of the methods he uses and goes into detail as to slide and picking techniques This series is perfect for the seasoned guitarist - so bring your bottleneck, capo and don't worry - you're in good hands with Micky Moody
                                </p>
                                <div class="float-right buynow-btn">
                                    <a href="#" class="buyfull btn">Buy Now - £2.99</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12 p-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="{{asset('design/img/guitar_5.png')}}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body position-relative">
                                <h5 class="card-title">Acoustic Series 1 - Lesson 1</h5>
                                <p class="card-text">
                                    During this series you will be taught and directed by the legendary 'Whitesnake' guitarist, Micky Moody. Throughtout the lessons he'll demonstrate valuable riffs, licks and ideas across a number of styles, including; Bluegrass, Blues, slide and will demonstrate some of his own work using unusual tuning methods. He will demonstrate some of the methods he uses and goes into detail as to slide and picking techniques This series is perfect for the seasoned guitarist - so bring your bottleneck, capo and don't worry - you're in good hands with Micky Moody
                                </p>
                                <div class="float-right buynow-btn">
                                    <a href="#" class="buyfull btn">Buy Now - £2.99</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-12 p-0 mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="{{asset('design/img/guitar_6.png')}}" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body position-relative">
                                <h5 class="card-title">Acoustic Series 1 - Lesson 1</h5>
                                <p class="card-text">
                                    During this series you will be taught and directed by the legendary 'Whitesnake' guitarist, Micky Moody. Throughtout the lessons he'll demonstrate valuable riffs, licks and ideas across a number of styles, including; Bluegrass, Blues, slide and will demonstrate some of his own work using unusual tuning methods. He will demonstrate some of the methods he uses and goes into detail as to slide and picking techniques This series is perfect for the seasoned guitarist - so bring your bottleneck, capo and don't worry - you're in good hands with Micky Moody
                                </p>
                                <div class="float-right buynow-btn">
                                    <a href="#" class="buyfull btn">Buy Now - £2.99</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn viewmore">EXPLORE MORE</a>
            </div>
        </div>
    </section>

    <section class="pt-2 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title-inner">
                    <h1 class="mb-5">Other Series You May Like</h1>
                </div>
            </div>
            <div class="row m-0">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 bg-transparent more-course">
                        <img src="{{asset('design/img/guitar_4.png')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Building The Blues Series 1</h5>
                            <p class="card-text">Learn from Micky Moody the legendary 
                                Whitesnake guitarist. In this series Micky
                                's aim is to pass on ....</p>
                            <a href="#" class="btn buyfull mb-3">BUY FULL SERIES - &pound;18.99</a>
                        </div>
                        <div class="card-footer d-flex border-0 p-0">
                            <a href="#" class="btn detail col-6">Details</a>
                            <a href="#" class="btn preview col-6">PREVIEW</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 bg-transparent more-course">
                        <img src="{{asset('design/img/guitar_5.png')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Building The Blues Series 1</h5>
                            <p class="card-text">Learn from Micky Moody the legendary 
                                Whitesnake guitarist. In this series Micky
                                's aim is to pass on ....</p>
                            <a href="#" class="btn buyfull mb-3">BUY FULL SERIES - &pound;18.99</a>
                        </div>
                        <div class="card-footer d-flex border-0 p-0">
                            <a href="#" class="btn detail col-6">Details</a>
                            <a href="#" class="btn preview col-6">PREVIEW</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border-0 bg-transparent more-course">
                        <img src="{{asset('design/img/guitar_6.png')}}" class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h5 class="card-title">Building The Blues Series 1</h5>
                            <p class="card-text">Learn from Micky Moody the legendary 
                                Whitesnake guitarist. In this series Micky
                                's aim is to pass on ....</p>
                            <a href="#" class="btn buyfull mb-3">BUY FULL SERIES - &pound;18.99</a>
                        </div>
                        <div class="card-footer d-flex border-0 p-0">
                            <a href="#" class="btn detail col-6">Details</a>
                            <a href="#" class="btn preview col-6">PREVIEW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection