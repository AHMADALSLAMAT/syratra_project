  <!-- ========== HEADER ========== -->
  <header id="header" class="u-header u-header--dark-nav-links-xl u-header--show-hide-xl u-header--static-xl"
  data-header-fix-moment="500" data-header-fix-effect="slide">
  <div class="u-header__section u-header__shadow-on-show-hide">
      <!-- Topbar -->
      <div
          class="container-fluid u-header__hide-content u-header__topbar u-header__topbar-lg border-bottom border-color-white">
          <div class="d-flex align-items-center">
              <ul class="list-inline u-header__topbar-nav-divider mb-0">
                  <li class="list-inline-item mr-0"><a href="tel:(000)999-898-999"
                          class="u-header__navbar-link">(000) 999 - 898 -999</a></li>
                  <li class="list-inline-item mr-0"><a href="mailto:info@mytravel.com"
                          class="u-header__navbar-link">info@syriatra.com</a></li>
              </ul>
              <div class="ml-auto d-flex align-items-center text-black">
                  <ul class="list-inline mb-0 mr-2 pr-1">
                      <li class="list-inline-item">
                          <a class="btn btn-sm  text-black btn-icon btn-pill btn-soft-white btn-bg-transparent transition-3d-hover"
                              href="https://www.facebook.com/" target="_blank">
                              <span class="fab text-black fa-facebook-f btn-icon__inner"></span>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-sm  text-black btn-icon btn-pill btn-soft-white btn-bg-transparent transition-3d-hover"
                              href="https://twitter.com/" target="_blank">
                              <span class="fab text-black fa-twitter btn-icon__inner"></span>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-sm  text-black btn-icon btn-pill btn-soft-white btn-bg-transparent transition-3d-hover"
                              href="https://www.instagram.com/" target="_blank">
                              <span class="fab text-black fa-instagram btn-icon__inner"></span>
                          </a>
                      </li>
                      <li class="list-inline-item">
                          <a class="btn btn-sm  text-black btn-icon btn-pill btn-soft-white btn-bg-transparent transition-3d-hover"
                              href="https://www.linkedin.com/" target="_blank">
                              <span class="fab text-black fa-linkedin-in btn-icon__inner"></span>
                          </a>
                      </li>
                  </ul>
                  @auth
                  <div
                      class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                      <a id="signUpDropdownInvoker" href="#"
                          class="d-flex align-items-center text-white py-3" aria-controls="signUpDropdown"
                          aria-haspopup="true" aria-expanded="true" data-unfold-event="click"
                          data-unfold-target="#signUpDropdown" data-unfold-type="css-animation"
                          data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                          data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                          <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                          <span class="d-inline-block font-size-14 mr-1">Welecome {{ auth()->user()->name }}</span>
                      </a>
                  </div>
                  <div
                      class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                      <a href="{{ route('userlogout') }}"
                          class="d-flex align-items-center text-white py-3" >
                          <i class="fas fa-power-off mr-2 ml-1 font-size-18"></i>
                          <span class="d-inline-block font-size-14 mr-1">Logout</span>
                      </a>
                  </div>
                      @else
                      <div
                          class="position-relative px-3 u-header__login-form dropdown-connector-xl u-header__topbar-divider">
                          <a id="signUpDropdownInvoker" href="{{ route('front.login') }}"
                              class="d-flex align-items-center text-white py-3" aria-controls="signUpDropdown"
                              aria-haspopup="true" aria-expanded="true" data-unfold-event="click"
                              data-unfold-target="#signUpDropdown" data-unfold-type="css-animation"
                              data-unfold-duration="300" data-unfold-delay="300" data-unfold-hide-on-scroll="true"
                              data-unfold-animation-in="slideInUp" data-unfold-animation-out="fadeOut">
                              <i class="flaticon-user mr-2 ml-1 font-size-18"></i>
                              <span class="d-inline-block font-size-14 mr-1">Sign in or Register</span>
                          </a>
                      </div>
                  @endauth
              </div>
          </div>
      </div>
      <!-- End Topbar -->
      <div id="logoAndNav" class="container-fluid py-1 py-xl-0">
          <!-- Nav -->
          <nav class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space">
              <!-- My Account -->
              <a href="../others/about.html" class="text-white d-xl-none font-size-20 scroll-icon">
                  <i class="flaticon-user"></i>
              </a>
              <!-- End My Account -->

              <!-- Logo -->
              <a class="navbar-brand u-header__navbar-brand-default u-header__navbar-brand-center u-header__navbar-brand-text-white mr-0 mr-xl-5"
                  href="{{ route('homepage') }}" aria-label="MyTravel">
                  <img src="{{ asset('front_assest/assets/logo_white.png') }}" alt="" srcset="" width="200px">
              </a>
              <!-- End Logo -->

              <!-- Scroll Logo -->
              <a class="navbar-brand u-header__navbar-brand u-header__navbar-brand-center u-header__navbar-brand-on-scroll"
                  href="{{ route('homepage') }}" aria-label="MyTravel">
                  <img src="{{ asset('front_assest/assets/logo_color.png') }}" alt="" srcset="" style="width:220px">
              </a>
              <!-- End Scroll Logo -->

              <!-- Responsive Toggle Button -->
              <button type="button" class="navbar-toggler btn u-hamburger u-hamburger--white order-2 ml-3"
                  aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar"
                  data-toggle="collapse" data-target="#navBar">
                  <span id="hamburgerTrigger" class="u-hamburger__box">
                      <span class="u-hamburger__inner"></span>
                  </span>
              </button>
              <!-- End Responsive Toggle Button -->

              <!-- Navigation -->
              <div id="navBar"
                  class="navbar-collapse u-header__navbar-collapse collapse order-2 order-xl-0 pt-4 p-xl-0 position-relative mx-n3 mx-xl-0">
                  <ul class="navbar-nav u-header__navbar-nav">
                      <!-- Home -->
                      <li class="nav-item  u-header__nav-item">
                          <a class="nav-link" style="font-weight:bold" href="{{ route('homepage') }}">Home</a>
                      </li>
                      <!-- End Home -->
                      <li class="nav-item  u-header__nav-item">
                          <a class="nav-link" style="font-weight:bold"
                              href="{{ route('view_hotel') }}">Hotels</a>
                      </li>
                      <li class="nav-item  u-header__nav-item">
                          <a class="nav-link" style="font-weight:bold" href="{{ route('view_tour') }}">Tours</a>
                      </li>
                      <li class="nav-item  u-header__nav-item">
                          <a class="nav-link" style="font-weight:bold"
                              href="{{ route('view_flight') }}">Flights</a>
                      </li>
                      <li class="nav-item  u-header__nav-item">
                          <a class="nav-link" style="font-weight:bold" href="{{ route('hotDeals') }}">HOT DEALS</a>
                      </li>

                      <!-- End Pages -->
                  </ul>
              </div>
              <!-- End Navigation -->

          </nav>
          <!-- End Nav -->
      </div>
  </div>
</header>
<!-- ========== END HEADER ========== -->
