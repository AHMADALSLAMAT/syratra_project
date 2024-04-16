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

    .plan-details {
        /*border: var(--radio-border-width) solid var(--color-gray);
        border-radius: var(--flight_card-radius);
        cursor: pointer;*/
        display: flex;
        height: 100%;
        flex-direction: column;
        padding: var(--flight_card-padding);
        transition: border-color 0.2s ease-out;
    }

    .flight_card:hover .plan-details {
        border-color: var(--color-dark-gray);
    }

    .radio:checked~.plan-details {
        border-color: var(--color-green);
    }

    .radio:focus~.plan-details {
        box-shadow: 0 0 0 2px var(--color-dark-gray);
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
<div class="grid" id="baggage-extra">
    <label class="flight_card">
        <input name="baggage[]" class="radio" type="checkbox" value="cabinbag">
        <span class="plan-details">
            <span class="plan-type">
                Add cabin bag</span>
            <span class="plan-cost">$40</span>
            <span> <i class="fa fa-xmark"></i> 23 x 40 x 55 cm · Max weight 10 kg </span>
            <hr style="width: 100%;height:1px;background:#ccc">
        </span>
    </label>
    <label class="flight_card">
        <input name="baggage[]" class="radio" type="checkbox" value="checkedbag">
        <span class="plan-details" aria-hidden="true">
            <span class="plan-type">Add checked bag</span>
            <span class="plan-cost">$50</span>
            <span>Max weight 10 kg </span>
            <hr style="width: 100%;height:1px;background:#ccc">

        </span>
    </label>
</div>
