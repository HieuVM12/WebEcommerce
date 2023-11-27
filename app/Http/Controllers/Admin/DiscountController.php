<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeToUsers;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::paginate(10);
        return view("admin.discount.index",compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'code' => 'required|string|unique:discounts',
            'discount_percentage' => 'required|numeric|max:100',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'description' => 'required|string',
        ];

        // Custom validation messages
        $messages = [
            'valid_to.after_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Discount::create([
            'code' => $request->code,
            'discount_percentage' => $request->discount_percentage,
            'valid_from' =>$request->valid_from,
            'valid_to' => $request->valid_to,
            'description' => $request->description,
            'status' => $request->status==true?'1':'0'
        ]);
        return redirect('admin/discounts')->with('message','Đã thêm mã giảm giá thành công');
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
        $discount = Discount::findOrFail($id);
        return view('admin.discount.edit', compact('discount'));
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
        $rules = [
            'code' => 'required|string|unique:discounts,code,' . $id,
            'discount_percentage' => 'required|numeric|max:100',
            'valid_from' => 'required|date',
            'valid_to' => 'required|date|after_or_equal:valid_from',
            'description' => 'required|string',
        ];

        // Custom validation messages
        $messages = [
            'valid_to.after_or_equal' => 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $discount = Discount::findOrFail($id);
        $discount->update([
            'code' => $request->code,
            'discount_percentage' => $request->discount_percentage,
            'valid_from' =>$request->valid_from,
            'valid_to' => $request->valid_to,
            'description' => $request->description,
            'status' => $request->status==true?'1':'0'
        ]);
        return redirect('admin/discounts')->with('message','Đã cập nhật mã giảm giá thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->back()->with('message','Đã xóa mã giảm giá thành công');
    }

    public function sendCode(int $discountId)
    {
        $discount = Discount::findOrFail($discountId);
        $users = User::paginate(20);
        return view('admin.discount.getUsersList',compact('discount','users'));
    }

    public function postSendCode(int $discountId, Request $request)
    {
        $discount = Discount::findOrFail($discountId);
        $ids = $request->ids;
        if(!$ids){
            return redirect()->back()->with('message','Chọn khách hàng');
        }
        $users = User::whereIn('id', $ids)->get();
        foreach($users as $user){
            Mail::to($user->email)->send(new SendCodeToUsers($user,$discount));
        }
        return redirect()->back()->with('message', "Đã gửi Email thành công");
    }

    public function sendCodeAllUsers(int $discountId)
    {
        $discount = Discount::findOrFail($discountId);
        $users = User::all();
        foreach($users as $user){
            Mail::to($user->email)->send(new SendCodeToUsers($user,$discount));
        }
        return redirect()->back()->with('message', "Đã gửi Email thành công");
    }
}
