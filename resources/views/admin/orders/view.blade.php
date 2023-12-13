@extends('admin.layout.base')

@section('title')
    | {{ $user->lname }}, {{ $user->fname }}&apos;s order
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4 text-center">{{ $user->lname }}, {{ $user->fname }}&apos;s orders</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <th>ID no.</th>
                        <th>Item code</th>
                        <th>Product name</th>
                        <th>Category name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total price</th>
                        <th>Status</th>
                        <th>Date ordered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user->orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td><strong>{{ $order->item_code }}</strong></td>
                            <td>{{ $order->product->product_name }}</td>
                            <td>{{ $order->product->category->name }}</td>
                            <td>x{{ $order->order_quantity }}</td>
                            <td>&#8369;{{ number_format($order->product->price, 2) }}</td>
                            <td>&#8369;{{ number_format($order->product->price * $order->order_quantity, 2) }}</td>
                            <td>
                                @if ($order->status == 'Pending')
                                    <span>Pending...</span>
                                @elseif ($order->status == 'Out for delivery')
                                    <span>Out for delivery...</span>
                                @elseif ($order->status == 'Delivered')
                                    <span>Delivered...</span>
                                @else
                                    <span><i class="far fa-check"></i> Paid...</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->diffForHumans() }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.view.manage', $order->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="status" hidden value="{{ $order->status }}">
                                    @if ($order->status == 'Pending')
                                        <button type="submit" class="btn btn-primary">
                                            <i class="far fa-check"></i> Mark as out for delivery...</button>
                                    @elseif ($order->status == 'Out for delivery')
                                        <button type="submit" class="btn btn-primary">
                                            <i class="far fa-check"></i> Mark as delivered...</button>
                                    @elseif ($order->status == 'Delivered')
                                        <button type="submit" class="btn btn-success">
                                            <i class="far fa-check"></i> Mark as paid...</button>
                                    @else
                                        <a href="#" class="btn btn-success">
                                            <i class="far fa-check"></i> Paid...</a>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
