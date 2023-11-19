<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
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
        $firstSlider = Slider::where('status',0)->first();
        $sliders = Slider::where('status',0)->whereNot('id',$firstSlider->id)->get();
        $products = Product::where('status',0)->where('trending',1)->orderBy('id','desc')->take(8)->get();
        return view('frontend.index',compact('firstSlider','sliders','products'));
    }

    public function detailProduct($slug)
    {
        $product = Product::where('slug',$slug)->where('status',0)->first();
        $productsRelated = Product::where('category_id',$product->category_id)->whereNot('id',$product->id)->take(4)->get();
        return view('frontend.detail',compact('product','productsRelated'));
    }

    public function shop()
    {
        $products = Product::where('status',0)->orderBy('id','desc')->paginate(9);
        return view('frontend.shop',compact('products'));
    }

    public function productsFromCategory($slug)
    {
        $category1 = Category::where('status','0')->where('slug',$slug)->first();
        if($category1){
            $categoryIds = $category1->subcategories()->pluck('id')->prepend($category1->id);
            $products = Product::whereIn('category_id',$categoryIds)->where('status',0)->orderBy('id','desc')->paginate(9);
            return view('frontend.shop',compact('products','category1'));
        }
        return redirect()->back();
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }
    public function thankyou()
    {
        return view('frontend.thankyou');
    }
    public function emptyCart()
    {
        return view('frontend.emptycart');
    }
}
