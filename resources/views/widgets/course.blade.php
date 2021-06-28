{{-- @php
    dump($data->data['description']['en'])
@endphp --}}
<div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.1s">
    <div class="head-sect">
        <div class="main_title">
            <h2>Diving <span>Courses</span> </h2>
        </div>
        <p>{!!Str::words(strip_tags($data->data['description'][App::getLocale()]), 20)!!}</p>
    </div>
</div>
@foreach ($courses as $course)
    <div class="col-lg-3 col-md-6 wow zoomIn" data-wow-delay="0.2s">
        <div class="hotel_container">
            <div class="img_container">
            <a href="{{route('course.front.show', $course->slug)}}">
                <img src="{{asset($course->image_url)}}" class="img-fluid" alt="image">
                <div class="short_info hotel">
                    <div class="price_list">
                        @if($course->offer)
                            {{-- <del class="price">{{$course->price}}<sup>LE</sup></del>
                            <span class="price">{{$course->offer}}<sup>LE</sup></span> --}}
                            <div>{{$course->offer}}<sup>LE</sup><span class="normal_price_list">{{$course->price}}</span><small>Per person</small>
                            </div>
                        @else
                            <div>{{$course->price}}<sup>LE</sup><small>Per person</small>
                            </div>
                        @endif
                    </div>
                </div>
            </a>
            </div>
            <div class="hotel_title">
            <h3><strong>{{$course->title}}</strong></h3>
            </div>
        </div>
    </div>
@endforeach