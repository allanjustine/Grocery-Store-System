@extends('admin.layout.base')

@section('title')
    | Product Create
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4">Create product</h3>
        <div class="d-flex justify-content-center">
            <div class="card col-md-7">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="{{ route('admin.products.create') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="mb-4">
                                <div class="form-outline">
                                    <input id="product_image" type="file"
                                        class="form-control pr-4 @error('product_image') is-invalid @enderror"
                                        name="product_image[]" value="{{ old('product_image') }}" accept="image/*"
                                        autocomplete="product_image" multiple>
                                    <label for="product_image">Upload product image</label>
                                    @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="text" id="product_name"
                                        class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                        value="{{ old('product_name') }}" autocomplete="product_name" autofocus />
                                    <label class="form-label" for="product_name">Product name</label>
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <div class="form-outline">
                                        <select name="category_id" id="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            name="category_id" autocomplete="category_id" autofocus>
                                            <option selected hidden value="">Select Category</option>
                                            <option disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label" for="category_id">Select Category</label>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>The category field is required.</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="number" id="stock"
                                        class="form-control @error('stock') is-invalid @enderror" name="stock"
                                        value="{{ old('stock') }}" autocomplete="stock" autofocus />
                                    <label class="form-label" for="stock">Stock</label>
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <input type="number" id="price"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price') }}" autocomplete="price" autofocus />
                                    <label class="form-label" for="price">Price</label>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Create product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
