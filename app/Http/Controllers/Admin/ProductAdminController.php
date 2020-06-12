<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductAdminController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }
    public function create(){
        return view('admin.products.create');
    }

    public function edit(Product $product){
        return view('admin.products.edit',compact('product'));
    }

    public function store(Request $request){
        Product::create($request->all());
        return redirect()->route('admin.products.index');

    }
    public function update(Request $request,Product $product)
    {
        $product->update($request->all());
        return redirect()->route('admin.products.index');
    }
    public function destroy(Product $product){

        $product->delete();
        return redirect()->route('admin.products.index');

    }
}
