@include('client.layouts.header')
<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Đăng ký</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </div>
                @endif
                <form action="{{ route('saveRegister') }}" method="post">
                    @csrf
                    <div class="control-group ">
                        <input type="text" class="form-control" name="name" placeholder="Vui lòng nhập Họ tên" />
                    </div>
                    <div class="control-group mt-3">
                        <input type="email" class="form-control" name="email" placeholder="Vui lòng nhập Email" />
                    </div>
                    <div class="control-group mt-3">
                        <input type="password" class="form-control" name="password"
                            placeholder="Vui lòng nhập Mật khẩu" />
                    </div>
                    <div class="control-group mt-3">
                        <input type="password" class="form-control" name="enter_password"
                            placeholder="Vui lòng nhập lại Mật khẩu" />
                    </div>
                    <div class="control-group mt-3 d-flex justify-content-between">
                        <a href="{{ route('login') }}">Đăng nhập</a>

                        <a href="">Quên mật khẩu?</a>
                    </div>

                    <div>
                        <button class="btn btn-primary py-2 px-4 mt-3" type="submit">
                            Đăng ký</button>
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
