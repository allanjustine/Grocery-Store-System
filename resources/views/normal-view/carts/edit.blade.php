@extends('normal-view.layout.base')

@section('title')
    | Update Cart
@endsection

@section('content')
    <div class="container py-5">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row my-4">
            <h1 class="mb-3">Cart item</h1>
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
                        <!-- Data -->
                        <form action="{{ route('update.cart', $cart->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Quantity -->
                            <div class="d-flex" style="max-width: 300px">
                                <div class="form-outline">
                                    <div class="input-group mb-1">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn border" style="background-color: #555e6451"
                                                onclick="decrementQuantity({{ $cart->id }})">-</button>
                                        </span>
                                        <input type="number" value="{{ $cart->cart_quantity }}" min="1"
                                            placeholder="@error('cart_quantity')Quantity required @else Enter quantity @enderror"
                                            name="cart_quantity" id="cart_quantity{{ $cart->id }}"
                                            class="form-control @error('cart_quantity') is-invalid @enderror">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn border" style="background-color: #555e6451"
                                                onclick="incrementQuantity({{ $cart->id }})">+</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary text-white btn-sm me-1 mb-2"
                                data-mdb-toggle="tooltip" title="Update">Update
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Single item -->
            </div>
        </div>
    </div>
@endsection
