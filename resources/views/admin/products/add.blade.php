@extends('admin.layouts.main')
@section('home-content')
    <h1>Quản lý sản phẩm</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sản phẩm</h5>
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
            <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Tên</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Danh mục</label>
                    <div class="col-sm-10  ">
                        <select class="form-select " name="category_id">
                            <option value="">Vui lòng chọn</option>
                            @foreach ($category as $cate)
                                <option class="" value="{{ $cate->id }}">{{ $cate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Ảnh bìa</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" id="image" class="form-control">
                        <img id="preview-image" src="#" alt="Ảnh sản phẩm" style="max-width: 200px;">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="images" class="col-sm-2 col-form-label">Ảnh sản phẩm</label>
                    <div class="col-sm-10 image-container">
                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                    </div>


                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Brand</label>
                    <div class="col-sm-10">
                        <input type="text" name="brand" class="form-control" value="{{ old('brand') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá gốc</label>
                    <div class="col-sm-10">
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Sale</label>
                    <div class="col-sm-10">
                        <input type="text" name="sale" class="form-control" value="{{ old('sale') }}">
                    </div>
                </div>
                {{-- <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Giá sale</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="price_new" class="form-control" value="{{ old('price_new') }}">
                    </div>
                </div> --}}
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Số lượng</label>
                    <div class="col-sm-10">
                        <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Size</legend>
                    <div class="col-sm-10 ">
                        @foreach ($size as $item)
                            <input class="form-check-input" name="size_id[]" type="checkbox" value="{{ $item->id }}"
                                id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                {{ $item->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Color</legend>
                    <div class="col-sm-10 ">
                        @foreach ($color as $item)
                            <input class="form-check-input" name="color_id[]" type="checkbox" value="{{ $item->id }}"
                                id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                {{ $item->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Trạng thái</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="1"
                                {{ old('status') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1">
                                Còn hàng
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="2"
                                {{ old('status') == 2 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2">
                                Không còn hàng
                            </label>
                        </div>

                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                        <a href="{{ route('list.product') }}" class="btn btn-success text-white">Danh sách</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
