<?php

namespace App\Http\Controllers;
use App\Http\Resources\ProductLogResource;
use App\Http\Resources\ProductResource;
use App\Models\ProductLog;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      
        try {
            $products = Product::where('id','>',0);
            if($request->input('user_id')){
             $products =$products->where('user_id','=',$request->input('user_id'));
            }
     
            if($request->input('key')){
             $products = $products->where('name', 'like', '%' . $request->input('key'). '%');
            }
            $products =$products->get();

            return response()->json(ProductResource::collection( $products), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create(array_merge($request->validated(), ['user_id' => Auth::id()]));
            return response()->json(new ProductResource($product), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            return response()->json(new ProductResource($product), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
         try {
            $product->update($request->validated());
            return response()->json(new ProductResource($product), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(new ProductResource($product), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function product_logs(  $product_id){
        try {
            $logs = ProductLog::where('product_id','=',$product_id)->orderBy('created_at','DESC')->get();
            return response()->json(ProductLogResource::collection( $logs ), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
