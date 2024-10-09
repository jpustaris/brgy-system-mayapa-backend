<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['category'])->get();
        return response()->json(['status' => 'success', 'data' => $products], 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Product::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $product = Product::create($validator->validated());

        return response()->json(['status' => 'success', 'data' => $product], 201);
    }

    public function fetchAllProductInOrder($order_id){
        $order = Order::find($order_id);
        $orderItems = $order->orderItems; // This returns all the items in the order.
        
        foreach ($orderItems as $item) {
            echo $item->product->name; // Access the related product details for each order item.
        }
        if (!is_null($orderItems)) {
            return response()->json([
                'orderItems' =>$orderItems ,
            ],200);
        }else{
            return response()->json([
                'orderItems' =>"No data" ,
            ],500);
        }
    }

    public function fetchProductStock($product_id){
        $product = Product::find($product_id);
        $stockQuantity = $product->inventory->quantity; // Access product stock via the Inventory model.

        if (!is_null($stockQuantity)) {
            return response()->json([
                'stockQuantity' =>$stockQuantity ,
            ],200);
        }else{
            return response()->json([
                'stockQuantity' =>"No data" ,
            ],500);
        }
    }

    public function fetchProductsByCategory($category_id){
        $category = Category::find($category_id);
        $products = $category->products; // This returns all products under that category.

        if (!is_null($products)) {
            return response()->json([
                'products' =>$products ,
            ],200);
        }else{
            return response()->json([
                'products' =>"No data" ,
            ],500);
        }
    }



    public function show(Product $product)
    {
        return response()->json(['status' => 'success', 'data' => $product], 200);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $product->update($validator->validated());

        return response()->json(['status' => 'success', 'data' => $product], 200);
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $product->delete();

        return response()->json(['status' => 'success', 'message' => 'Product deleted successfully'], 200);
    }
}
