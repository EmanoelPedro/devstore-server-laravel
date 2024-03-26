<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductPhotoRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $product = Product::find($id)->first();
        $photos = $product->photos->all();
        return view('product', ['product' => $product, 'photos' => $photos]);
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

        $data['slug'] = Str::slug($data['name'], '-');
        $data['code'] = Str::upper(Str::random(8));

        $product = Product::create($data);

        if ($product->id) {
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

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product does not exist'
            ]);
        } else if ($product->photos()->where('order', '=', $data['order'])->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'error saving image'
            ]);
        }

        $photoPath = $request->file('photo')->storePublicly("products/{$data['product_id']}", 'public');

        $photoUrl = asset("storage/" . $request->file('photo')
                ->storePublicly("products/{$data['product_id']}", 'public'));

        if (empty($photoPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving image'
            ]);
        }

        $photo = $product->photos()->create([
            'product_id' => $data['product_id'],
            'order' => $data['order'],
            'path' => $photoPath,
            'url' => $photoUrl
        ]);

        if (!$photo) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error saving image'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Image saved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product)
    {
        $product = Product::where('slug', $product)->first();
        return view('product', ['product' => $product, 'photos' => $product->photos->all()]);
        var_dump($product);
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
        $data = $request->validated();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $product = Product::find($product);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'failed to delete product'
            ], 400);
        }
        // if($product->photos->isNotEmpty()){
        //     foreach($product->photos as $photo) {
        //         Storage::disk('public')->delete($photo->path);
        //         Storage::disk('public')->deleteDirectory("products/{$product->id}");
        //     }
        // }

        // $result = $product->delete();
        if ($result = true) {
            return response()->json([
                'status' => 'success',
                'message' => 'product deleted successfully'
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'failed to delete product'
        ], 400);
    }

    public function addToCart(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'numeric|max_digits:60'
        ]);

        $productId = $data['product_id'];

        $quantity = (!empty($data['quantity'])) ? $data['quantity'] : 1;

        $user = Auth::user();

        if (!empty($user) && $user->addToCart($productId, $quantity) !== false) {
            return response()->json([
                'status' => 'success',
                'message' => 'product added successfully',
                'product_id' => $data['product_id'],
                'product_quantity' => $user->getOpenCart()->products()->find($productId)->pivot->quantity,
                'product_price' => $user->getOpenCart()->products()->find($productId)->price,
                'cart_total_items' => $user->getOpenCart()->products()->count(),
                'cart_total_value' => $user->getOpenCart()->getTotalValue()
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'failed to add the product'
            ], 400);
        }
    }

    public function removeFromCart(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'numeric|max_digits:60'
        ]);

        $productId = $data['product_id'];

        $quantity = (!empty($data['quantity'])) ? $data['quantity'] : 1;

        $user = Auth::user();

        if (!empty($user) && $user->removeFromCart($productId, $quantity) !== false) {
            $qtd = 0;
            if ($user->getOpenCart()->products()->find($productId)) {
                $qtd = $user->getOpenCart()->products()->find($productId)->pivot->quantity;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'product removed successfully',
                'product_id' => $data['product_id'],
                'product_quantity' => $qtd,
                'product_price' => Product::find($productId)->price,
                'cart_total_items' => $user->getOpenCart()->products()->count(),
                'cart_total_value' => $user->getOpenCart()->getTotalValue(),
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'failed to add the product'
            ], 400);
        }
    }
}
