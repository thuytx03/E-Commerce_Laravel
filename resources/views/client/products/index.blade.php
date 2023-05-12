<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>


        <div class="row px-xl-5 pb-3">
            @foreach ($product as $value)
                @if ($value->status == 1)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <a href="{{ route('san-pham-chi-tiet',['slug'=>$value->slug]) }}">
                                    <img class="img-fluid w-100" src="{{ asset( $value->image) }}"
                                        alt="">
                                </a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $value->name }}</h6>
                                <div class="d-flex justify-content-center">
                                    @if($value->sale != null)
                                    <h6>${{ $value->price_new }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $value->price }}</del></h6>
                                    @else
                                    <h6 class="text-muted ml-2">${{ $value->price }}</h6>

                                    @endif
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ url('/san-pham-chi-tiet/' . $value->slug) }}" class="btn btn-sm text-dark p-0"><i
                                        class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <form action="" method="POST">
                                    @csrf
                                    {{-- <input type="hidden" name="product_id" value="{{ $value->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="price" value="{{ $value->price }}"> --}}
                                    <button type="submit" class="btn btn-sm text-dark p-0"><i
                                            class="fa-solid fa-heart text-primary mr-1"></i>Favorites</button>
                                            
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>




</div>
<!-- Products End -->
