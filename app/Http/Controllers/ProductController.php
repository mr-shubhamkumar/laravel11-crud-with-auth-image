<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();

        return view('products.home',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::get();

        return view('products.create',[
            'category'=>$category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name'=>'required|min:5',
            'title'=>'required|min:5',
            'price'=>'required|numeric',
        ];

        if ($request->image != '') {
            # code...
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails())
        {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // insert all data
        $product = new Product();
        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        // incert image
        if ($request->image !== '') {
            # code...
            // here store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext;

            // save image to product folder
            $image->move(public_path('uploads/products'),$imageName);

            // save image name in db
            $product->image = $imageName;
            $product->save();
        }
        return  redirect()->route('products.index')->with('success','Product Added Successfuly');
    }


    public function edit(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $category = Category::get();
        return view('products.edit',[
            'product'=>$product,
            'categorys'=>$category,
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $product = Product::findOrFail($id);
        $rules = [
            'name'=>'required|min:5',
            'title'=>'required|min:5',
            'price'=>'required|numeric',
        ];

        if ($request->image != '') {
            # code...
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails())
        {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        // insert all data
        $product->name = $request->name;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        // incert image
        if ($request->image !== null) {

            // delete old image
            File::delete(public_path('uploads/products/'.$product->image));


            // here store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().".".$ext;

            // save image to product folder
            $image->move(public_path('uploads/products'),$imageName);

            // save image name in db
            $product->image = $imageName;
            $product->save();
        }
        return  redirect()->route('products.index')->with('success','Product update Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        File::delete(public_path('uploads/products/'.$product->image));
        $product->delete();
        return  redirect()->route('products.index')->with('success','Product delete Successfuly');

    }
}
