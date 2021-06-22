@extends('layouts.main')
@section('title', 'Waiting Payment')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <div class="privacy about">
            <h3>Menunggu <span>Pembayaran</span></h3>
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
                        </tr>
                    </thead>
                    <tbody id="boxes">
                    @if($carts->isNotEmpty())
                        @foreach($carts as $cart)
                        <tr class="rem1">
                            <td class="invert ids" data-id="{{$cart->id}}">
                                {{$loop->iteration}}
                            </td>
                            <td class="invert-image">
                                @foreach($cart->orderDetail->product->imgProduct->take(1) as $img)
                                <a href="{{route('detail.product', $cart->orderDetail->product_id)}}">
                                    <img src="{{ asset('storage/product/'.$img->path_img) }}" alt=" " class="img-responsive">
                                </a>
                                @endforeach
                            </td> 
                            <td class="invert">{{$cart->orderDetail->product->name}}</td>
                            <td class="invert">{{$cart->orderDetail->order->address}}</td>
                            <td class="invert"> {{$cart->orderDetail->qty}}</td>

                            <td class="invert">Rp <span class="total">{{$cart->orderDetail->total}}</span></td>
                            <td hidden class="code-{{$loop->iteration}}">{{$cart->orderDetail->payment_code}}</td>
                        </tr>                        
                        @endforeach
                    @else
                        <p class="text-center">Tidak ada pembelian yang belum dibayar</p> 
                        <br>
                    @endif
                    </tbody>
                </table>
            </div>

            <br>
            <div class="text-right">
                <strong id="total" class="text-align-right"></strong> <br> <br>
                @if($carts->isNotEmpty())
                <button class="btn btn-danger" >Batalkan</button>
                <button class="btn btn-info" data-toggle="modal" data-target="#modalUpload">Upload Bukti Pembayaran</button>
                @endif
            </div>

            <div class="clearfix"> </div>


			<div class="clearfix"></div>
        </div>
    </div>
    <!-- Modal Upload Bukti Pembayaran -->
    <div id="modalUpload" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('customer.payment.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Upload Bukti Pembayaran</label>
                            <input name="payment" type="file" class="form-control" required autofocus>
                            <input type="text" name="id" hidden id="id">
                            <input type="text" name=code hidden id="code">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- //top products -->
</div>
@endsection

@section('checkout')
<script>
    $(window).load(function() {
        var allTotal= [];
        var subTotal = 0
        $(".total").each(function() {  
            allTotal.push(parseInt($(this).text()));
        }); 
        for(i = 0; i <allTotal.length; i++){
            subTotal += allTotal[i];
        }
        $('#total').text("Total Semua : Rp " + subTotal );

        

        
    });
</script>

<script>
$(document).ready(function(){
    var allIds= [];
        $(".ids").each(function() {  
            allIds.push(parseInt($(this).attr('data-id')));
        }); 
        $('#id').val(allIds);

    var code = $(".code-1").text();
    console.log(code);
    $('#code').val(code);
});
</script>
@endsection