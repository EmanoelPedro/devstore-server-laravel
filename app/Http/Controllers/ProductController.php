<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPhotoRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductPhoto;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $data = $request->validated();
        
        $product = Product::create($data);

        if($product->id) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product registered successfully'
            ]);
        }
    }

    public function addPhoto(StoreProductPhotoRequest $request) 
    {
        $data = $request->validated();

        $product = Product::find($data['product_id']);
        if(empty($product)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product does not exist'
            ]);
        } else if (!$product->photos()->where('order','=',$data['order'])->exists()) {
            echo "<h1>Respeita monenge!</h1>";
            die();
        }

        $photo = $request->file('photo')->storePublicly("products/{$data['product_id']}/");

        if(empty($photo)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving image'
            ]);
        }


        // $product->photos()->create([
        //    'product_id' => $data['product_id'],
        //    'order' => $data['order'],
        //    'path' => $photo
        // ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
