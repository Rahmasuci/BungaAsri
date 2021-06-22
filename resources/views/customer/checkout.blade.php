@extends('layouts.main')
@section('title', 'CheckOut')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <div class="privacy about">
            <h3>Check<span>Out</span></h3>
<br>
            <div class="checkout-right">
                <table class="timetable_sub mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="500rem">Gambar Produk </th>
                            <th>Banyak</th>
                            <th>Nama Produk</th>
                            <th>Total Harga </th>
                        </tr>
                    </thead>
                    <tbody id="boxes">
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
                            <td class="invert"> {{$cart->orderDetail->qty}}</td>
                            <td class="invert">{{$cart->orderDetail->product->name}}</td>

                            <td class="invert ">Rp <span class="total">{{$cart->orderDetail->total}}</span></td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">

                    <strong id="total" class="text-align-right"></strong>
                </div>
            </div>

            
            <div class="checkout-left">
                <div class="col-md-8">
                    <h4>Masukkan Alamat Pengiriman</h4>
                    <form action="{{route('customer.address')}}" method="post" class="creditly-card-form agileinfo_form">
                        @csrf
                        <section class="creditly-wrapper wrapper">
                            <div class="information-wrapper">
                                <div class="first-row form-group">
                                    <div class="controls">
                                        <input type="text" value="" name="order" hidden id='order_id'> 
                                        <input type="text" value="" name="total_payment" hidden id="total_payment"> 
                                        <br>
                                        <textarea name="address" id="" cols="10" rows="5" class="billing-address-name form-control"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="submit check_out" id="save">Simpan</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>

            <div class="clearfix"> </div>


			<div class="clearfix"></div>
        </div>
    </div>
    <!-- //top products -->
</div>
@endsection

@section('checkout')
<!-- mendapatkan id order -->
<script>
    $(document).ready(function(){
        $('#save').on('click', function(e) {
            var allVals = []; 
            $(".ids").each(function() {  
                allVals.push($(this).attr('data-id'));
            }); 
            $('#order_id').val(allVals);    
            console.log(allVals);
        });
    });
</script>

<!-- mendapatkan nilai total belanja -->
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
        $('#total').text("Total Belanja : Rp " + subTotal );
        $('#total_payment').val( subTotal );

        console.log(allTotal);
    });
</script>
@endsection