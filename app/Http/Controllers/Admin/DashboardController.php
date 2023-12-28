<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at',now())->count();
        $monthOrder = Order::whereMonth('created_at',now())->count();
        $yearOrder = Order::whereYear('created_at',now())->count();
        return view('admin.dashboard',compact('totalOrder','todayOrder','monthOrder','yearOrder'));
    }
}
