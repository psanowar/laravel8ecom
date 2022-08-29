<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::orderby('id', 'asc')->get();
        return view('backend.pages.product.productmanage', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.pages.product.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rqst)
    {
        $product = new Product();
        $rqst->validate([
            'name'=>'required',
            'description'=>'required|max:200',
            'costPrice'=>'required|max:200',
            'salePrice'=>'required',
            'quantity'=>'required'
        ]); 
        $product->pname= $rqst->name;
        $product->description= $rqst->description;
        $product->category= $rqst->category;
        $product->size= $rqst->size;
        $product->costPrice= $rqst->costPrice;
        $product->salePrice= $rqst->salePrice;
        $product->quantity= $rqst->quantity;
        $product->status= $rqst->status;
        $product->save();
        return redirect()->route('/');
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
        $product=Product::find($id);
        return view('backend.pages.product.editproduct', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $rqst, $id)
    {
        $product =Product::find($id);
        $product->pname= $rqst->name;
        $product->description= $rqst->description;
        $product->category= $rqst->category;
        $product->size= $rqst->size;
        $product->costPrice= $rqst->costPrice;
        $product->salePrice= $rqst->salePrice;
        $product->quantity= $rqst->quantity;
        $product->status= $rqst->status;
        $product->update();
        return redirect()->route('manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete=Product::find($id);
        $delete->delete();
        return redirect()->route('manage');
    }
}
