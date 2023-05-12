@include('client.layouts.header')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">CHECKOUT</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">

            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    @foreach ($orders as $key => $value)
                        <tr>
                            <td class="align-middle">{{ $key + 1 }} </td>
                            <td class="align-middle">{{ $value->product->name }} </td>
                            <td class="align-middle">{{ $value->quantity }} </td>
                            <td class="align-middle">{{ $value->size->name }}</td>
                            <td class="align-middle">{{ $value->color->name }}</td>
                            <td class="align-middle">{{ $value->order->total }}</td>
                            <td class="align-middle">{{ $value->order->status }}</td>
                            <td class="align-middle">
                                @if ($value->order->status == 'Chưa xác nhận')
                                <a href="{{ route('order.cancel', $value->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn xoá huỷ đơn hàng {{ $value->product->name }}')"
                                    class="btn btn-primary">Hủy đơn hàng</a>
                                @endif

                                @if ($value->order->status == 'Đã hủy')
                                <a href="{{ route('order.confirm', $value->id) }}"
                                    onclick="return confirm('Bạn có chắc muốn mua lại đơn hàng {{ $value->product->name }}')"
                                    class="btn btn-primary">Mua lại </a>
                                @endif


                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>













        @include('client.layouts.footer')
