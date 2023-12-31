<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
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

    public function createProduct() 
    {
        return View('admin/create-product');
    }
}
