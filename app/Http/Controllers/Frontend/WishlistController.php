<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __construct()
    {
        $categories = Category::where('status','0')->get();
        view()->share([
            'categories' => $categories,
        ]);
    }
    public function index()
    {
        return view('frontend.wishlist.index');
    }
}
