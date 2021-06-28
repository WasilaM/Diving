@extends('base.baseUser')

@section('meta-title', __('Place'))

@section('content')
    @widget('home_banner')
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route('home.page')}}">Home</a>
                    </li>
                    <li>Place
                    </li>
                </ul>
            </div>
        </div>
        <!-- Position -->

        <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
        </div>
        <!-- End Map -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($places as $place)
                            <div class="col-md-6 wow zoomIn" data-wow-delay="0.1s">
                                <div class="tour_container">
                                    <div class="img_container">
                                        <a href="{{route('place.front.show', $place->slug)}}">
                                            <img src="{{asset($place->image_url)}}" width="800" height="533" class="img-fluid" alt="Image">
                                        </a>
                                    </div>
                                    <div class="tour_title">
                                        <h3><strong>{{$place->title}}</strong></h3>
                                    </div>
                                </div>
                                <!-- End box tour -->
                            </div>    
                        @endforeach
                    </div>

                </div>
                <!-- End col lg 9 -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </main>
@endsection