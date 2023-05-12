@extends('admin.layouts.main')
@section('home-content')
<h1>Quản lý danh mục sản phẩm</h1>
<div class="card">
    <div class="card-body">
      <div class="card-title d-flex justify-content-between">
        <h5 class="fw-bold">Danh mục</h5>
        <a href="{{ route('create.category') }}" class="btn btn-success">Thêm mới</a>
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
            <th scope="col">Trạng thái</th>
            <th scope="col">Hành động</th>
          </tr>
        </thead>
        <tbody>
            @foreach($category as $key => $value)
          <tr>
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $value->name }}</td>
            <td>{{ $value->status==1 ?"Công khai":"Không công khai" }}</td>
            <td>
                <form action="{{ route('destroy.category',['id'=>$value->id]) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <button onclick="return confirm('Bạn có chắc muốn xoá danh mục {{ $value->name }}')"  class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    <a class="btn btn-primary" href="{{ route('edit.category',['id'=>$value->id]) }}"><i class="bi bi-pencil-square"></i></a>
                </form>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>
  {{ $category->links() }}
@endsection
