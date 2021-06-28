<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> @yield('title') </title>
  <meta name="description" content="@yield('meta-description')">
  <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Gochi+Hand|Montserrat:300,400,700" rel="stylesheet">
  <link href="{{asset('css-front/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css-front/style.css')}}" rel="stylesheet">
  <link href="{{asset('css-front/vendors.css')}}" rel="stylesheet">
  <link href="{{asset('css-front/custom.css')}}" rel="stylesheet">
  <link href="{{asset('css-front/icomoon/icomoon.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('rev-slider-files/fonts/font-awesome/css/font-awesome.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('rev-slider-files/css/settings.css')}}">
  <style>
  </style>
</head>
<body>
  <div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
      <div class="sk-rect1"></div>
      <div class="sk-rect2"></div>
      <div class="sk-rect3"></div>
      <div class="sk-rect4"></div>
      <div class="sk-rect5"></div>
    </div>
  </div>
  <div class="layer"></div>
    
  @widget('menu')

  <main>
      
    @yield('content')

  </main>
      <footer class="revealed000">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
             
              @widget('contact')

              <div id="social_footer">
                @widget('social_media')
              </div>

            </div>
            <div class="col-lg-4 ">
              <h3>{{__('SITE map')}}</h3>
              <div class="box footer-box box-categories">
                  @widget('menu_footer')
              </div>
            </div>
            <div class="col-md-4">
              <h3>Our Locations</h3>
              <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14101.973416638253!2d34.33363!3d27.917517!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1582213195819!5m2!1sen!2sus" width="100%" height="170" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
          </div>
          <div class="row bottom-footer">
            <div class="col-md-6">
              <p class="text-left">Development &amp; Design by :<a href="http://www.prosmart-it.com/" target="_blank">Prosmart Co</a></p>
            </div>
            <div class="col-md-6">
              <p class="text-right"><a href="#">Gafy Resort.com</a> | © 2020, All rights reserved</p>
            </div>
          </div>
        </div>
      </footer>
      <div id="toTop"></div>
      <div class="search-overlay-menu">
        <span class="search-overlay-close"><i class="icon_set_1_icon-77"></i></span>
        <form role="search" id="searchform" method="get">
          <input value="" name="q" type="search" placeholder="Search..." />
          <button type="submit"><i class="icon_set_1_icon-78"></i>
          </button>
        </form>
      </div>
      <script src="{{asset('js-front/jquery-2.2.4.min.js')}}"></script>
      <script src="{{asset('js-front/common_scripts_min.js')}}"></script>
      <script src="{{asset('js-front/functions.js')}}"></script>
      <script src="{{asset('js-front/jquery.sliderPro.min.js')}}"></script>
      <script type="text/javascript">
        $(document).ready(function ($) {
          $('#Img_carousel').sliderPro({
            width: 960,
            height: 500,
            fade: true,
            arrows: true,
            buttons: false,
            fullScreen: true,
            smallSize: 500,
            startSlide: 0,
            mediumSize: 1000,
            largeSize: 3000,
            thumbnailArrows: true,
            autoplay: false
          });
        });
      </script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/jquery.themepunch.tools.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/jquery.themepunch.revolution.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.actions.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.carousel.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.migration.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.navigation.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.parallax.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('rev-slider-files/js/extensions/revolution.extension.video.min.js')}}"></script>
      <script type="text/javascript">
        var tpj=jQuery;
        var revapi64;
        tpj(document).ready(function() {
          if(tpj("#rev_slider_64_1").revolution == undefined){
            revslider_showDoubleJqueryError("#rev_slider_64_1");
          }else{
            revapi64 = tpj("#rev_slider_64_1").show().revolution({
              sliderType:"standard",
              jsFileLocation:"rev-slider-files/js/",
              sliderLayout:"fullwidth",
              dottedOverlay:"none",
              delay:9000,
              navigation: {
                onHoverStop:"off",
              },
              responsiveLevels:[1240,1024,778,480],
              visibilityLevels:[1240,1024,778,480],
              gridwidth:[1240,1024,778,480],
              gridheight:[520,430,350,380],
              lazyType:"none",
              parallax: {
                type:"scroll",
                origo:"slidercenter",
                speed:2000,
                levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
              },
              shadow:0,
              spinner:"off",
              stopLoop:"on",
              stopAfterLoops:0,
              stopAtSlide:1,
              shuffle:"off",
              autoHeight:"off",
              disableProgressBar:"on",
              hideThumbsOnMobile:"off",
              hideSliderAtLimit:0,
              hideCaptionAtLimit:0,
              hideAllCaptionAtLilmit:0,
              debugMode:false,
              fallbacks: {
                simplifyAll:"off",
                nextSlideOnWindowFocus:"off",
                disableFocusListener:false,
              }
            });
          }
        });	/*ready*/
      </script>
      
    </body>
</html>
