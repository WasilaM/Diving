<header>
    <div id="top_line">
        <div class="container">
            <div class="row">
                <div class="col-6"><i class="icon-phone"></i><strong>{{$contact->data['mobile']}}</strong> - <i class="icon-mail"></i><strong>{!!Html::email($contact->data['email'])!!}</strong></div>
                <div class="col-6">
                    <ul id="top_links">
                        {{-- <li id="lang_top">
                            <i class="icon-globe-1"></i>
                            <a href="#0">EN</a> - <a href="#0">FR</a> - <a href="#0">DE</a>
                        </li> --}}
                        <li id="social_top">
                            <a href="{{asset($data['facebook'])}}"><i class="icon-facebook"></i></a>
                            <a href="{{asset($data['twitter'])}}"><i class="icon-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div id="logo_home">
                    <h1><a href="index.html" title="MEGALDON">
                        <img alt="MEGALDON" src="{{asset('img/Logo2.png')}}" class="img-fluid">
                    </a></h1>
                </div>
            </div>
            <nav class="col-10">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="{{asset('img/logo_sticky.png')}}" width="160" height="34" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    <ul>
                        <li>
                            <a href="{{route('home.page')}}">Home </a>
                        </li>
                        <li>
                            <a href="{{route('about.front.index')}}">About us </a>
                        </li>
                        <li>
                            <a href="{{route('activity.front.index')}}">Activity</a>
                        </li>
                        <li>
                            <a href="{{route('place.front.index')}}">Places</a>
                        </li>
                        <li>
                            <a href="{{route('course.front.index')}}">Courses</a>
                        </li>
                        <li>
                            <a href="{{route('trip.front.index')}}">Trips</a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Offers <i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="{{route('offer.front.trip.index')}}">Trips</a></li>
                                <li><a href="{{route('offer.front.course.index')}}">Courses</a></li>
                            </ul>
                        </li>
                        {{-- <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Activities <i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="#">Kitesurfing</a></li>
                                <li><a href="#">Windsurfing</a></li>
                                <li><a href="#">Safari</a></li>
                                <li><a href="#">Diving</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li class="submenu">
                            <a href="javascript:void(0);" class="show-submenu">Services <i class="icon-down-open-mini"></i></a>
                            <ul>
                                <li><a href="#">Tour Operators</a></li>
                                <li><a href="#">Airline Ticketing Services</a></li>
                                <li><a href="#">Rail Ticketing Services</a></li>
                                <li><a href="#">Passport & Visa Services</a></li>
                                <li><a href="#">Travel Insurance Services</a></li>
                                <li><a href="#">Cruise Booking</a></li>
                                <li><a href="#">Hotel Booking Services</a></li>
                                <li><a href="#">Car & Coach Rentals</a></li>
                                <li><a href="#">Event Organizers</a></li>
                                <li><a href="#">Service Apartment Booking</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li>
                            <a href="#">Contact us </a>
                        </li> --}}
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>