@extends('layouts.main')
@section('title', 'Order List')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <div class="privacy about">
            <h3>Daftar <span>Pesanan</span></h3>
        <br>
            <div class="checkout-right">
                <table class="timetable_sub mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="500rem">Gambar Produk </th>
                            <th>Nama Produk</th>
                            <th>Alamat</th>
                            <th>Banyak</th>
                            <th>Total Harga </th>
                            <th>Status </th>
                            <th>Aksi </th>
                        </tr>
                    </thead>
                    <tbody id="boxes">
                    @if($orders->isNotEmpty())
                        @foreach($orders as $order)
                        <tr class="rem1">
                            <td class="invert ids" data-id="{{$order->id}}">
                                {{$loop->iteration}}
                            </td>
                            <td class="invert-image">
                                @foreach($order->orderDetail->product->imgProduct->take(1) as $img)
                                <a href="{{route('detail.product', $order->orderDetail->product_id)}}">
                                    <img src="{{ asset('storage/product/'.$img->path_img) }}" alt=" " class="img-responsive">
                                </a>
                                @endforeach
                            </td> 
                            <td class="invert">{{$order->orderDetail->product->name}}</td>
                            <td class="invert">{{$order->orderDetail->order->address}}</td>
                            <td class="invert"> {{$order->orderDetail->qty}}</td>

                            <td class="invert">Rp <span class="total">{{$order->orderDetail->total}}</span></td>
                            <td class="invert">{{$order->status}}</td>                            
                            <td class="invert">
                                <button class="btn btn-info" data-toggle="modal" data-target="#modalPayment-{{$order->id}}"><i class="fas fa-eye"></i></button>
                                @if($order->status == 'Shipping')
                                    <form action="{{route('customer.order.update', $order->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success"><i class="fas fa-handshake"></i></button>                                    
                                    </form>
                                @endif
                            </td>
                            <td hidden class="code-{{$loop->iteration}}">{{$order->orderDetail->payment_code}}</td>
                        </tr>                        
                        @endforeach
                    @else
                        <p class="text-center">Belum ada pesanan</p> 
                        <br>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- MODAL LIHAT BUKTI PEMBAYARAN -->
    @foreach($orders as $order)
    <div id="modalPayment-{{$order->id}}" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/payment/'.$order->orderDetail->payment->payment) }}" alt=" " class="img-responsive">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection