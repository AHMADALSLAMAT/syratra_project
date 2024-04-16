

<div class="accordion" id="accordionExample">
    @if ($flight_type == 'oneway')
    <div class="card">
      <div class="card-header" id="headingOne">

        <h2 class="mb-0">

          <button class="btn btn-link btn-block text-left"
          type="button" data-toggle="collapse" data-target="#collapseOne"
          aria-expanded="true" aria-controls="collapseOne">
           {{$dataFlight['departure_airport']['cityName']}}
           <small style="font-size: 12px">( {{$dataFlight['departure_airport']['countryName']}})</small>
           -
           {{$dataFlight['arrival_airport']['cityName']}}
           <small style="font-size: 12px">( {{$dataFlight['arrival_airport']['countryName']}})</small>
           <p> {{ App\Helpers\Flight::calculateHoursDifference(
            $dataFlight['flight_leave_date'],$dataFlight['flight_leave_hours'],
            $dataFlight['flight_arrive_date'],$dataFlight['flight_arrive_hours']) }} -
            {{ $dataFlight['airlines']['airline_name'] }} - <strong>Flight To :: </strong>
        {{  $dataFlight['arrival_airport']['name'] }}
        </p>
            <p style="color: rgb(10, 137, 235)"> SELECT YOUR SEAT (THERE IS NO SEAT HAS BEEN SELECTED)</p>
          </button>
        </h2>
      </div>
      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
        @include('Front_End.pages.booking.forms_steps.seats_model.seats')
        </div>
      </div>
    </div>
    @else
    <div class="card">
        <div class="card-header" id="headingOne">

          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left"
            type="button" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
             {{$dataFlight['departure_flight']['departure_airport']['cityName']}}
             <small style="font-size: 12px">( {{$dataFlight['departure_flight']['departure_airport']['countryName']}})</small>
             -
             {{$dataFlight['departure_flight']['arrival_airport']['cityName']}}
             <small style="font-size: 12px">( {{$dataFlight['departure_flight']['arrival_airport']['countryName']}})</small>
             <p> {{ App\Helpers\Flight::calculateHoursDifference(
              $dataFlight['departure_flight']['flight_leave_date'],$dataFlight['departure_flight']['flight_leave_hours'],
              $dataFlight['departure_flight']['flight_arrive_date'],$dataFlight['departure_flight']['flight_arrive_hours']) }} -
              {{ $dataFlight['departure_flight']['airlines']['airline_name'] }} - <strong>Flight To :: </strong>
          {{  $dataFlight['departure_flight']['arrival_airport']['name'] }}
          </p>
              <p style="color: rgb(10, 137, 235)"> SELECT YOUR SEAT (THERE IS NO SEAT HAS BEEN SELECTED)</p>
            </button>
          </h2>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body">
          @include('Front_End.pages.booking.forms_steps.seats_model.seats_leave')
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingOnetow">

          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left"
            type="button" data-toggle="collapse" data-target="#collapseOnetow"
            aria-expanded="true" aria-controls="collapseOnetow">
             {{$dataFlight['return_flight']['departure_airport']['cityName']}}
             <small style="font-size: 12px">( {{$dataFlight['return_flight']['departure_airport']['countryName']}})</small>
             -
             {{$dataFlight['return_flight']['arrival_airport']['cityName']}}
             <small style="font-size: 12px">(
                {{$dataFlight['return_flight']['arrival_airport']['countryName']}})</small>
             <p> {{ App\Helpers\Flight::calculateHoursDifference(
              $dataFlight['return_flight']['flight_leave_date'],$dataFlight['return_flight']['flight_leave_hours'],
              $dataFlight['return_flight']['flight_arrive_date'],$dataFlight['return_flight']['flight_arrive_hours']) }} -
              {{ $dataFlight['return_flight']['airlines']['airline_name'] }} - <strong>Flight To :: </strong>
          {{  $dataFlight['return_flight']['arrival_airport']['name'] }}
          </p>
              <p style="color: rgb(10, 137, 235)"> SELECT YOUR SEAT (THERE IS NO SEAT HAS BEEN SELECTED)</p>
            </button>
          </h2>
        </div>
        <div id="collapseOnetow" class="collapse" aria-labelledby="headingOnetow" data-parent="#accordionExample">
          <div class="card-body">
          @include('Front_End.pages.booking.forms_steps.seats_model.seats_return')
          </div>
        </div>
      </div>
    @endif
  </div>
