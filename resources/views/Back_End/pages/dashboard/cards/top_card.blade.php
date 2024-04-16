<div class="col">
    <div class="card overflow-hidden rounded-4">
        <div class="card-body p-2">
            <div
                class="d-flex align-items-stretch justify-content-between  rounded-4 overflow-hidden bg-primary">
                <div class="w-100 p-3">
                    <p class="text-white">Total Orders</p>
                    <h4 class="text-white">{{ count($count_orders) }}</h4>
                    <a class="text-white" href="{{ route('orders.index') }}">view Orders</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="card overflow-hidden  rounded-4">
        <div class="card-body p-2">
            <div
                class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-primary">
                <div class="w-100 p-3">
                    <p class="text-white">Total Flights</p>
                    <h4 class="text-white">{{ count($count_flights) }}</h4>
                    <a class="text-white" href="{{ route('flights.index') }}">view Flights</a>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="card overflow-hidden rounded-4">
        <div class="card-body p-2">
            <div
                class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-primary">
                <div class="w-100 p-3">
                    <p class="text-white">Total Hotels</p>
                    <h4 class="text-white">{{ count($count_hotels) }}</h4>
                    <a class="text-white" href="{{ route('hotels.index') }}">view Hotels</a>

                </div>

            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="card overflow-hidden rounded-4">
        <div class="card-body p-2">
            <div
                class="d-flex align-items-stretch justify-content-between rounded-4 overflow-hidden bg-primary">
                <div class="w-100 p-3 bg-light-primary">
                    <p class="text-white">Total Packages</p>
                    <h4 class="text-white">{{ count($count_packages) }}</h4>
                    <a class="text-white" href="{{ route('packages.index') }}">view Packages</a>

                </div>

            </div>
        </div>
    </div>
</div>
