<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $carts = Order::with('orderDetail.product')->where('status', 'Cart')->where('user_id', $user_id)->get();
        // dd($carts);
        return view('customer.cart', [
            'carts' => $carts,
        ]);
    }

    public function waitingPayment()
    {
        $user_id = Auth::id();
        $carts = Order::with('orderDetail')->where('status', 'Waiting Payment')->where('user_id', $user_id)->get();

        // $payment = Payment::with('orderDetail')->get();
        // $order_detail = OrderDetail::withCount('payment')->get();

        // $order = OrderDetail::join('orders', 'orders.id', '=', 'order_detail.order_id' )
        // ->join('payments', 'payments.payment_code', '=', 'order_detail.payment_code' )
        // ->where('orders.status', '=', 'Waiting Payment')
        // ->where('orders.user_id', '=', $user_id)
        // ->get();

        // dd($payment);

        return view('customer.waiting_payment', [
            'carts' => $carts
        ]);
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

        // cek apakah qty kurang dari sama dengan 0
        if ($request->qty <= 0) {
            // jika iya maka akan menampilakn notifikasi gagal
            Session::flash('gagal', 'Minimal Barang yang dibeli 1');
            return redirect()->back();
        } elseif ($request->qty > $request->stock) {
            // jika qty melebihi stock, maka akan menampilkan notifikasi gagal
            Session::flash('gagal', 'Maksimal pembelian ' . $request->stock . ' item, kurangi pembelianmu');
            return redirect()->back();
        } else {
            // jika qty tidak melebihi stock dan tidak kurang dari 0
            // validasi 
            $this->validate($request, [
                'qty'           => 'required|numeric',
                'total'         => 'required|numeric',
            ]);

            // mendapatakan user id
            $user_id = Auth::id();

            // cek apakah ada produk yang sama?
            $order_detail = OrderDetail::where('product_id', $request->product)->first();
            // dd($order_detail);
            if ($order_detail == null) {
                // jika db masih kosong
                $order = Order::create([
                    'user_id'       => $user_id,
                    'status'        => 'Cart',
                ]);

                $create_order_detail = OrderDetail::create([
                    'order_id'      => $order->id,
                    'product_id'    => $request->product,
                    'qty'           => $request->qty,
                    'total'         => $request->total
                ]);
            } else {
                if ($order_detail->order->status == 'Cart') {
                    // jika ada produk yang sama, maka hanya perlu mengubah db
                    $order_detail->update([
                        'qty'           => $request->qty + $order_detail->qty,
                        'total'         => $request->total + $order_detail->total,
                    ]);
                } else {
                    // jika tidak ada produk yang sama maka buat baru di db
                    $order = Order::create([
                        'user_id'       => $user_id,
                        'status'        => 'Cart',
                    ]);

                    $create_order_detail = OrderDetail::create([
                        'order_id'      => $order->id,
                        'product_id'    => $request->product,
                        'qty'           => $request->qty,
                        'total'         => $request->total
                    ]);
                }
            }

            Session::flash('success', 'Produk Berhasil Ditambahkan ke Keranjangmu');

            return redirect()->back();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $order_detail = OrderDetail::where('order_id', $request->id)->first();

        $this->validate($request, [
            'qty'           => 'required|numeric',
            'total'         => 'required|numeric',
        ]);

        $order_detail->update([
            'qty'           => $request->qty,
            'total'         => $request->total,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $cart)
    {
        $cart->delete();

        Session::flash('success', 'Produk Berhasil Dihapus dari KerangjangMu');

        return redirect()->back();
    }

    public function checkout(Request $request)
    {
        // dd($request);
        $ids = $request->ids;
        $carts = Order::whereIn('id', explode(",", $ids))->get();
        // dd($carts);
        return view('customer.checkout', [
            'carts' => $carts,
        ]);
    }

    public function address(Request $request)
    {
        $ids = $request->order;
        $carts = Order::whereIn('id', explode(",", $ids))->get();

        if ($request->address != null) {
            // dd($request);

            $user_id = Auth::id();
            // $ids = $request->order;
            $orders = Order::where('status', 'Waiting Payment')->where('user_id', $user_id)->first();

            // dd($orders);    
            if ($orders == null) {

                $payment_code = Str::uuid();

                $payment = Payment::create([
                    'payment_code' => $payment_code,
                    'total_payment' => $request->total_payment
                ]);

                $order = Order::whereIn('id', explode(",", $ids))->update([
                    'status' => 'Waiting Payment',
                    'address' => $request->address,
                    'chekout_date' => Carbon::now(),
                ]);

                $order_detail = OrderDetail::whereIn('order_id', explode(",", $ids))->update([
                    'payment_code' => $payment_code,
                ]);
                // dd('hlo');
                // dd($ids);

                Session::flash('success', 'Alamat sudah disimpan, lakukan pembayaran untuk tahap selanjutnya');
                $return = redirect()->route('customer.payment.index');
            } else {
                Session::flash('gagal', 'Ada barang sedang menunggu pembayaran. Lakukan pembayaran terlebih dahulu ');
                $return = view('customer.checkout', [
                    'carts' => $carts,
                ]);
            }
        } else {
            Session::flash('gagal', 'Alamat wajib di isi');
            $return = view('customer.checkout', [
                'carts' => $carts,
            ]);
        }


        return $return;
    }
}
