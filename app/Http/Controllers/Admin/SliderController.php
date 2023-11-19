<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
        $slider = new Slider();
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        if($request->hasFile('image'))
        {
            $file =$request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $slider->image = $filename;
        }
        $slider->status = $request->status==true?'1':'0';
        $slider->save();
        return redirect('admin/slider')->with('message','Them Slider thanh cong');

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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit',compact('slider'));
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
        $slider = Slider::findOrFail($id);
        $data = $request->all();
        $slider->title = $data['title'];
        $slider->description = $data['description'];
        if($request->hasFile('image'))
        {
            $path='uploads/slider/'.$slider->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file =$request->file('image');

            $ext = $file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
            $slider->image = $filename;
        }
        $slider->status = $request->status==true?'1':'0';
        $slider->save();
        return redirect('admin/slider')->with('message','Cap nhat Slider thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect('admin/slider')->with('message','Xoa slider thanh cong');
    }
}
