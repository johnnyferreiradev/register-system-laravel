<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        $products = Product::all();

        foreach($products as $product) {
            $category = Category::find($product->category_id);
            $product->categoryName = $category->name;
        }

        return view('products', compact('products'));
    }

    public function index()
    {
        $products = Product::all();

        return $products->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('newProduct', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->input('productName');
        $product->stock = $request->input('quantityInStock');
        $product->price = $request->input('productPrice');
        $product->category_id = $request->input('category');
        $product->save();

        return json_encode($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(isset($product)) {
            return json_encode($product);
        } else {
            return response('Product not found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('editProduct', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if(isset($product)) {
            $product->name = $request->input('productName');
            $product->stock = $request->input('quantityInStock');
            $product->price = $request->input('productPrice');
            $product->category_id = $request->input('category');
            $product->save();

            return json_encode($product);
        } else {
            return response('Product not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(isset($product)) {
            $product->delete();
            return response('Ok', 200);
        }

        return response('Product not found', 404);
    }
}
