@extends('normal-view.layout.base')

@section('title')
    | Order summary
@endsection

@section('content')
    <div class="container py-5">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <h1 class="mb-3">Order summary</h1>
            <div class="card-body">
                <!-- Single item -->
                <div class="row">
                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded ml-5" data-mdb-ripple-color="light">
                            <div id="carouselExample{{ $cart->product->id }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @if (is_array($cart->product->product_image))
                                        @foreach ($cart->product->product_image as $index => $imagePath)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($imagePath) }}" class="d-block w-100"
                                                    style="height: 140px;" alt="...">
                                            </div>
                                        @endforeach
                                    @else
                                        <img src="{{ Storage::url($imagePath) }}" class="d-block w-100"
                                            style="height: 140px;" alt="...">
                                    @endif
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExample{{ $cart->product->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $cart->product->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <a href="#!">
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                                </div>
                            </a>
                        </div>
                        <!-- Image -->
                    </div>

                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                        <!-- Data -->
                        <h4><strong>{{ $cart->product->product_name }}</strong></h4>

                        <div class="form-outline">
                            <input id="form1" min="0" name="order_quantity" hidden
                                value="{{ $cart->cart_quantity }}" type="number" class="form-control" />
                            <label class="form-label" for="form1">Quantity
                                x{{ $cart->cart_quantity }}</label>
                            <br>
                            <span class="text-start">
                                <strong>Sub total: &#8369;{{ number_format($cart->product->price, 2) }}</strong>
                            </span>
                            <br>
                            <span class="text-start">
                                <strong>Total:
                                    &#8369;{{ number_format($cart->product->price * $cart->cart_quantity, 2) }}</strong>
                            </span>
                        </div>
                        <!-- Data -->
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

                        <h5>Select a payment method</h5>
                        <form action="{{ route('orders.create', $cart->product->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="product_id" value="{{ $cart->product->id }}" hidden>
                            <input type="text" name="order_quantity" value="{{ $cart->cart_quantity }}" hidden>

                            <div class="form-outline my-3">
                                <select name="payment_method" id="" class="form-select @error('payment_method') is-invalid @enderror">
                                    <option selected hidden value="">@error('payment_method') Please select a payment method first @else Select a payment method @enderror</option>
                                    <option disabled>Select a payment method</option>
                                    <option value="Cash On Delivery">Cash On Delivery - COD</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary text-white btn-sm me-1 mb-2"
                                data-mdb-toggle="tooltip" title="Add order">
                                <i class="fas fa-cart-circle-check"></i> Place order
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Single item -->
            </div>
        </div>
    </div>
@endsection
