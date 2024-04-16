<style>
    html.semi-dark .sidebar-wrapper .sidebar-header img {
        filter: none !important
    }
</style>
<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true" style="margin-bottom: 100px">
    <div class="sidebar-header" style="height: 100px">
        <div>
            <img src="{{ asset('front_assest/assets/logo_white.png') }}" class="" alt="logo icon" style="width: 200px">
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu" style="margin-bottom: 100px">
        <li style="margin-top: 50px">
            <a href="{{ route('adminDashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">PACKAGES SECTION</div>
            </a>
            <ul>
                <li> <a href="{{ route('packages.index') }}"><i class="bi bi-circle"></i>PACKAGES</a>
                <li> <a href="{{ route('packages.add') }}"><i class="bi bi-circle"></i>ADD PACKAGE</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">HOTELS SECTION</div>
            </a>
            <ul>
                <li> <a href="{{ route('hotels.index') }}"><i class="bi bi-circle"></i>HOTELS</a>
                <li> <a href="{{ route('hotels.add') }}"><i class="bi bi-circle"></i>ADD HOTEL</a>
                </li>
                <li> <a href="{{ route('hotels_rooms.add') }}"><i class="bi bi-circle"></i>ADD ROOMS</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">FLIGHTS SECTION</div>
            </a>
            <ul>
                <li> <a href="{{ route('flights.index') }}"><i class="bi bi-circle"></i>FLIGHTS</a>
                <li> <a href="{{ route('flights.add') }}"><i class="bi bi-circle"></i>ADD FLIGHT</a>
                </li>
                <li> <a href="{{ route('airlines.index') }}"><i class="bi bi-circle"></i>AIRLINES</a></li>
                <li> <a href="{{ route('airlines.add') }}"><i class="bi bi-circle"></i>ADD AIRLINES</a>
                </li>
                <li> <a href="{{ route('airports.index') }}"><i class="bi bi-circle"></i>AIRPORTS</a></li>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-house-fill"></i>
                </div>
                <div class="menu-title">ORDERS SECTION</div>
            </a>
            <ul>
                <li> <a href="{{ route('orders.index') }}"><i class="bi bi-circle"></i>ORDERS</a></li>
            </ul>
        </li>
        @if (Auth::guard('admin')->user()->role !== 'Editor')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i>
                    </div>
                    <div class="menu-title">ADMINS SECTION</div>
                </a>
                <ul>
                    <li> <a href="{{ route('users.index') }}"><i class="bi bi-circle"></i>VIEW ADMINS</a></li>
                    <li> <a href="{{ route('users.add') }}"><i class="bi bi-circle"></i>ADD ADMINS</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bi bi-house-fill"></i>
                    </div>
                    <div class="menu-title">REVIEWS SECTION</div>
                </a>
                <ul>
                    <li> <a href="{{ route('review.index') }}"><i class="bi bi-circle"></i>VIEW REVIEWS</a></li>
                </ul>
            </li>
        @endif
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
