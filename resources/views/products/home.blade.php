

@extends('welcome')

@section('title', 'Home Page')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{route('products.create')}}" class="btn btn-dark">Create</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @if (Session::has('success'))
        <div class="col-md-10 mt-4">
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        </div>
        @endif
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-1">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Product</h3>
                </div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <th>IMAGE</th>
                            <th>NAME</th>
                            <th>TILE</th>
                            <th>PRICE</th>
                            <th>Category</th>
                            <th>CREATED_AT</th>
                            <th>ACTION</th>
                        </tr>
                      @if ($products->isNotEmpty())
                      @foreach ($products as $item)
                      <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            @if ($item->image != '')
                                <img width="50" src="{{asset('uploads/products/'.$item->image)}}" alt="">
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{ $item['category']['name']}}</td>
                        <td>{{\Carbon\Carbon::parse($item->created_at)->format('d,M,y')}}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.edit',$item->id)}}" class="btn btn-dark">Edit</a>
                                <div>
                                    <form action="{{route('products.destroy',$item->id)}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>

                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                      @endforeach
                      @endif


                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
@else
<div class="container text-center">
    <h1>Place login</h1>
</div>
@endauth

@endsection
