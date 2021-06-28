<div class="container ">
    <div class="banner colored">
        <h4>{{$setting->data['address'][App::getLocale()]}}</h4>
        <p>
            {!!$setting->data['description'][App::getLocale()]!!}
        </p>
        <a href="{{-- {{asset('{{$setting->data['link'][App::getLocale()]}}')}} --}}" class="btn_1 white">{{$setting->data['linktitle'][App::getLocale()]}}</a>
    </div>
</div>
<div class="white_bg">
    <div class="container margin_20">
        <br>
        <div class="main_title">
            <h2><span>Places</span></h2>
        </div>
        <div class="row list_hotels_tabs">
            @foreach ($places as $place)
                <div class="col-lg-4 col-md-6">
                    <div class="hotel_container">
                        <div class="img_container">
                            <a href="{{route('place.front.show', $place->slug)}}">
                                <img src="{{asset($place->image_url)}}" width="800" height="533" class="img-fluid" alt="Image">
                                <div class="short_info hotel">
                                </div>
                            </a>
                        </div>
                        <div class="hotel_title">
                            <h3><strong>{{$place->title}}</strong></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>