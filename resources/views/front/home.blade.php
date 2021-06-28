@extends('base.baseUser')

@section('content')
    @widget('home_banner')

    <section class="section-internat">
        <div class="container ">
            <div class="row">
                @widget('course')
            </div>
        </div>
    </section>

    <section class="section-pattern">
        <div class="container ">
            <div class="row">
                @widget('trip')
            </div>
        </div>
    </section>

    @widget('places')

    <section class="promo_full">
        <div class="promo_full_wp magnific">
            @widget('footer_banner')
        </div>
    </section>

    <div class="container margin_20">
        <div class="row">
            @widget('about_footer')
        </div>
    </div>
@endsection