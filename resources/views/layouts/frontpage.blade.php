<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/fa-all.min.css" />
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/swiper-slider.min.css"/>
    <link rel="stylesheet" href="/assets/css/lity.css"/>
    <link rel="stylesheet" href="/assets/css/lightbox.min.css"/>
    <link rel="stylesheet" href="/assets/css/animate.min.css"/>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/custom.css?v<?php echo time(); ?>">

    <title>FLASH MODEL</title>
  </head>
  <header class="header-sticky">
    <div class="container-fluid">
      <div class="row">

        <div class="toppest-bar col-md-12 nocolpadding">
          <div class="row">
            <div class="top-bar-content">
              <ul>
                
                <li>
                  <form class="searchbar centered" method='post' action='{{ route('search') }}'> 
                  @csrf
                    <input type="search" placeholder="{{ __('frontpage.search_by_name') }}" name="kyw" class="searchbar-input" onkeyup="buttonUp();" required> <span class="searchbar-icon"></span> 
                  </form>
                </li>
                <li class="centered">
                @if (app()->getLocale() == "en")
                  <a href="/tr" class="lang">TR</a>
                @else
                  <a href="/en" class="lang">EN</a>
                @endif
                </li>
              </ul>
              
              
            </div>
          </div>
        </div>

        <div class="nav-block col-md-12 nocolpadding">
          <div class="top-bar-left">
            <li><a href="{{ route('models.intown') }}">{{ __('frontpage.header.intown') }}</a></li>
            <li><a href="{{ route('models.women') }}">{{ __('frontpage.header.women') }}</a></li>
            <li><a href="{{ route('models.men') }}">{{ __('frontpage.header.men') }}</a></li>
          </div>
          <div class="top-bar-center">
            <a href="/"><span>FLASH</span>MODEL</a>
          </div>
          <div class="top-bar-right">
            <ul>
              <li><a href="{{ route('models.timeless') }}">{{ __('frontpage.header.timeless') }}</a></li>
              <li><a href="{{ route('news') }}">{{ __('frontpage.header.news') }}</a></li>
              <li><a href="{{ route('contact') }}">{{ __('frontpage.header.contact') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  @yield('content')
  <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="social-icons centered">
            <ul>
              <li><a href="https://www.facebook.com/FlashModelManagement" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="https://www.instagram.com/flashmodelturkey/" target="_blank"><i class="fab fa-instagram"></i></a></li>
              <li><a href="https://twitter.com/Flashmodel" target="_blank"><i class="fab fa-twitter"></i></a></li>
            </ul>
          </div>
          <div class="copyright centered">
            <p>&copy; 2020 FLASH MODELS.</p>
          </div>
        </div>
      </div>
    </footer>
    
<a id="goToTop"></a>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/swiper-slider.min.js"></script>    
    <script src="/assets/js/lity.js"></script>
    <script src="/assets/js/lightbox.min.js"></script>    
    <script src="/assets/js/jquery-lazy.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/custom.js?v=1.0"></script>

    <script>
      $(document).ready(function(){
        var mySwiper = new Swiper('.swiper-container', {
          slidesPerView: 1,
          spaceBetween: 30,
          loop: true,
          observer:true,
          observeParents:true,
          observeSlideChildren: true,
          navigation: {
            nextEl: '.arrow-right',
            prevEl: '.arrow-left',
          },
        });

        $(".nav-link").on("click",function(){ 
          reinitSwiper(mySwiper);
        });

        function reinitSwiper(swiper) {
          setTimeout(function () {
              swiper.update();       
          }, 400);
        }
        $('.scroll-down').click (function() {
          $('html, body').animate({scrollTop: $('section#news').offset().top }, 'slow');
          return false;
        });

      });
    </script>
    
  </body>
</html>