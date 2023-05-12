@include('client.layouts.header')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">

            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Total</th>
                        <th colspan="2">Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($carts as $value)
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt=""
                                    style="width: 50px;">{{ $value->product->name }} </td>
                            @if ($value->product->sale != null)
                                <td class="align-middle">${{ $value->product->price_new }}</td>
                            @else
                                <td class="align-middle">${{ $value->product->price }}</td>
                            @endif

                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-sm btn-primary btn-minus"><i
                                                    class="fa fa-minus" ></i></button>
                                        </div>


                                    <input type="text" name="quantity"
                                        class="form-control form-control-sm bg-secondary text-center quantity"
                                        value="{{ $value->quantity }}">

                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $value->size->name }}</td>
                            <td class="align-middle">{{ $value->color->name }}</td>


                            <td class="align-middle">{{ $value->total }}</td>
                            <td class="align-middle">
                                <form action="{{ route('deleteCart', ['id' => $value->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        onclick="return confirm('Bạn có chắc muốn xoá sản phẩm {{ $value->product->name }}')"
                                        class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                                </form>

                            </td>
                        </tr>
                        @php
                            $totalPrice += $value->total;
                        @endphp
                    @endforeach

                    <tr>



                        <td>
                            <button class="btn btn-sm btn-primary">Xoá tất cả</button>
                        </td>
                        <td colspan="4" class="text-right font-weight-bold">Tổng tiền:</td>
                        <td class="font-weight-bold ">
                            ${{ $totalPrice }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>







        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($carts as $value)
                    <div class="card-body">
                        <input type="hidden" name="quantity"
                            class="form-control form-control-sm bg-secondary text-center quantity"
                            value="{{ $value->quantity }}">
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{ $value->product->name }}</h6>
                            <h6 class="font-weight-medium">${{ $value->total }}</h6>
                        </div>
                        @php
                            $totalPrice += $value->total;
                        @endphp
                    </div>
                @endforeach

                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">${{ $totalPrice }}</h5>
                    </div>
                    <form action="{{ route('checkout') }}" method="GET">
                        @csrf
                        <input type="hidden" name="total" value="{{ $totalPrice }}">

                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                        {{-- <a href="{{ route('checkout') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a> --}}
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Cart End -->





@include('client.layouts.footer')
