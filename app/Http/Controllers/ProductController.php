<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->validate(request(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'supplier_id' => 'required|numeric',
            'product_category_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
          ]);
          $model = Product::create($request->all());

            if ($request->hasFile('image')) {
                $request->file('image')->store('public/images');
                
                // ensure every image has a different name
                $file_name = $request->file('image')->hashName();
                
                request()->image->move(public_path('images'), $file_name);
                // save new image $file_name to database
                $model->update(['image' => $file_name]);
            }

  
          return back()->with('success', 'Le produit a bien été ajouté');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('products.edit',compact('product','id'));
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
        $this->validate(request(), [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'supplier_id' => 'required|numeric',
            'product_category_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        $product->name = $request->get('name');
        request()->image->move(public_path('images'), $imageName);

        $product->supplier_id = $request->get('supplier_id');
        $product->product_category_id = $request->get('product_category_id');
        $product->quantity = $request->get('quantity');
        $product->price = $request->get('price');
        $product->save();
        return redirect('products')->with('success','Le produit a bien été mis à jour');
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
        $product->delete();
        return redirect('products')->with('success','Le produit à bien été supprimé');
    }
}
