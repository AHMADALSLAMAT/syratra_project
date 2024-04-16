

<div class="modal fade" id="exampleLargeModa{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 90% !important;max-width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                   INVOICE
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section id="invoice">
                    <div class="container my-5 py-5">
                        <div class="text-center pb-5">
                            <img src="{{ asset('front_assest/assets/logo_color.png') }}"
                             alt=""
                             width="200">
                        </div>

                        <div class="d-md-flex justify-content-between my-5">
                            <div>
                                <p class="fw-bold text-primary">Invoice From</p>
                                <h4>AHMAD ALSALAMAT</h4>
                                <ul class="list-unstyled m-0">
                                    <li>SYRIATRA COMPANY</li>
                                    <li>info@syriatra.com</li>
                                    <li>123, South street ,tseel,daraa,syria</li>
                                </ul>
                            </div>
                            <div class="mt-5 mt-md-0">
                                <p class="fw-bold text-primary">Invoice To</p>
                                <h4>{{ $order->user_fname }} {{ $order->user_lname }}</h4>
                                <ul class="list-unstyled m-0">
                                    <li>{{ $order->user_email }}</li>
                                    <li>{{ $order->user_phone }}</li>
                                </ul>
                            </div>
                        </div>

                        <div
                            class=" d-md-flex justify-content-between align-items-center border-top border-bottom border-primary my-5 py-3">
                            <h2 class="display-6 fw-bold m-0">Invoice Data </h2>
                            <div>
                                <p class="m-0"> <span class="fw-medium">Invoice Ref:</span> {{ $order->order_ref }}</p>
                                <p class="m-0"> <span class="fw-medium">Invoice Date:</span> {{ $order->created_at }}</p>
                            </div>

                        </div>

                        <div class="py-1">
                            @if($order->flight_id != null)
                            @include('Back_End.pages.Orders.Models.view_flight')
                            @elseif($order->package_id != null)
                            @elseif($order->hotel_id != null)
                            @endif
                        </div>
                        <div class="d-md-flex justify-content-between my-5">
                            <div>
                                <h5 class="fw-bold my-4">Payment Info</h5>
                                <ul class="list-unstyled">
                                    <li><span class="fw-semibold">Account No: </span> {{ $maskedCardNumber }}</li>
                                    <li><span class="fw-semibold">Account Name: </span> {{ $paymentcard->Cardname }}</li>

                                </ul>
                            </div>

                            <div>
                                <h5 class="fw-bold my-4">Contact Us</h5>
                                <ul class="list-unstyled">
                                    <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="mdi:location"
                                            style="vertical-align:text-bottom"></iconify-icon> 30 E Lake St, Chicago, USA</li>
                                    <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="solar:phone-bold"
                                            style="vertical-align:text-bottom"></iconify-icon> (510) 710-3464</li>
                                    <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="ic:baseline-email"
                                            style="vertical-align:text-bottom"></iconify-icon> info@worldcourse.com</li>
                                </ul>
                            </div>


                        </div>

                        <div id="footer-bottom">
                            <div class="container border-top border-primary">
                                <div class="row mt-3">
                                    <div class="col-md-12 copyright">
                                        <p>© 2024 Invoice. <a href="#" target="_blank"
                                                class="text-decoration-none text-black-50">Terms & Conditions</a> </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
