@extends('base.baseUser')

@section('meta-title', $activity->title .'|' .__('Activity'))
@section('meta-description', Str::limit(strip_tags($activity->description), 160))

@section('content')
    <section class="parallax-window" data-parallax="scroll" style="background:url('{{asset($activity->banner_url)}}'); background-repeat: no-repeat; background-size: cover;" width="1400" height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <main>
        <div id="position">
            <div class="container">
                <ul>
                    <li><a href="{{route('home.page')}}">Home</a>
                    </li>
                    <li><a href="{{route('activity.front.index')}}">Activity</a>
                    </li>
                    <li>{{$activity->title}}</li>
                </ul>
            </div>
        </div>
        <!-- End Position -->


        <div class="collapse" id="collapseMap">
            <div id="map" class="map"></div>
        </div>
        <!-- End Map -->

        <div class="container margin_60">
            <div class="row">
                <div class="col-lg-8" id="single_tour_desc">
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Description</h3>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{$activity->title}}</h4>
                            <p>
                                {!!$activity->description!!}
                            </p>
                        </div>
                    </div>
                </div>
                <!--End  single_tour_desc-->
            </div>
            <!--End row -->
        </div>
        <!--End container -->
        
        <div id="overlay"></div>
        <!-- Mask on input focus -->
        
    </main>
@endsection