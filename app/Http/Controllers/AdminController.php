<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->count();
        $customers = DB::table('users')->where('role', 1)->count();
        $waiting = DB::table('orders')->where('status', 'Waiting Payment')->count();
        // dd($waiting);
        return view('admin.index', [
            'orders' => $orders,
            'customers' => $customers,
            'waiting' => $waiting
        ]);
    }
}
