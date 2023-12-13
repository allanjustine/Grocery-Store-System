@extends('admin.layout.base')

@section('title')
    | Category Create
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="card col-md-6 bg-glass">
                <div class="card-body px-4 py-5 px-md-5">
                    <form method="POST" action="{{ route('admin.category.create') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <div class="form-outline">
                                <input id="image" type="file"
                                    class="form-control pr-4 @error('image') is-invalid @enderror" name="image"
                                    value="{{ old('image') }}" accept="image/*" autocomplete="image" autofocus>
                                <label for="image">Upload category image</label>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-outline">
                                <input type="text" id="name"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autocomplete="name" autofocus />
                                <label class="form-label" for="name">Category name</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            Create Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
