<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sections;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $sections=Sections::all();


        $products=Product::all();
       return view('products.products', compact('sections','products')) ;
    }


    public function create()
    {
        //
    }

public function test(){
       $sections=Sections::find(2);
   return $sections->products;
}
    public function store(Request $request)
    {
        $this->validate($request,[
            'Product_name'=>'required',
            'section_id'=>'required'
        ]);
        Product::create([
            'Product_name' => $request->Product_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return redirect('/products');
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(Request $request )
    {
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $Products = Product::findOrFail($request->pro_id);

        $Products->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $id,
        ]);

        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }


    public function destroy(Request $request)
    {
        $Products = Product::findOrFail($request->pro_id);
        $Products->delete();
        session()->flash('delete', 'تم حذف المنتج بنجاح');
        return back();
    }
}
