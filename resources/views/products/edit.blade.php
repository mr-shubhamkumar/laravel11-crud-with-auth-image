@extends('welcome')
@section('title', 'Edit Page')
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

                <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="" class="form-label h6">Name</label>
                            <input type="text" value="{{ old('name',$product->name)}}" name="name" class="@error('name') is-invalid @enderror form-control  " placeholder="Enter Name">
                            @error('name')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label h6">title</label>
                            <input type="text" value="{{ old('title',$product->title)}}" name="title" class="@error('title') is-invalid @enderror form-control  " placeholder="Enter description">
                            @error('title')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label h6">Price</label>
                            <input type="text" value="{{ old('price',$product->price)}}" name="price" class="@error('price') is-invalid @enderror form-control  " placeholder="Enter Price">
                            @error('price')
                            <p class="invalid-feedback"> {{$message}}</p>
                            @enderror
                        </div>
                        <div class=" mb-2">
                            <label for="inputVendor" class="form-label">Product Category</label>
                            <select name="category_id" class="form-select" id="inputVendor">
                                <option value="" disabled>Select Option</option>
                                @foreach ($categorys as $category)
                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected':""}}> {{$category->name }}</option>
                                @endforeach
                            </section>

                        </div>

                        <div class="mb-2">
                            <label for="" class="form-label h6">Description</label>
                            <textarea class="form-control" name="description" cols="10" rows="5">{{ old('description',$product->description)}}</textarea>
                        </div>
                        <div class="mb-2 mt-2">
                            <label for="" class="form-label h6">File</label>
                            <input type="file" name="image" class="form-control  " placeholder="File">
                            @if ($product->image != "")
                            <img width="70" src="{{asset('uploads/products/'.$product->image)}}" alt="">
                            @endif
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
