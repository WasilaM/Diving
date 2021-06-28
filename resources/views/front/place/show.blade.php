@extends('base.baseUser')

@section('meta-title', $place->title .'|' .__('Place'))
@section('meta-description', Str::limit(strip_tags($place->description), 160))

@section('content')
    <section class="parallax-window" data-parallax="scroll" style="background:url('{{asset($place->banner_url)}}'); background-repeat: no-repeat; background-size: cover;" width="1400" height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{$place->title}}</h1>
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
                    <li><a href="{{route('place.front.index')}}">Place</a>
                    </li>
                    <li>{{$place->title}}</li>
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
                            <h4>{{$place->title}}</h4>
                            <p>
                                {!!$place->description!!}
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