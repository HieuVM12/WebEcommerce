<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->description = $validatedData['description'];
        if($request->hasFile('image'))
        {
            $file =$request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status == true ? '1' : '0';
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect('/admin/category')->with('message','Them danh mucj thanh cong');
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
        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $validatedData = $request->validated();
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->description = $validatedData['description'];
        if($request->hasFile('image'))
        {
            $path='uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file =$request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];
        $category->status = $request->status == true ? '1' : '0';
        $category->parent_id = $request->parent_id;
        $category->update();
        return redirect('admin/category')->with('message','Cap nhat danh muc thanh cong');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Gọi hàm đệ quy để xóa danh mục cha và tất cả danh mục con
        $this->recursiveDelete($category);

        return redirect()->back()->with('message', 'Xóa thành công');
    }

    private function recursiveDelete($category)
    {
        if ($category->subcategories->isNotEmpty()) {
            // Nếu danh mục có danh mục con, gọi đệ quy cho từng danh mục con
            foreach ($category->subcategories as $subcategory) {
                $this->recursiveDelete($subcategory);
            }
        }

        // Xóa danh mục hiện tại
        $path = 'uploads/category/' . $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
    }
}
