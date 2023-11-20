@extends('front.layout.landing_page')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Landing Page')
@section('content')

<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
      <div id="landingHero" class="section-py landing-hero position-relative">
        <div class="container">
          <div class="hero-text-box text-center">
            <h1 class="text-primary hero-title display-6 fw-bold">One dashboard to manage all your businesses</h1>
            <h2 class="hero-sub-title h6 mb-4 pb-1">
              Production-ready & easy to use Admin Template<br class="d-none d-lg-block" />
              for Reliability and Customizability.
            </h2>
          </div>
          <div id="heroDashboardAnimation" class="hero-animation-img">
            <a href="/asset/vertical-menu-template/app-ecommerce-dashboard.html" target="_blank">
              <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                <img
                  src="/asset/assets/img/front-pages/landing-page/hero-dashboard-light.png"
                  alt="hero dashboard"
                  class="animation-img"
                  data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                  data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                <img
                  src="/asset/assets/img/front-pages/landing-page/hero-elements-light.png"
                  alt="hero elements"
                  class="position-absolute hero-elements-img animation-img top-0 start-0"
                  data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                  data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="landing-hero-blank"></div>
    </section>
</div>

@endsection