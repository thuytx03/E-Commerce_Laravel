
    @include('client.layouts.header')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Đăng nhập</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form action="{{ route('saveLogin') }}" method="post">
                        @csrf
                        <div class="control-group ">
                            <input type="email" class="form-control" name="email"
                                placeholder="Please enter your email" />
                        </div>
                        <div class="control-group mt-3">
                            <input type="password" class="form-control" name="password"
                                placeholder="Please enter your password" />
                        </div>
                        <div class="control-group mt-3 d-flex justify-content-between">
                            <a href="{{ route('register') }}">Đăng ký</a>

                            <label for="">Quên mật khẩu?</label>
                        </div>

                        <div>
                            <button class="btn btn-primary py-2 px-4 mt-3" type="submit">
                                Đăng nhập</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Justo sed diam ut sed amet duo amet lorem amet stet sea ipsum, sed duo amet et. Est elitr dolor elitr
                    erat sit sit. Dolor diam et erat clita ipsum justo sed.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA
                    </p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA
                    </p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    @include('client.layouts.footer')


