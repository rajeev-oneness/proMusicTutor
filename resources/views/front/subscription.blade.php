@extends('layouts.master')
@section('title','Guitar Series')
@section('content')
    <section class="banner series_details subsscription">
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

    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center title-inner">
                    <h1 class="mb-5">Subscription Plans</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_3.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_4.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_5.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_1.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_6.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-3">
                    <div class="card border-0 bg-light-blue subscribe-card">
                        <img src="{{asset('design/img/guitar_2.png')}}" class="card-img-top">
                        <div class="card-body text-center">
                          <p>Monthly Subscripton - Saxophone</p>
                          <h6>£9.99 <span>/month</span></h6>
                          <ul class="child-subs">
                              <li>Unlimited Streaming HD of all Sax  lessons</li>
                              <li>50% off all downloads</li>
                          </ul>
                        </div>
                        <div class="card-footer border-0 p-0">
                            <a href="#" class="btn buyfull d-block bg-orange">SUBSCRIBE NOW</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>
@endsection