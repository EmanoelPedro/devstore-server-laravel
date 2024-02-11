<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryToProduct;
use App\Http\Requests\RemoveCategoryToProduct;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        var_dump($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function addProduct(AddCategoryToProduct $request)
    {
        $product = Product::find($request->product_id);
        if ($product->categories->contains($request->category_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category already added to product'
            ]);
        }

        $product->categories()->attach($request->category_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category added to product'
        ]);
    }

    public function removeProduct(RemoveCategoryToProduct $request)
    {
        $product = Product::find($request->product_id);
        if (!$product->categories->contains($request->category_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not added to product'
            ]);
        }

        $product->categories()->detach($request->category_id);

        return response()->json([
            'status' => 'success',
            'message' => 'Category removed from product'
        ]);
    }
}
