<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::all();
        return response()->json([$data]);
    }
    public function create()
    {
        //
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        if(Product::create($data)){
            return response()->json(["Create product success."]);
        }else{
            return response()->json(["Create product error."]);
        }
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $data = Product::find($id);
        return response()->json([$data]);
    }
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);
        if($product->update($data)){
            return response()->json(["Edit product success."]);
        }else{
            return response()->json(["Edit product error."]);
        }
    }
    public function destroy(string $id)
    {
        if(Product::where('id',$id)->delete()){
            return response()->json(["Delete product success."]);
        }else{
            return response()->json(["Delete product error."]);
        }
    }
    public function change(Request $request)
    {
        $product = Product::find($request->id);
        if($product) {
            if($product->status == 1) {
                $product->status = 1;
            } else {
                $product->status = 0;
            }
            $product->save();

            return response()->json([
                'status' => true,
                'message' => "Change status success!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Change status error!"
            ]);
        }
    }
}