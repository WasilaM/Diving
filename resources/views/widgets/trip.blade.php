<div class="col-lg-6 col-md-6 nopadding tour-block">
    <div class="main_title">
        <h2><span>Offers</span></h2>
    </div>
    <div class="features-tour">
        @foreach ($offers as $offer)  
            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                <div class="row">
                    <div class="col-lg-6 col-md-6 nopadding">
                        <div class="img_list">
                            <a href="{{route('offer.front.trip.show', $offer->slug)}}"><img src="{{asset($offer->image_url)}}" alt="Image">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="tour_list_desc">
                            <h3><strong>{{$offer->title}}</strong></h3>
                            <div class="price_list">
                                <div>{{$offer->offer}}<sup>LE</sup><span class="normal_price_list">{{$offer->price}}</span><small>Per person</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="col-lg-6 col-md-6">
    <div class="main_title">
        <h2><span>Trips</span></h2>
    </div>
    <div class="main_title">
        <h2> <span></span> </h2>
    </div>
    <div class="row">
        @foreach ($trips as $trip)
            <div class="col-lg-6 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="hotel_container">
                    <div class="img_container">
                        <a href="{{route('trip.front.show', $trip->slug)}}">
                            <img src="{{asset($trip->image_url)}}" width="800" height="533" class="img-fluid" alt="image">
                            <div class="short_info hotel">
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
                        </a>
                    </div>
                    <div class="hotel_title">
                        <h3><strong>{{$trip->title}}</strong></h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>    