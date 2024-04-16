<style>
    :root {
        --flight_card-line-height: 1.2em;
        --flight_card-padding: 1em;
        --flight_card-radius: 0.5em;
        --color-green: #558309;
        --color-gray: #e2ebf6;
        --color-dark-gray: #c4d1e1;
        --radio-border-width: 2px;
        --radio-size: 1.5em;
    }

    .grid {
        display: grid;
        grid-gap: var(--flight_card-padding);
        margin: 40px auto;
        max-width: 60em;
        padding: 0;
    }

    @media (min-width: 42em) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .flight_card {
        background-color: #fff;
        border-radius: var(--flight_card-radius);
        position: relative;
    }

    .flight_card:hover {
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
    }

    .radio {
        font-size: inherit;
        margin: 0;
        position: absolute;
        right: calc(var(--flight_card-padding) + var(--radio-border-width));
        top: calc(var(--flight_card-padding) + var(--radio-border-width));
    }

    @supports (-webkit-appearance: none) or (-moz-appearance: none) {
        .radio {
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff;
            border: var(--radio-border-width) solid var(--color-gray);
            border-radius: 50%;
            cursor: pointer;
            height: var(--radio-size);
            outline: none;
            transition: background 0.2s ease-out, border-color 0.2s ease-out;
            width: var(--radio-size);
        }

        .radio::after {
            border: var(--radio-border-width) solid #fff;
            border-top: 0;
            border-left: 0;
            content: "";
            display: block;
            height: 0.75rem;
            left: 25%;
            position: absolute;
            top: 50%;
            transform: rotate(45deg) translate(-50%, -50%);
            width: 0.375rem;
        }

        .radio:checked {
            background: var(--color-green);
            border-color: var(--color-green);
        }

        .flight_card:hover .radio {
            border-color: var(--color-dark-gray);
        }

        .flight_card:hover .radio:checked {
            border-color: var(--color-green);
        }
    }
    .flight_card{
        border: var(--radio-border-width) solid var(--color-gray);
        border-radius: var(--flight_card-radius);
        cursor: pointer;
        padding: 20px
    }
    .plan-details {
        border: none;
        border-radius: var(--flight_card-radius);
        cursor: pointer;
        display: flex;
        height: 100%;
        flex-direction: column;
        padding: var(--flight_card-padding);
        transition: border-color 0.2s ease-out;
    }

    .flight_card:hover  {
        border-color: var(--color-dark-gray);
    }


    .radio:disabled~.plan-details {
        color: var(--color-dark-gray);
        cursor: default;
    }

    .radio:disabled~.plan-details .plan-type {
        color: var(--color-dark-gray);
    }

    .flight_card:hover .radio:disabled~.plan-details {
        border-color: var(--color-gray);
        box-shadow: none;
    }

    .flight_card:hover .radio:disabled {
        border-color: var(--color-gray);
    }

    .plan-type {
        color: var(--color-green);
        font-size: 20px;
        font-weight: bold;
        line-height: 1em;
    }

    .plan-cost {
        font-size: 18px;
        font-weight: bold;
        padding: 0.5rem 0;
    }

    .slash {
        font-weight: normal;
    }

    .plan-cycle {
        font-size: 15px;
        font-variant: none;
        border-bottom: none;
        cursor: inherit;
        text-decoration: none;
    }

    .hidden-visually {
        border: 0;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        white-space: nowrap;
        width: 1px;
    }
</style>

<div class="grid" id="travelType">
    @foreach ($hotels as $hotel)
    <label class="flight_card">
        <input name="hotel_id" class="radio" type="radio"  value="{{ $hotel->id }}">
        <span class="plan-details">
            <span class="plan-type">
                {{ $hotel->hotel_name }}</span>
                <div style="margin: 40px 0px"></div>
            <button type="button" class="btn btn-primary"
            data-toggle="modal"
            data-target="#exampleModal{{ $hotel->id }}">
                <i class="fa fa-xmark"></i> Check Avalibal Rooms</button>
            <hr style="width: 100%;height:1px;background:#ccc">

        </span>
    </label>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal{{ $hotel->id }}"
        tabindex="-1" aria-labelledby="exampleModalLabel{{ $hotel->id }}" aria-hidden="true">
        <div class="modal-dialog" style="max-width:80%">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel{{ $hotel->id }}"> {{ $hotel->hotel_name }}</h5>

            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @foreach ($hotel->Rooms as $key => $room)
            <label class="flight_card" style="width: 100%">
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input name="hotel-plan" data-hotel_id="{{ $hotel->id }}" class="radio" type="radio"
                value="@if ($room->offer_price > 0){{ $room->offer_price }} @else {{ $room->room_price }} @endif">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <img src="{{ asset($room->room_image) }}" alt="" style="width:100%">
                        <div class="thumbnail">
                            @foreach ($room->room_gallery as $item)
                            <img src="{{ asset($item) }}" alt="" style="width:60px;margin-top:10px">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <span class="plan-details">
                            <span class="plan-type"></span>
                                @if ($room->offer_price > 0)
                                <span data-offer-price="{{ $room->offer_price }}" class="plan-cost offer_price">{{ $room->offer_price }}$ - <small><del data-price="{{ $room->room_price }}">{{ $room->room_price }}$</del></small></span>
                                @else
                                <span class="plan-cost main_price" data-price="{{ $room->room_price }}">${{ $room->room_price }}</span>
                                @endif
                            <span> <i class="fa fa-xmark"></i> Room Details :</span>
                            <hr style="width: 100%;height:1px;background:#ccc">
                            <table style="width: 100%">
                                <tr>
                                    <td>ROOM BEDS</td>
                                    <td>{{ $room->room_beds }}</td>
                                </tr>
                                <tr>
                                    <td>ROOM TYPE</td>
                                    <td>{{ $room->room_beds }}</td>
                                </tr>
                                <tr>
                                    <td>ROOM LEVEL</td>
                                    <td>{{ $room->room_lvl }}</td>
                                </tr>
                            </table>
                        </span>
                    </div>
                </div>
            </label>
            @endforeach
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
    @endforeach
</div>
