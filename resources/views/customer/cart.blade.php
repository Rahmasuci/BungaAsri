@extends('layouts.main')
@section('title', 'KeranjangMu')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <div class="privacy about">
            <h3>Keranjang<span>Mu</span></h3>
<br>
            <div class="checkout-right">
                <table class="timetable_sub mt-4">
                    <thead>
                        <tr>
                            <th>Pilih Semua <br> <input type="checkbox" name="" id="master" class=""></th>
                            <th width="500rem">Gambar Produk </th>
                            <th>Banyak</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="boxes">
                        @if($carts->isNotEmpty())
                            @foreach($carts as $cart)
                            <tr class="rem1">
                                <td class="invert">
                                    <input type="checkbox" name="" id="check-{{$cart->id}}" class="sub_chk" data-id="{{$cart->id}}" data-price="{{$cart->orderDetail->product->price}}">
                                </td>
                                <td class="invert-image">
                                    @foreach($cart->orderDetail->product->imgProduct->take(1) as $img)
                                    <a href="{{route('detail.product', $cart->orderDetail->product_id)}}">
                                        <img src="{{ asset('storage/product/'.$img->path_img) }}" alt=" " class="img-responsive">
                                    </a>
                                    @endforeach
                                </td>                                
                                
                                <td class="invert">
                                    <div class="quantity">
                                        <div class="quantity-select">
                                            <div class="entry value-minus">&nbsp;</div>
                                            <div class="entry value qty-{{$cart->id}}"><span>{{$cart->orderDetail->qty}}</span></div>
                                            <div class="entry value-plus active">&nbsp;</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="invert">{{$cart->orderDetail->product->name}}</td>

                                <td class="invert">Rp {{$cart->orderDetail->product->price}}</td>
                                <td class="invert">
                                <button data-toggle="modal" data-target="#modalDelete-{{$cart->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <p class="text-center">KeranjanMu Kosong</p> 
                            <br>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="checkout-left">
                <div class="col-md-4 checkout-left-basket">
                    <h4>Ringkasan Belanja</h4>
                    <ul id="items">
                    </ul>
                    <a href="{{route('customer.checkout')}}" 
                        onclick="event.preventDefault();
						document.getElementById('checkout-form').submit();"
                        class="btn btn-success" id="buy" disabled                        
                        >Beli
                    </a>
                    <form id="checkout-form" action="{{route('customer.checkout')}}" method="POST">
                        @csrf
                        <input type="text" name="ids" value="" id="ids" hidden>
                    </form>
                </div>

                <div class="clearfix"> </div>


                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- //top products -->
</div>
    <!-- Modal Hapus Produk dari Keranjang -->
    @foreach($carts as $cart)
    <div id="modalDelete-{{$cart->id}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Produk dari KeranjangMu</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('customer.cart.destroy', $cart->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group text-center">
                            <p>Apa anda yakin ingin menghapus barang {{$cart->orderDetail->product->name}}?</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Ya">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('checkout')
 <!--quantity-->
 <script>
    $('.value-plus').on('click', function () {
        var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) + 1;
        divUpd.text(newVal);
    });

    $('.value-minus').on('click', function () {
        var divUpd = $(this).parent().find('.value'),
            newVal = parseInt(divUpd.text(), 10) - 1;
        if (newVal >= 1) divUpd.text(newVal);
    });
</script>
<!--quantity-->

<!-- cart -->
<script>
    $(document).ready(function(){
        $('#master').on('click', function(e) {
            var allVals = []; 
            var allTotal = [];  
            var allQty = [];
            var subtotal = 0;
            var subqty = 0;
              
            if($(this).is(':checked',true))  
            {
                $(".sub_chk").prop('checked', true); 
                $('#buy').attr('disabled', false);

                $(".sub_chk:checked").each(function() {  
                    allVals.push($(this).attr('data-id'));
                }); 
                
                $('#ids').attr('value', allVals);

                @foreach($carts as $cart)
                    var qty = parseInt($('.qty-{{$cart->id}}').text(), 10);
                    var price = {{$cart->orderDetail->product->price}};
                    var total = qty * price;
                    allTotal.push(total);
                    allQty.push(qty);

                    $.ajax({
                        url: '{{route('customer.cart.update', $cart->id) }}',
                        type: 'PATCH',            
                        data: {
                            'id' : {{$cart->id}},
                            'total': total,
                            'qty' : qty,
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            console.log('success');
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                @endforeach

                for(i = 0; i <allTotal.length; i++){
                    subtotal += allTotal[i];
                }

                for(i = 0; i <allQty.length; i++){
                    subqty += allQty[i];
                }

                $('#items').html('<li><h5>Total Barang <i>-</i> <span> '+ subqty + '</span></h5></li> <li><h5>Total Harga <i>-</i> <span> Rp '+ subtotal + '</span></h5></li>')
            } else {  
                $(".sub_chk").prop('checked',false); 
                $('#items').html('');
                $('#buy').attr('disabled', true); 
            }  

            console.log(allQty);
        });

        $("#boxes input[type='checkbox']").click(function(){
            var allTotal = [];  
            var allQty = [];
            var allId = [];
            var subqty=0;
            var subtotal=0;
            $("#boxes input[type='checkbox']:checked").each(function(){
                //Update total
                var price = parseInt($(this).data("price"),10);
                var id = parseInt($(this).data("id"),10);
                var qty = parseInt($("#boxes").find('.qty-'+id).text(),10);
                var total = qty * price;
                allTotal.push(total);
                allQty.push(qty);    
                allId.push(id);     
                $('#buy').attr('disabled', false);
                $('#ids').attr('value', allId);

                $.ajax({
                    url: '{{route('customer.cart.update', 1 ) }}',
                    type: 'PATCH',            
                    data: {
                        'id' : id,
                        'total': total,
                        'qty' : qty,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (data) {
                        console.log('success');
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });

            });

            for(i = 0; i <allTotal.length; i++){
                    subtotal += allTotal[i];
                }

            for(i = 0; i <allQty.length; i++){
                subqty += allQty[i];
            }

            $('#items').html('<li><h5>Total Barang <i>-</i> <span> '+ subqty + '</span></h5></li> <li><h5>Total Harga <i>-</i> <span> Rp '+ subtotal + '</span></h5></li>')

        });    
    }); 
</script>

@endsection