@if($about)
    <div class="col-md-4">
        <img src="{{asset($about->image_url)}}" alt="Laptop" class="img-fluid laptop">
    </div>
    <div class="col-md-8">
        <h3><span></span>{{$about->title}}</h3>
        <p>{!!$about->description!!}</p>
    </div>
@endif