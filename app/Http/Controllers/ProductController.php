<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::get(),
        ]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        // validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg, jpg, png, gif|max:10000'

        ]);
        // upload Image
        $image_name = time(). '.' . $request->image->extension();
        $request->image->move(public_path('products'), $image_name);

        // save to datebase
        $product = new Product();
        $product->image = $image_name;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Created!!');
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products.edit', [
            'product' => $product,
        ]);
    }
    public function update(Request $request, $id)
    {
         // validate data
         $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg, jpg, png, gif|max:10000'

        ]);

        $product = Product::where('id', $id)->first();

        if (isset($request->image)) {
             // upload Image
            $image_name = time(). '.' . $request->image->extension();
            $request->image->move(public_path('products'), $image_name);
            $product->image = $image_name;
        }

        // save to datebase
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return back()->withSuccess('Product Updated!!');
    }
    public function destory($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();

        return back()->withSuccess('Product Deleted!!');
    }
}
