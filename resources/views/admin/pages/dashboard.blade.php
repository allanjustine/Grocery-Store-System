@extends('admin.layout.base')

@section('title')
    | Dashboard
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4">Dashboard</h3>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <a href="/admin/users">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="float-end"><i class="far fa-users mt-3"></i></h1>
                            <h1><strong>{{ App\Models\User::count() }}</strong></h1>
                            <h6><strong>Total Users</strong></h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/categories">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="float-end"><i class="far fa-list mt-3"></i></h1>
                            <h1><strong>{{ App\Models\Category::count() }}</strong></h1>
                            <h6><strong>Total Categories</strong></h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/products">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="float-end"><i class="far fa-box mt-3"></i></h1>
                            <h1><strong>{{ App\Models\Product::count() }}</strong></h1>
                            <h6><strong>Total Products</strong></h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/orders">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="float-end"><i class="far fa-store mt-3"></i></h1>
                            <h1><strong>{{ App\Models\Order::count() }}</strong></h1>
                            <h6><strong>Total Orders</strong></h6>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/admin/logs">
                    <div class="card shadow">
                        <div class="card-body">
                            <h1 class="float-end"><i class="far fa-chart-line mt-3"></i></h1>
                            <h1><strong>{{ App\Models\Log::count() }}</strong></h1>
                            <h6><strong>Total Logs</strong></h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h3 class="mb-4">
            Recent Orders
        </h3>
        <div class="shadow">
            <div class="d-flex justify-content-end">
                <a href="/admin/orders" class="btn btn-info m-2">View orders <i class="far fa-arrow-right"></i></a>
            </div>
            <hr>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h4><strong>Name</strong></h4>
                    </div>
                    <div class="col">
                        <h4><strong>Product</strong></h4>
                    </div>
                    <div class="col">
                        <h4><strong>Time</strong></h4>
                    </div>
                </div>
            </div>
            <hr>

            @forelse ($orders as $order)
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6><strong>{{ $order->user->fname }} {{ $order->user->lname }}</strong></h6>
                        </div>
                        <div class="col">
                            <h6>{{ \Illuminate\Support\Str::limit($order->product->product_name, 18) }}</h6>
                        </div>
                        <div class="col">
                            <h6>{{ $order->created_at->diffForHumans() }}</h6>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card-body">
                    <div>
                        <h6 class="text-center">No one shopping yet</h6>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection

<style>
    .card {
        background-color: #7386D5 !important;
        color: white !important;
    }
</style>
