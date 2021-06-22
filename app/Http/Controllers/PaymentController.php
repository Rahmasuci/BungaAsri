<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Session; 
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
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
        if($role == 1){
            $carts = Order::with('orderDetail.payment')
                ->where('status', 'Waiting Payment')
                ->where('user_id', $user_id)
                ->get();
            // dd($carts);
            return view('customer.waiting_payment', [
                'carts' =>$carts
            ]);
        }else{
            $orders = Order::with('user', 'orderDetail.product', 'orderDetail.payment')
                ->where('status', 'Payment Success')
                ->get();
            // dd($orders);
            return view('admin.order.payment', [
                'orders' =>$orders
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
        // dd($request);       
        // cek apakah ada inputan gambar
        if($request->hasFile('payment')){
            // jika ada, maka di proses
            $file = $request->file('payment');
            // mendapatkan ekstensi
            $extension = $file->extension();

            // membuat nama baru angka random dari 1-9999
            $imgPayment = rand(1,9999).'.'.$extension;

            // validasi gambar dengan ukuran max 5mb
            $this->validate($request, ['payment' => 'required|max:2000']);

            // membawa file ke storage
            $path = Storage::putFileAs('public/payment', $file, $imgPayment);

            // simpan gambar di database
            $payment = Payment::where('payment_code', $request->code)->update([
                'payment'      => $imgPayment,
            ]);
            
            $orders = Order::whereIn('id', explode(",",$request->id))->update([
                'payment_date' => Carbon::now(),
                'status' => 'Payment Success'
            ]);
        } else{
            // jika tidak ada maka muncul tulisan "tidak ada gambar"
            return 'tidak ada gambar';
        }

        Session::flash('success', 'Bukti Pembayaran Berhasil Diupload, Tunggu Verifikasi dari Admin.');
 
        return redirect()->route('customer.order.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {   
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
