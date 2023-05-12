@extends('admin.layouts.main')
@section('home-content')
    <h1>Quản lý danh mục sản phẩm</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Danh mục</h5>
            @if (session('success'))
                <div class="alert alert-success">
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
            <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tên</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1"
                                {{ old('status') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="2"
                                {{ old('status') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2">
                                Không công khai
                            </label>
                        </div>

                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <button type="reset" class="btn btn-danger">Thêm mới</button>
                        <a href="{{ route('list.category') }}" class="btn btn-success">Danh sách</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
