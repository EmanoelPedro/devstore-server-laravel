<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function home()
    {
        return view('home', [
            'categories' => Category::all()
        ]);
    }
}
