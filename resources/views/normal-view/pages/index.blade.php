@extends('normal-view.layout.base')

@section('title')
    | Grocery items
@endsection

@section('content')
    <div class="hero-image d-flex justify-content-center align-items-center">
        <div class="container text-white">
            <h1>Enjoy shopping no hassle with cash on delivery</h1>
            <h5>Affordable and Fresh products</h5>
        </div>
    </div>

    <div class="text-white py-2" style="background: #7386D5;">
        <div class="container text-center p-2">
            <h3 class="font-weight-bold"><i class="far fa-list"></i> Categories</h3>
        </div>
    </div>
    <div class="my-3">
        <div class="card p-4 mx-2">
            <div class="row">
                @forelse ($categories as $category)
                    <div class="mb-4 col-md-2">
                        <a href="/category/{{ $category->id }}" style="text-decoration: none;">
                            <div class="card">
                                <img src="{{ Storage::url($category->image) }}" class="card-img-top"
                                    alt="{{ $category->name }}" style="width: 100%; height: 150px;">
                                <div class="card-body">
                                    <span class="card-title text-center">{{ $category->name }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h5 class="text-center">
                        Grocery store has no categories yet. Comeback soon!
                    </h5>
                @endforelse
            </div>
        </div>
    </div>
    <div class="text-white py-2" style="
        background: #7386D5;">
        <div class="d-flex justify-content-center pt-2">
            <div class="col-md-5">
                <form class="form-inline" action="{{ route('search') }}" method="GET">
                    @csrf
                    <div class="input-group">

                        <input type="search" class="form-control" placeholder="Search product..." aria-label="Search"
                            aria-describedby="button-addon2" name="search">
                        <div class="input-group-append">
                            <button class="btn text-white bg-primary" type="submit" id="button-addon2"><i
                                    class="far fa-magnifying-glass"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container text-center">
            <h3 class="font-weight-bold"><i class="far fa-store"></i> Grocery products</h3>
        </div>
    </div>
    <div class="container mt-2">
        <div class="row mb-3">
            @forelse ($allProducts as $product)
                <div class="col-md-4 mt-4" title="{{ $product->description }}">
                    <div class="card card-body p-0">
                        <div
                            class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                            <div id="carouselExample{{ $product->id }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @if (is_array($product->product_image))
                                        @foreach ($product->product_image as $index => $imagePath)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <img src="{{ Storage::url($imagePath) }}" class="d-block" alt="..."
                                                    style="width: 100%; height: 200px;">
                                            </div>
                                        @endforeach
                                    @else
                                        <img src="{{ Storage::url($imagePath) }}" class="d-block" alt="..."
                                            style="width: 100%; height: 200px;">
                                    @endif
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $product->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                            <div class="media-body">
                                <h6 class="media-title font-weight-semibold">
                                    <h5><strong>{{ \Illuminate\Support\Str::limit($product->product_name, 18) }}</strong>
                                    </h5>
                                </h6>
                                <h6 class="mb-3 font-weight-semibold">
                                    &#8369;{{ number_format($product->price, 2) }}</h6>
                            </div>

                            <div>
                                <form action="{{ route('carts') }}" method="POST" class="mb-0">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" hidden value="{{ $product->id }}" name="product_id">
                                    <div class="input-group mb-1">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn border" style="background-color: #555e6451"
                                                onclick="decrementQuantity({{ $product->id }})">-</button>
                                        </span>
                                        <input type="number" value="{{ old('cart_quantity') }}" min="1"
                                            placeholder="@error('cart_quantity')Quantity required @else Enter quantity @enderror"
                                            name="cart_quantity" id="cart_quantity{{ $product->id }}"
                                            class="form-control @error('cart_quantity') is-invalid @enderror">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn border" style="background-color: #555e6451"
                                                onclick="incrementQuantity({{ $product->id }})">+</button>
                                        </span>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100 text-white"><i
                                            class="far fa-cart-shopping mr-2"></i> Add to cart</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center my-5">Grocery store has no products yet. Comeback soon!</h5>
            @endforelse

        </div>
    </div>

@endsection


<style>
    .hero-image {
        background-image: url('/images/bg.png');
        background-size: cover;
        height: 78vh;
        position: relative;
        Border-image: fill 0 linear-gradient(rgba(179, 78, 78, 0.274), #200e0ea6);
    }

</style>

