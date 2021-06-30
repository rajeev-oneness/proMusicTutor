@auth
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- <a class="d-xl-none d-lg-none" href="#">Dashboard</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider"> Menu </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('home')?'active':''}}" href="{{route('home')}}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{request()->routeIs('user.profile')?'active':''}}" href="{{route('user.profile')}}"><i class="fa fa-fw fa-user-circle"></i>Profile</a>
                    </li>
                    @if(Auth::user()->user_type != 1)
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('user.points')?'active':''}}" href="{{route('user.points')}}"><i class="fa fa-fw fa-user-circle"></i>Your Points</a>
                        </li>
                    @endif

                    <!-- Admin Sidebar -->
                    @if(Auth::user()->user_type == 1)
                        <!-- <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('admin.users')?'active':''}}" href="{{route('admin.users')}}"><i class="fa fa-fw fa-user-circle"></i>Users</a>
                        </li> -->

                        <!-- Report Section -->
                        <!-- <li class="nav-divider">Report</li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('admin.report.contactus')?'active':''}}" href="{{route('admin.report.contactus')}}"><i class="fa fa-fw fa-user-circle"></i>Contact us</a>
                        </li>

                        <li class="nav-divider">Setting</li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('admin.testimonial')?'active':''}}" href="{{route('admin.testimonial')}}"><i class="fa fa-fw fa-user-circle"></i>Testimonial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{request()->routeIs('admin.faq')?'active':''}}" href="{{route('admin.faq')}}"><i class="fa fa-fw fa-user-circle"></i>Faq</a>
                        </li> -->
                    <!-- Admin Sidebar End -->
                    <!-- Tutor Sidebar -->
                    @elseif(Auth::user()->user_type == 2)
                    <!-- Tutor Sidebar End-->
                    <!-- User Sidebar -->
                    @elseif(Auth::user()->user_type == 3)
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
@endauth