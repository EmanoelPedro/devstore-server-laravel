<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminDashboardController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(Auth::user()->getPermissionsViaRoles()->isEmpty()) {
             return redirect()->route('site.home');
         }
            return $next($request);
        });
    }

    public function home()
    {
        $user = User::find(Auth::id());
        $permissions =(array)Auth::user()->getPermissionsViaRoles()->all();
        foreach($permissions as $permission){
            var_dump($permission->name);
        }
        return View('admin.dashboard');
    }

    public function products()
    {
        $products = Product::all();
        return \view('admin.product.products', ['products' => $products]);
    }

    public function createProduct()
    {
        return View('admin.product.create-product', ['categories' => Category::all()]);
    }

    public function editProduct($id)
    {
        $product = Product::find($id)->first();

        return View('admin.product.edit-product',['product' => $product, 'photos' => $product->photos->all()]);

    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.category.categories',['categories' => $categories]);
    }

    public function createCategory()
    {
        return view('admin.category.create-category');
    }
    public function editCategory()
    {
        return view('admin.category.create-category');
    }
}
