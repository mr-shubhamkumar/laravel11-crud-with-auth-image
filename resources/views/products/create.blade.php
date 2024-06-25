@extends('welcome')
@section('title', 'Create Page')
@section('content')




<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-8 d-flex justify-content-end">
            <a href="{{route('products.index')}}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg my-1">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Create Product</h3>
                </div>

                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="" class="form-label h6">Name</label>
                            <input type="text" value="{{ old('name')}}" name="name" class="@error('name') is-invalid @enderror form-control  " placeholder="Enter Name">
                            @error('name')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label h6">title</label>
                            <input type="text" value="{{ old('description')}}" name="title" class="@error('title') is-invalid @enderror form-control  " placeholder="Enter description">
                            @error('title')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label h6">Price</label>
                            <input type="text" value="{{ old('price')}}" name="price" class="@error('price') is-invalid @enderror form-control  " placeholder="Enter Price">
                            @error('price')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class=" mb-2">
                            <label for="inputVendor" class="form-label">Product Category</label>
                            <select name="category_id" class="form-select" id="inputVendor">
                                <option value="" disabled>Select Option</option>
                                @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </section>

                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label h6">Description</label>
                            <textarea class="form-control" name="description" cols="10" rows="5">{{ old('description')}}</textarea>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label h6">File</label>
                            <input type="file" name="image" class="form-control  " placeholder="File">
                        </div>
                        <div class="d-grid">
                            <button class="btn  btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
