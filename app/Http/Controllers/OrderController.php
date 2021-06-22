<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Auth;
use Session; 
use DB; 
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $role = Auth::user()->role;
        $user_id = Auth::id();
        // dd($role);
        if($role == 1){
            $orders = Order::with('orderDetail.product' , 'orderDetail.payment')
                ->whereIn('status', ['Payment Success', 'Payment Accepted', 'Shipping', 'Finish'])
                ->where('user_id', $user_id)
                ->get();
            // dd($orders);
            return view('customer.order', [
                'orders' => $orders,
            ]);
        }else{
            $orders = Order::with('orderDetail.product')
                ->whereIn('status', ['Payment Accepted', 'Shipping', 'Finish'])
                ->get();
            return view('admin.order.list', [
                'orders' => $orders
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $role = Auth::user()->role;
        $order = Order::find($id);
        if ($role == 0) {
            if ($order->status == 'Payment Success') {
                $order->update([
                    'status' => "Payment Accepted",
                    'accepted_payment_date' => Carbon::now(),
                ]);
        
                $order_detail =  DB::table('order_detail')->where('order_id', '=', $id)->first();       
                $product = DB::table('products')->where('id', '=', $order_detail->product_id)->first();
                $sisa =  $product->stock - $order_detail->qty;
                DB::table('products')
                ->where('id', '=', $order_detail->product_id)
                ->update(['stock' => $sisa]);
                // dd($sisa);
                return response()->json([ 'success' => 'Pembayaran Diterima']);
    
            } elseif ($order->status == 'Payment Accepted') {
                $order->update([
                    'status' => "Shipping",
                    'shipment_date' => Carbon::now(),
                ]);
                return redirect()->back();
            }
        } else{
            if ($order->status == 'Shipping') {
                $order->update([
                    'status' => "Finish",
                    'closed_date' => Carbon::now(),
                ]);
            }
            return redirect()->back();
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
        //
    }
}
