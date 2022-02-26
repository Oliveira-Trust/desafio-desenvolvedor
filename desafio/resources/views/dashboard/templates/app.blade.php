@extends('templates.app')

@section('content')
    <section class="body">
        
        @include('dashboard.templates.header')

        <div class="inner-wrapper">
            
            @include('dashboard.templates.sidebar')

            @yield('content-dash')
        </div>

        <aside id="sidebar-right" class="sidebar-right">
            <div class="nano">
                <div class="nano-content">
                    <a href="#" class="mobile-close visible-xs">
                        Collapse <i class="fa fa-chevron-right"></i>
                    </a>

                    <div class="sidebar-right-wrapper">

                        <div class="sidebar-widget widget-calendar">
                            <h6>Upcoming Tasks</h6>
                            <div data-plugin-datepicker data-plugin-skin="dark" ></div>

                            <ul>
                                <li>
                                    <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                    <span>Company Meeting</span>
                                </li>
                            </ul>
                        </div>

                        <div class="sidebar-widget widget-friends">
                            <h6>Friends</h6>
                            <ul>
                                <li class="status-online">
                                    <figure class="profile-picture">
                                        <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-online">
                                    <figure class="profile-picture">
                                        <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-offline">
                                    <figure class="profile-picture">
                                        <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                                <li class="status-offline">
                                    <figure class="profile-picture">
                                        <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                    </figure>
                                    <div class="profile-info">
                                        <span class="name">Joseph Doe Junior</span>
                                        <span class="title">Hey, how are you?</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </aside>
    </section>
@endsection