<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCategoryToProduct;
use App\Http\Requests\RemoveCategoryRequest;
use App\Http\Requests\RemoveCategoryToProduct;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        $data = $request->validated();

        $slugExists = Category::where('slug', Str::slug($data['name'], '-'))->exists();
        $i = 1;
        while($slugExists){
            if ($i > 1) {
                $data['name'] = substr($data['name'], 0, -2);
            }
            $data['name'] = $data['name'] . ' ' . $i;
            $slugExists = Category::where('slug', Str::slug($data['name'], '-'))->exists();
            $i++;
        }

        $data['slug'] = Str::slug($data['name'] , '-');
        $category = Category::create($data);
        if ($category->id) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category registered successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error registering category'
        ]);
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
    public function edit($id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid category id'
            ], 400);
        }

        $category = Category::find($id);
        return view('admin.category.edit-category', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        $slugExists = Category::where('slug', Str::slug($data['name'], '-'))->where('id', '!=', $data['id'])->exists();
        $i = 1;
        while($slugExists){
            $data['name'] = $data['name'] . $i;
            $slugExists = Category::where('slug', Str::slug($data['name'], '-'))->where('id', '!=', $data['id'])->exists();
            $i++;
        }

        $category = Category::find($data['id']);
        $category->name = $data['name'];
        $category->slug = Str::slug($data['name'] , '-');
        if($category->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully'
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Error updating category'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RemoveCategoryRequest $data)
    {
        $data = $data->validated();
        $category = Category::find($data['id']);

        if($category->delete()){
            return response()->json([
                'status' => 'success',
                'message' => 'Category removed successfully'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Error removing category'
        ]);
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
