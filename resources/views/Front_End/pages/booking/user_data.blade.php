
<style>
   .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }
        .stepwizard-row {
            display: contents;
        }
        .stepwizard {
            display: flex;
            width: 100%;
            position: relative;
        }
        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }
        .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
            opacity: 1 !important;
            color: #bbb;
        }
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }
        .stepwizard-step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .setup-panel .btn.btn-circle{
            background: #f2f2f2;
            color: #ccc;
            border:#ccc;

        }
        .btn-success:not(label.btn), .btn-success:not(label.btn):not([href]):not(:disabled):not(.disabled), .btn-success:not([href]), .btn-success:not([href]):not([href]):not(:disabled):not(.disabled){
            background: #119992 !important;
            color: #fff !important;

        }
        .has-error input{
            border:1px solid red;
        }
        .wizardForm{
            background: #fff;
            padding: 40px 20px;
            border-radius: 20px
        }
        .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="container">
    <div class="wizardForm">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Ticket type</small></p>
                </div>
                <div class="stepwizard-step col-3">
                    <a href="#step-2" type="button" class="btn btn-secondary btn-circle" disabled="disabled">2</a>
                    <p><small>Who's flying?
                    </small></p>
                </div>
                <div class="stepwizard-step col-3">
                    <a href="#step-3" type="button" class="btn btn-secondary btn-circle" disabled="disabled">3</a>
                    <p><small>Baggage and extras</small></p>
                </div>
                <div class="stepwizard-step col-3">
                    <a href="#step-4" type="button" class="btn btn-secondary btn-circle" disabled="disabled">4</a>
                    <p><small>Select your seat</small></p>
                </div>
                <div class="stepwizard-step col-3">
                    <a href="#step-5" type="button" class="btn btn-secondary btn-circle" disabled="disabled">4</a>
                    <p><small>Check and pay</small></p>
                </div>
            </div>
        </div>
        <form role="form" action="{{ route('payment-submit') }}" method="post">
            @csrf
            @if ($flight_type != 'oneway')
            <input type="hidden" class="flight_id_leave"
            name="flight_id[]" value="{{ $dataFlight['departure_flight']['id'] }}">
            <input type="hidden" class="flight_id_return"
            name="flight_id[]" value="{{ $dataFlight['return_flight']['id'] }}">
            <input type="hidden" name="flight_base_price"
            value="{{ $dataFlight['return_flight']['flight_price'] +
            $dataFlight['departure_flight']['flight_price'] }}">
            @else
            <input type="hidden" id="flight_id" name="flight_id" value="{{ $dataFlight['id'] }}">
            <input type="hidden" name="flight_base_price" value="{{ $dataFlight['flight_price'] }}">
            <input type="hidden" name="hotel_id" class="hotel_id">
            <input type="hidden" name="hotel_plan_price" class="hotel_plan_price">
            <input type="hidden" name="room_id" class="room_id">
            @endif
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Ticket Type</h3>
                </div>
                <div class="panel-body">
                    @include('Front_End.pages.booking.forms_steps.ticket_type')
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>
                </div>
                <hr>
                @if (count($hotels) > 0)
                <div class="hotel-contriner">

                    <div class="panel-heading">
                        <h3 class="panel-title">Do you want to book a hotel with the flight ?</h3>
                        <h6> The Hotel will be in your arrive distenation at <span style="color:red">{{ $dataFlight['flight_arrive_country']}}</span></h6>
                    </div>
                     <!-- Rounded switch -->
                     <label class="switch switch-panel">
                        <input type="checkbox" name="hotel_section"  class="hotelSwithcer">
                        <span class="slider round"></span>
                    </label>
                    <div class="panel-body hotel-panel" style="display: none">
                        @include('Front_End.pages.booking.forms_steps.hotel_ticket')
                    </div>
                </div>

                @endif
            </div>

            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading">
                    <h3 class="panel-title">Traveller Info</h3>
                </div>
                <div class="panel-body">
                    @include('Front_End.pages.booking.forms_steps.user_info')
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>
                </div>
            </div>

            <div class="panel panel-primary setup-content" id="step-3">
                <div class="panel-heading">
                    <h3 class="panel-title">Select Extra Bag</h3>
                </div>
                <div class="panel-body">
                 @include('Front_End.pages.booking.forms_steps.baggage_and_extras')
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>
                </div>
            </div>

            <div class="panel panel-primary setup-content" id="step-4">
                <div class="panel-heading">
                    <h3 class="panel-title">Select your seat</h3>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>

                <div class="panel-body">
                  @include('Front_End.pages.booking.forms_steps.seats')
                </div>
            </div>
            <div class="panel panel-primary setup-content" id="step-5">
                <div class="panel-heading">
                    <h3 class="panel-title">Select your Payment</h3>
                </div>
                <div class="panel-body">
                  @include('Front_End.pages.booking.cards')
                    <button class="btn btn-success pull-right" type="submit">CONFIRM
                        BOOKING!</button>
                        <input type="hidden" class="totalpay" name="totalpay">

                </div>
            </div>
        </form>
    </div>
</div>


