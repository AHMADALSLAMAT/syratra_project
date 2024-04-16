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
 </style>
 <div class="container">
     <div class="wizardForm">
         <div class="stepwizard">
             <div class="stepwizard-row setup-panel">
                 <div class="stepwizard-step col-3">
                     <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                     <p><small>Stay Period </small></p>
                 </div>
                 <div class="stepwizard-step col-3">
                     <a href="#step-2" type="button" class="btn btn-secondary btn-circle" disabled="disabled">2</a>
                     <p><small>User Info
                     </small></p>
                 </div>
                 <div class="stepwizard-step col-3">
                     <a href="#step-3" type="button" class="btn btn-secondary btn-circle" disabled="disabled">3</a>
                     <p><small>Check and pay</small></p>
                 </div>
             </div>
         </div>
         <form role="form" action="{{ route('hotelpayment') }}" method="post">
             @csrf
             <input type="hidden" name="room_id" value="{{ $room_info->id }}" >
             <input type="hidden" name="hotel_id"  value="{{ $room_info->hotel_id }}">
             <input type="hidden" name="totalPrice" value="{{ $room_info->room_price }}" id="totalPrice">
             <input type="hidden" name="number_of_nights" value="1" id="number_of_nights">
             <input type="hidden" name="stay_date"  id="stay_date">
             <input type="hidden" name="leave_date"  id="leave_date">
             <div class="panel panel-primary setup-content" id="step-1">
                 <div class="panel-heading">
                     <h3 class="panel-title">Select the stay period</h3>
                 </div>
                 <div class="panel-body">
                    @include('Front_End.pages.hotels.form.steps.stay')
                     <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>
                 </div>
             </div>
             <div class="panel panel-primary setup-content" id="step-2">
                 <div class="panel-heading">
                     <h3 class="panel-title">User Info</h3>
                 </div>
                 <div class="panel-body">
                    @include('Front_End.pages.hotels.form.steps.userinfo')
                    <button class="btn btn-primary nextBtn pull-right" type="button">Next Step</button>
                 </div>
             </div>
             <div class="panel panel-primary setup-content" id="step-3">
                 <div class="panel-heading">
                     <h3 class="panel-title">Select your Payment</h3>
                 </div>
                 <div class="panel-body">
                   @include('Front_End.pages.hotels.form.steps.payment')
                     <button class="btn btn-success pull-right" type="submit">CONFIRM
                         BOOKING!</button>
                 </div>
             </div>
         </form>
     </div>
 </div>
