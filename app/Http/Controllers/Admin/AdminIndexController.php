<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminIndexController extends Controller
{
    public function adminDashboard()
    {
        $orders = Order::with(['product', 'user'])->orderBy('created_at', 'asc')->get();
        return view('admin.pages.dashboard', compact('orders'));
    }
}
