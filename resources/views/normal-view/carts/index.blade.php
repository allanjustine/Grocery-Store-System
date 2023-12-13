@extends('normal-view.layout.base')

@section('title')
    | Shopping cart
@endsection

@section('content')
    <div class="container py-5">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show text-center mt-5" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row d-flex justify-content-center">
            <h1 class="mb-5">Shopping cart</h1>
            <!-- Single item -->
            <div class="row">
                @forelse ($carts as $cart)
                    <div class="col-lg-3 col-md-12 mb-4">
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

                    <div class="col-lg-5 col-md-6 mb-4">
                        <!-- Data -->
                        <h4><strong>{{ $cart->product->product_name }}</strong></h4>
                        <!-- Data -->
                        <!-- Quantity -->

                        <span>Quantity x{{ $cart->cart_quantity }}
                        </span><br>
                        <br>
                        <span><a class="btn btn-primary" href="/carts/{{ $cart->id }}">
                                Update
                                quantity</a></span>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">

                        <!-- Price -->
                        <p class="text-start">
                            <strong>Sub total: &#8369;{{ number_format($cart->product->price, 2) }}</strong>
                        </p>

                        <p><strong>Total:
                                &#8369;{{ number_format(
                                    $carts->sum(function ($cart) {
                                        return $cart->product->price * $cart->cart_quantity;
                                    }),
                                    2,
                                ) }}
                            </strong>
                        </p>

                        <form action="{{ route('delete-cart', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                title="Remove item">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                            <a href="/confirm-order/{{ $cart->id }}" class="btn btn-info text-white btn-sm me-1 mb-2"
                                data-mdb-toggle="tooltip" title="Checkout">
                                <i class="fas fa-cart-circle-check"></i> Checkout
                            </a>
                        </form>
                        <!-- Quantity -->
                        <!-- Price -->
                    </div>
                @empty
                    <h3 class="text-center"><a href="/">Browse all products</a></h3>
                    <h3 class="text-center">No items in cart.</h3>
                @endforelse
            </div>
            <!-- Single item -->

        </div>
    </div>
@endsection
