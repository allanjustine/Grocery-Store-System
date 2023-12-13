@extends('admin.layout.base')

@section('title')
    | Orders
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4">Orders</h3>
        <div class="col-sm-12">
            <a href="/admin/orders/create" class="btn btn-primary mb-3 me-2 float-end">
                <i class="fa-solid fa-plus"></i> Create Order
            </a>
            <form action="{{ route('admin.orders.search') }}" method="GET">
                @csrf
                <input type="search" name="search" class="form-control mb-3 mx-2 float-start" style="width: 198px;"
                    placeholder="Search orders...">
                <button class="btn btn-primary"><i class="far fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>Mobile number</th>
                        <th>Date ordered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td><a href="/admin/orders/view/{{ $user->id }}" class="btn btn-primary">{{ $user->orders_count }}<i
                                        class="far fa-folder-open"></i> Open</a></td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="11" class="text-center">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
