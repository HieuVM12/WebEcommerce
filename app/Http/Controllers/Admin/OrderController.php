<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = now()->format('Y-m-d');

        $orders = Order::when($request->date != null, function($q) use ($request){
            return $q->whereDate('created_at',$request->date);
        }, function ($q) use ($todayDate){
            return $q->whereDate('created_at',$todayDate);
        })->when($request->status != null , function ($q) use($request){
            return $q->where('status_message',$request->status);
        })->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
    public function view(int $orderId)
    {
        $order = Order::where('id',$orderId)->first();
        if(!$order){
            return abort(404);
        }
        return view('admin.order.view',compact('order'));
    }
    public function update(Request $request, int $orderId)
    {
        $order = Order::where('id',$orderId)->first();
        if(!$order){
            return abort(404);
        }
        $order->update([
            'status_message' => $request->status,
        ]);
        return redirect()->back()->with('message','Cập nhật trạng thái thành công');
    }
}
