<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id','desc')->paginate(10);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::where('status','0')->get();
        return view('admin.product.create',compact('categories','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $category = Category::findOrFail($request->category_id);
        $product = $category->products()->create([
            'category_id'=> $data['category_id'],
            'name'=> $data['name'],
            'slug'=> Str::slug($data['name']),
            'small_description'=>$data['small_description'],
            'description' =>$data['description'],
            'original_price'=>$data['original_price'],
            'selling_price'=>$data['selling_price'],
            'quantity'=>$data['quantity'],
            'trending'=>$request->trending==true ? '1' : '0',
            'status'=>$request->status==true?'1':'0',
            'meta_title'=>$data['meta_title'],
            'meta_keyword'=>$data['meta_keyword'],
            'meta_description'=>$data['meta_description'],

        ]);
        if($request->hasFile('image')){
            $uploadPath = 'uploads/product/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $ext = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$ext;
                $imageFile->move($uploadPath,$filename);
                $finalImage = $uploadPath.$filename;
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImage,
                ]);
            }
        }
        if($request->colors){
            foreach($request->colors as $key=>$color){
                $product->productColors()->create([
                    'product_id'=>$product->id,
                    'color_id'=>$color,
                    'quantity'=>$request->color_quantity[$key]??0,
                ]);
            }
        }
        return redirect('admin/product')->with('message','Thêm sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $product_color = $product->productColors()->pluck('color_id')->toArray();
        $colors = Color::whereNotIn('id',$product_color)->get();
        return view('admin.product.edit',compact('product','categories','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->all();
        if($product)
        {
            $product->update([
                'category_id'=> $data['category_id'],
                'name'=> $data['name'],
                'slug'=> Str::slug($data['name']),
                'small_description'=>$data['small_description'],
                'description' =>$data['description'],
                'original_price'=>$data['original_price'],
                'selling_price'=>$data['selling_price'],
                'quantity'=>$data['quantity'],
                'trending'=>$request->trending==true ? '1' : '0',
                'status'=>$request->status==true?'1':'0',
                'meta_title'=>$data['meta_title'],
                'meta_keyword'=>$data['meta_keyword'],
                'meta_description'=>$data['meta_description'],
            ]);
            if($request->hasFile('image')){
                $uploadPath = 'uploads/product/';
                $i = 1;
                foreach($request->file('image') as $imageFile){
                    $ext = $imageFile->getClientOriginalExtension();
                    $filename = time().$i++.'.'.$ext;
                    $imageFile->move($uploadPath,$filename);
                    $finalImage = $uploadPath.$filename;
                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$finalImage,
                    ]);
                }
            }
            if($request->colors){
                foreach($request->colors as $key=>$color){
                    $product->productColors()->create([
                        'product_id'=>$product->id,
                        'color_id'=>$color,
                        'quantity'=>$request->color_quantity[$key]??0,
                    ]);
                }
            }
            return redirect('admin/product')->with('message','Cap nhat sản phẩm thành công');

        }else{
            return redirect('admin/product')->with('message','Khong co sản phẩm');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->productImages()){
            foreach($product->productImages() as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message','Xoa san pham thanh cong');
    }

    public function destroyImage($id)
    {
        $productImage = ProductImage::findOrFail($id);
        if(File::exists($productImage->image))
        {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back();
    }

    public function updateProdColorQty(Request $request, $prod_color_id)
    {

        $productColorData = ProductColor::findOrFail($prod_color_id);

        $productColorData->quantity = $request->qty;
        $productColorData->save();
        return response()->json(['message'=>'Cập nhật số lượng thành công']);
    }

    public function deleteProdColor($prod_color_id)
    {
        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();
        return response()->json(['message'=>'Xoa số lượng thành công']);

    }
}
