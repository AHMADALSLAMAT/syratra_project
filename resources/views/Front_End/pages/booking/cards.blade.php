<div class="mb-5 shadow-soft bg-white rounded-sm">
    <div class="pt-4 pb-5 px-5">
        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
            Your Card Information
        </h5>
        <!-- Nav Classic -->
        <ul class="nav nav-classic nav-choose border-0 nav-justified border mx-n3"
            role="tablist">
            <li class="nav-item mx-3 mb-4 mb-md-0">
                <a class="rounded py-5 border-width-2 border nav-link font-weight-medium active"
                    id="pills-one-example2-tab" data-toggle="pill" href="#pills-one-example2"
                    role="tab" aria-controls="pills-one-example2" aria-selected="true">
                    <div
                        class="height-25 width-25 flex-content-center bg-primary rounded-circle position-absolute left-0 top-0 ml-2 mt-2">
                        <i class="flaticon-tick text-white font-size-15"></i>
                    </div>
                    <div
                        class="d-md-flex justify-content-md-center align-items-md-center flex-wrap">
                        <img class="img-fluid mb-3" src="{{ ('front_assest/assets/img/199x35/img1.jpg') }}"
                            alt="Image-Description">
                        <div class="w-100 text-dark">Payment with credit card</div>
                    </div>
                </a>
            </li>
        </ul>
        <!-- End Nav Classic -->

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-pane fade pt-8 show active" id="pills-one-example2" role="tabpanel" aria-labelledby="pills-one-example2-tab">
                <input type="hidden" value="visa" name="payment_type">
                <!-- Payment Form -->
                <div class="row">
                    <!-- Input -->
                    <div class="col-sm-6 mb-4">
                        <div class="js-form-message">
                            <label class="form-label">
                                Card Holder Name
                            </label>
                            <input type="text" class="form-control" name="Cardname" placeholder="" aria-label="" required
                                pattern="^[A-Za-z\s]+$"
                                data-msg="Please enter a valid card holder name containing only letters."
                                data-error-class="u-has-error"
                                data-success-class="u-has-success">
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <div class="col-sm-6 mb-4">
                        <div class="js-form-message">
                            <label class="form-label">
                                Card Number
                            </label>
                            <input type="text" class="form-control" name="Cardnumber" placeholder="" aria-label="" required
                                pattern="^\d{14}$"
                                data-msg="Please enter a valid 14-digit card number."
                                data-error-class="u-has-error"
                                data-success-class="u-has-success">
                        </div>
                    </div>
                    <!-- End Input -->

                    <div class="w-100"></div>

                    <!-- Input -->
                    <div class="col-sm-6 mb-4">
                        <div class="row">
                            <div class="col-sm-6 mb-4 mb-md-0">
                                <div class="js-form-message">
                                    <label class="form-label">
                                        Expiry Month
                                    </label>
                                    <input type="number" class="form-control" name="Expirymonth" placeholder="" aria-label="" required
                                        min="1" max="12"
                                        data-msg="Please enter a valid expiry month between 1 and 12."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="js-form-message">
                                    <label class="form-label">
                                        Expiry Year
                                    </label>
                                    <input type="number" class="form-control" name="Expiryyear" placeholder="" aria-label="" required
                                        min="2024"
                                        data-msg="Please enter a valid expiry year, this year or later."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Input -->

                    <!-- Input -->
                    <div class="col-sm-6 mb-4">
                        <div class="js-form-message">
                            <label class="form-label">
                                CCV
                            </label>
                            <input type="number" class="form-control" name="ccvnumber" placeholder="" aria-label="" required
                                pattern="^\d{3}$"
                                data-msg="Please enter a valid 3-digit CCV number."
                                data-error-class="u-has-error"
                                data-success-class="u-has-success">
                        </div>
                    </div>
                    <!-- End Input -->

                    <div class="w-100"></div>

                    <div class="col">
                        <!-- Checkbox -->
                        <div class="js-form-message mb-5">
                            <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                                <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="termsCheckbox" required
                                    data-msg="Please accept our Terms and Conditions."
                                    data-error-class="u-has-error"
                                    data-success-class="u-has-success">
                                <label class="custom-control-label" for="termsCheckbox">
                                    <small>
                                        By continuing, you agree to the
                                        <a class="link-muted" href="#">Terms and Conditions</a>
                                    </small>
                                </label>
                            </div>
                        </div>
                        <!-- End Checkbox -->
                    </div>
                </div>
                <!-- End Payment Form -->
            </div>
            <div class="tab-pane fade pt-8" id="pills-two-example2" role="tabpanel"
                aria-labelledby="pills-two-example2-tab">
                <input type="hidden" value="COD" name="payment_type">
                    <!-- Login -->
                    <div id="login" data-target-group="idForm">
                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signinEmail">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signinEmailLabel">
                                            <span class="fas fa-user"></span>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email"
                                        id="signinEmail" placeholder="Email" aria-label="Email"
                                        aria-describedby="signinEmailLabel"
                                        data-msg="Please enter a valid email address."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->

                        <!-- Form Group -->
                        <div class="form-group mb-4">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signinPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signinPasswordLabel">
                                            <span class="fas fa-lock"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password"
                                        id="signinPassword" placeholder="Password"
                                        aria-label="Password"
                                        aria-describedby="signinPasswordLabel"
                                        data-msg="Your password is invalid. Please try again."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Form Group -->
                    </div>
            </div>
        </div>
        <!-- End Tab Content -->
    </div>
</div>
