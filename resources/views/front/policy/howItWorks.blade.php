@extends('layouts.master')
@section('title','How it Works')
@section('content')
    
    <div class="inner-banner">
        <img class="full-image" src="{{asset('design/img/how-it-banner.jpg')}}">
    </div>

    <section class="how-it-works">
        <div class="container">
            <div class="text-center mb-95">
                <h1 class="how-it-heading">How It Works</h1>
                <p>Pro Music Tutor offers a range of high definition music tutoring videos and exceptional quality backing tracks. Our instructional videos feature tutors selected for their reputation and talent with the guitar and with the saxophone.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                    <div class="how-area">
                        <div class="{{asset('design/how-icon text-center')}}">
                            <img src="{{asset('design/img/how-icon-1.png')}}">
                        </div>
                        <div class="how-text text-center">
                            <h3>LOG IN OR SIGN UP</h3>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis</p>
                            <div class="text-right">
                                <a href="javascript:void(0)"><img src="{{asset('design/img/right-arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                    <div class="how-area">
                        <div class="how-icon text-center">
                            <img src="{{asset('design/img/how-icon-2.png')}}" alt="">
                        </div>
                        <div class="how-text text-center">
                            <h3>BECOME A MEMBER</h3>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis</p>
                            <div class="text-right">
                                <a href="javascript:void(0)"><img src="{{asset('design/img/right-arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                    <div class="how-area">
                        <div class="how-icon text-center">
                            <img src="{{asset('design/img/how-icon-3.png')}}" alt="">
                        </div>
                        <div class="how-text text-center">
                            <h3>ENJOY OUR SERVICES</h3>
                            <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis</p>
                            <div class="text-right">
                                <a href="javascript:void(0)"><img src="{{asset('design/img/right-arrow.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
