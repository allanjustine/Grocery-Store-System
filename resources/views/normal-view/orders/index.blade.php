@extends('normal-view.layout.base')

@section('title')
    | Shopping Oders
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
            <h1 class="mb-5">Shopping orders</h1>
            <!-- Single item -->
            <div class="row">
                @forelse ($orders as $order)
                    <div class="col-lg-3 col-md-12 mb-4">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded ml-5" data-mdb-ripple-color="light">
                            <div id="carouselExample{{ $order->id }}" class="carousel slide">
                                <div class="carousel-inner">
                                    @if (is_array($order->product->product_image))
                                        @foreach ($order->product->product_image as $index => $imagePath)
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
                                    data-bs-target="#carouselExample{{ $order->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExample{{ $order->id }}" data-bs-slide="next">
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
                        <p><strong>{{ $order->product->product_name }}</strong></p>
                        <div class="d-flex" style="max-width: 300px">
                            <div class="form-outline"></label>
                                <label class="form-label" for="form1">Quantity
                                    x{{ $order->order_quantity }}
                            </div>
                        </div>

                        <!-- Price -->
                        <p class="text-start">
                            <strong>Sub total: &#8369;{{ number_format($order->product->price, 2) }}</strong>
                        </p>
                        <p class="text-start">
                            <strong>Total:
                                &#8369;{{ number_format($order->product->price * $order->order_quantity, 2) }}</strong>
                        </p>
                        <!-- Data -->
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <!-- Quantity -->
                        <h4><strong>{{ $order->item_code }}</strong></h4>

                        @if ($order->status == 'Pending')
                            <h6>
                                Pending...
                            </h6>
                        @elseif($order->status == 'Out for delivery')
                            <h6>
                                Out for delivery...
                            </h6>
                        @elseif($order->status == 'Delivered')
                            <h6>Delivered...
                            </h6>
                        @elseif($order->status == 'Paid')
                            <h6><i class="far fa-check"></i>
                                Paid...
                            </h6>
                        @endif

                        @if ($order->status == 'Delivered')
                            <p>
                                <a class="btn btn-danger text-white" href="#">Pending
                                    payment...</a>
                            </p>
                        @endif

                        @if ($order->status == 'Pending')
                            <a href="#" class="btn btn-danger btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                                title="Remove item" data-bs-toggle="modal" data-bs-target="#remove{{ $order->id }}">
                                <i class="fas fa-trash"></i> Cancel
                            </a>
                        @endif
                    </div>
                    @include('normal-view.orders.cancel')
                @empty
                    <h3 class="text-center mt-5">You have no orders yet.</h3>
                    <h5 class="text-center"><a href="/">Go shopping</a></h5>
                @endforelse
            </div>
            <!-- Single item -->
        </div>


        <div><strong>Grand total:
                &#8369;{{ number_format(
                    $orders->sum(function ($order) {
                        return $order->product->price * $order->order_quantity;
                    }),
                    2,
                ) }}
            </strong>
        </div>
    </div>
@endsection
