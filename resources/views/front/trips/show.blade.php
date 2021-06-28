@extends('base.baseUser')

@section('meta-title', $trip->title .'|' .__('Trip'))
@section('meta-description', Str::limit(strip_tags($trip->description), 160))

@section('content')
    <section class="parallax-window" data-parallax="scroll" style="background:url('{{asset($trip->banner_url)}}'); background-repeat: no-repeat; background-size: cover;" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1>{{$trip->title}}</h1>
                        <div class="col-lg-2 col-md-2">
                            <div class="price_list">
                                @if($trip->offer)
                                    <div>{{$trip->offer}}<sup>LE</sup><span class="normal_price_list">{{$trip->price}}</span><small>Per person</small>
                                    </div>
                                @else
                                    <div>{{$trip->price}}<sup>LE</sup><small>Per person</small>
                                    </div>
                                @endif
                            </div>
                        </div>
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
                    <li><a href="{{route('trip.front.index')}}">Trip</a>
                    </li>
                    <li>{{$trip->title}}</li>
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
                    @if($trip->hasMedia('trip'))
                        <div id="Img_carousel" class="slider-pro">
                            <div class="sp-slides">
                                    @foreach ($trip->getMedia('trip') as $key => $media)
                                        <div class="sp-slide">
                                            <img alt="Image" class="sp-image" src="{{asset('images/'.$media->getDiskPath())}}" data-src="{{asset('images/'.$media->getDiskPath())}}">
                                        </div>
                                    @endforeach
                            </div>
                            <div class="sp-thumbnails">
                                    @foreach ($trip->getMedia('trip') as $key => $media)
                                            <img alt="Image" class="sp-thumbnail" src="{{asset('images/'.$media->getDiskPath())}}">
                                    @endforeach
                            </div>
                        </div>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <h3>Description</h3>
                        </div>
                        <div class="col-lg-9">
                            <h4>{{$trip->title}}</h4>
                            <p>
                                {!!$trip->description!!}
                            </p>
                        </div>
                    </div>
                </div>
                <!--End  single_tour_desc-->

                <aside class="col-lg-4">
                    <div class="box_style_1 expose">
                        <h3 class="inner">- Booking -</h3>
                        <form method="POST" action="{{route('bookingTrip', $trip->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-sm-6">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email_booking" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" id="telephone_booking" name="telephone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button class="btn_full">Book now</button>
                        </div>
                        </form>
                    <div class="box_style_4">
                        <i class="icon_set_1_icon-90"></i>
                        <h4><span>Book</span> by phone</h4>
                        <a class="phone">{{$contact->data['mobile']}}</a>
                    </div>
                </aside>
            </div>
            <!--End row -->
        </div>
        <!--End container -->
        
        <div id="overlay"></div>
        <!-- Mask on input focus -->
        
    </main>
@endsection