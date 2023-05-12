@extends('admin.layouts.main')
@section('home-content')
    <h1>Quản lý đơn hàng</h1>
    <div class="card">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h5 class="fw-bold">Đơn hàng</h5>
                {{-- <a href="{{ route('create.category') }}" class="btn btn-success">Thêm mới</a> --}}
            </div>
            @if (session('success'))
                <div class="alert alert-primary">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
            <!-- Table with stripped rows -->
            <table class="table table-striped text-center ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $value)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->email }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->total }}</td>
                            <td>{{ $value->status }} </td>
                            <td>
                                <a href="{{ route('order.detail', $value->id) }}" class="btn btn-primary ">Chi tiết</a>
                                @if ($value->status == 'Chưa xác nhận')
                                    <a href="{{ route('order.confirm', $value->id) }}" class="btn btn-success">Xác nhận</a>
                                    <a href="{{ route('order.cancel', $value->id) }}" class="btn btn-danger">Hủy</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
    </div>
    {{ $orders->links() }}
@endsection
