<header class="bg-dark-blue">
    <div class="container p-0">
        <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center pt-0 pb-0">
            <a href="#" class="navbar-brand d-flex w-25 mr-auto"><img src="{{asset('design/img/logo.png')}}"></a>
            <div class="navbar-collapse w-100">
                <p class="navbar-nav w-75 justify-content-center d-md-block d-none text-center nav-text">
                    All downloads available in <span>FULL HD </span>or <span>stream</span>
                </p>
                <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link search-icon" href="#"><img src="{{asset('design/img/search_icon.png')}}"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signup-bg" href="#">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link signup-bg login-bg bg-orange" href="#"><i class="fas fa-user mr-1"></i> Login</a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link signup-bg" href="#"><img src="{{asset('design/img/cart_icon.png')}}"></a>
                        <div class="cart-count">
                            2
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link search-icon" id="slide" href="#"><img src="{{asset('design/img/menu_icon.png')}}"> <span class="pl-2">Menu</span></a>
                        <div class="hidden">
                            <div class="menu-section">
                                <div class="menulogo mb-5">
                                    <img src="{{asset('design/img/menu-logo.png')}}" class="w-100">
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active border-right" id="guitar-tab" data-toggle="tab" href="#guitar" role="tab" aria-controls="guitar" aria-selected="true">Guitar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link border-right" id="sax-tab" data-toggle="tab" href="#sax" role="tab" aria-controls="sax" aria-selected="false">Sax</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="blog-tab" data-toggle="tab" href="#blog" role="tab" aria-controls="blog" aria-selected="false">Blog</a>
                                    </li>
                                </ul>
                                <div class="tab-content pt-4" id="myTabContent">
                                    <div class="tab-pane fade show active" id="guitar" role="tabpanel" aria-labelledby="guitar-tab">
                                        <ul class="r_menu_ul">
                                            <li><a href="" class="active">OFFERS</a></li>
                                            <li><a href="">ALL SERIES & PREVIEWS</a></li>
                                            <li><a href="">LATEST SERIES</a></li>
                                            <li><a href="">MEET THE PROS</a></li>
                                            <li><a href="">HOW IT WORKS</a></li>
                                            <li><a href="">SUBSCRIPTIONS</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="sax" role="tabpanel" aria-labelledby="sax-tab">profile tab</div>
                                    <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="blog-tab">contact tab</div>
                                </div>
                                <div class="orange_border"></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header><!--header-part-->