@extends('admin.layouts.main')

@section('home-content')

<div class="card">
  <div class="card-body">
    <h1 class="card-title fw-bold">Quản lý sản phẩm</h1>
    <a href="{{ route('create.product') }}" class="btn btn-success">Thêm mới</a>
    @if (session('success'))
    <div class="alert alert-primary mt-3" role="alert">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger mt-3">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="table-responsive mt-3">
    <table class="table table-striped text-center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên</th>
          <th scope="col">Ảnh bìa</th>
          <th scope="col">Giá gốc</th>
          <th scope="col">Sale</th>
          <th scope="col">Giá sale</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">Hành động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $key => $value)
        <tr>
          <th scope="row">{{ $key+1 }}</th>
          <td>{{ $value->name }}</td>
          <td>{{ $value->cover_image }}</td>
          <td>{{ $value->price }}</td>
          <td>{{ $value->sale }}</td>
          <td>{{ $value->price_new }}</td>
          <td>{{ $value->quantity }}</td>
          <td>{{ $value->status==1 ?"Còn hàng":"Hết hàng" }}</td>
          <td>
            <a class="" href="{{ route('show.product',['id'=>$value->id]) }}">Chi tiết</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{ $products->links() }}
</div>
</div>
@endsection
