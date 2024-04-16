<style>

    .plane {
      margin: 20px auto;
      max-width: 300px;
    }

    .cockpit {
      height: 250px;
      position: relative;
      overflow: hidden;
      text-align: center;
      border-bottom: 5px solid #d8d8d8;
    }
    .cockpit:before {
      content: "";
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      height: 500px;
      width: 100%;
      border-radius: 50%;
      border-right: 5px solid #d8d8d8;
      border-left: 5px solid #d8d8d8;
    }
    .cockpit h1 {
      width: 60%;
      margin: 100px auto 35px auto;
    }

    .exit {
      position: relative;
      height: 50px;
    }
    .exit:before, .exit:after {
      content: "EXIT";
      font-size: 14px;
      line-height: 18px;
      padding: 0px 2px;
      font-family: "Arial Narrow", Arial, sans-serif;
      display: block;
      position: absolute;
      background: green;
      color: white;
      top: 50%;
      transform: translate(0, -50%);
    }
    .exit:before {
      left: 0;
    }
    .exit:after {
      right: 0;
    }
    .row{
        margin: auto
    }
    .fuselage {
      border-right: 5px solid #d8d8d8;
      border-left: 5px solid #d8d8d8;
    }

    ol {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .seats {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      justify-content: flex-start;
      width: 100%;
    }

    .seat {
      display: flex;
      flex: 0 0 14.2857142857%;
      padding: 5px;
      position: relative;
    }
    .seat:nth-child(3) {
      margin-right: 14.2857142857%;
    }
    .seat input[type=checkbox] {
      position: absolute;
      opacity: 0;
    }
    .seat input[type=checkbox]:checked + label {
      background: #bada55;
      -webkit-animation-name: rubberBand;
      animation-name: rubberBand;
      animation-duration: 300ms;
      animation-fill-mode: both;
    }
    .seat input[type=checkbox]:disabled + label {
      background: #dddddd;
      text-indent: -9999px;
      overflow: hidden;
    }
    .seat input[type=checkbox]:disabled + label:after {
      content: "X";
      text-indent: 0;
      position: absolute;
      top: 4px;
      left: 50%;
      transform: translate(-50%, 0%);
    }
    .seat input[type=checkbox]:disabled + label:hover {
      box-shadow: none;
      cursor: not-allowed;
    }
    .seat label {
      display: block;
      position: relative;
      width: 100%;
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      line-height: 1.5rem;
      padding: 4px 0;
      background: #F42536;
      border-radius: 5px;
      animation-duration: 300ms;
      animation-fill-mode: both;
    }
    .seat label:before {
      content: "";
      position: absolute;
      width: 75%;
      height: 75%;
      top: 1px;
      left: 50%;
      transform: translate(-50%, 0%);
      background: rgba(255, 255, 255, 0.4);
      border-radius: 3px;
    }
    .seat label:hover {
      cursor: pointer;
      box-shadow: 0 0 0px 2px #5C6AFF;
    }

    @-webkit-keyframes rubberBand {
      0% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }
      30% {
        -webkit-transform: scale3d(1.25, 0.75, 1);
        transform: scale3d(1.25, 0.75, 1);
      }
      40% {
        -webkit-transform: scale3d(0.75, 1.25, 1);
        transform: scale3d(0.75, 1.25, 1);
      }
      50% {
        -webkit-transform: scale3d(1.15, 0.85, 1);
        transform: scale3d(1.15, 0.85, 1);
      }
      65% {
        -webkit-transform: scale3d(0.95, 1.05, 1);
        transform: scale3d(0.95, 1.05, 1);
      }
      75% {
        -webkit-transform: scale3d(1.05, 0.95, 1);
        transform: scale3d(1.05, 0.95, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }
    }
    @keyframes rubberBand {
      0% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }
      30% {
        -webkit-transform: scale3d(1.25, 0.75, 1);
        transform: scale3d(1.25, 0.75, 1);
      }
      40% {
        -webkit-transform: scale3d(0.75, 1.25, 1);
        transform: scale3d(0.75, 1.25, 1);
      }
      50% {
        -webkit-transform: scale3d(1.15, 0.85, 1);
        transform: scale3d(1.15, 0.85, 1);
      }
      65% {
        -webkit-transform: scale3d(0.95, 1.05, 1);
        transform: scale3d(0.95, 1.05, 1);
      }
      75% {
        -webkit-transform: scale3d(1.05, 0.95, 1);
        transform: scale3d(1.05, 0.95, 1);
      }
      100% {
        -webkit-transform: scale3d(1, 1, 1);
        transform: scale3d(1, 1, 1);
      }
    }
    .rubberBand {
      -webkit-animation-name: rubberBand;
      animation-name: rubberBand;
    }
    .rowseat .row {
       width: 100%
    }
</style>
<div class="row">
    <input id="flight_type_seat" type="hidden" name="flight_type_seat" value="{{ $flight_type }}">
    <div class="col-md-4">
        <div class="row">
            <div class="col-3">
                <div class="squar-not-selected" style="height: 40px;width:40px;margin:auto;background:#F42536">
                </div>
            </div>
            <div class="col-9">
                <div class="squar-not-selected-text">
                    The Seat is not selected
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="squar-not-selected" style="height: 40px;width:40px;margin:auto;background:#bada55">
                </div>
            </div>
            <div class="col-9">
                <div class="squar-not-selected-text">
                    The Seat has been selected
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="squar-not-selected" style="height: 40px;width:40px;margin:auto;background:#ccc;text-align:center">
                   <span style="font-size: 25px;color:#000;font-weight:bold">x</span>
                </div>
            </div>
            <div class="col-9">
                <div class="squar-not-selected-text">
                    The Seat is not avilable
                </div>
            </div>
        </div>
        <p style="margin-top: 40px;font-size:15px;font-weight:bold">
            If you don't select a seat now, the airline may randomly assign you a seat or allow you to choose from remaining seats when you check in.
        </p>
    </div>
    <div class="col-md-8">
        <div class="plane">
            <div class="cockpit">
              <h1 style="font-size: 25px;font-weight:bold">Please select a seat</h1>
            </div>
            <div class="exit exit--front fuselage">
            </div>
            <ol class="cabin fuselage">
                <li class="rowseat" id="seats-container">
                    <!-- Seats will be dynamically added here -->
                </li>
            </ol>
        </div>
    </div>
</div>

