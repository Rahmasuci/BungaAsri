@extends('layouts.main')
@section('title', 'Detail Product')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <div class="col-md-4 single-right-left ">
            <div class="grid images_3_of_2">
                <div class="flexslider">

                    <ul class="slides">
                        @foreach($product->imgProduct as $img)
                        <li data-thumb="{{ asset('storage/product/'.$img->path_img) }}">
                            <div class="thumb-image"> <img src="{{ asset('storage/product/'.$img->path_img) }}" data-imagezoom="true" class="img-responsive"> </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-8 single-right-left simpleCart_shelfItem">
            <h3>{{$product->name}}</h3>
            <p><span class="item_price">Rp{{$product->price}}</span>
            </p>
            <div class="occasion-cart">
                <div class="shoe single-item single_page_b">
                    <button data-toggle="modal" data-target="#modalCart" class="btn btn-success"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                </div>
            </div>
            <ul class="social-nav model-3d-0 footer-social social single_page">
                <li class="share">Share On : </li>
                <li>
                    <a href="#" class="twitter">
                        <div class="front"><i class="fab fa-twitter" aria-hidden="true"></i></div>
                        <div class="back"><i class="fab fa-twitter" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a href="#" class="instagram">
                        <div class="front"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                        <div class="back"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                    </a>
                </li>
                <li>
                    <a href="#" class="pinterest">
                        <div class="front"><i class="fab fa-linkedin" aria-hidden="true"></i></div>
                        <div class="back"><i class="fab fa-linkedin" aria-hidden="true"></i></div>
                    </a>
                </li>
            </ul>
            <!--/tabs-->
            <div class="responsive_tabs">
                <div id="horizontalTab">
                    <ul class="resp-tabs-list">
                        <li>Description</li>
                    </ul>
                    <div class="resp-tabs-container">
                        <!--/tab_one-->
                        <div class="tab1">

                            <div class="single_page">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                        <!--//tab_one-->
                    </div>
                </div>
            </div>
            <!--//tabs-->
        </div>
        <div class="clearfix"> </div>
        


    </div>
    <!-- Modal Keranjang -->
    <div id="modalCart" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{route('customer.cart.store')}}" method="POST">
                    @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah ke Keranjangmu</h4>
                </div>
                
                <div class="modal-body">
                        <input type="number" hidden name="product" value="{{$product->id}}">
                        <input type="number" hidden name="stock" value="{{$product->stock}}">
                        <div class="form-group">
                            <label for="qty">Atur Jumlah</label>
                            <input type="number" name="qty" id="qty" value="1" class="form-control">
                            <span id="info-max" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Stock : </label><span id="stock">{{$product->stock}}</span>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" id="subtotal" name="total" class="form-control" value="{{$product->price}}">
                            <!-- <p>Rp <span id="subtotal">{{$product->price}}</span></p> -->
                            <span id="price" hidden>{{$product->price}}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('checkout')
<script>
    $(document).ready(function(){
        // saat user melepas tombol keyboard
        $("#qty").keyup(function(){
            // mendapatkan nilai harga dalam bentuk int
            var harga = parseInt($("#price").text(), 10);

            // mendapatkan nilai qty dlm bentuk int
            var qty = parseInt($(this).val(), 10);

            // mendapatakan nilai stock
            var stock = $('#stock').text();

            // mendapatkan nilai subtotal
            var subtotal = harga * qty; 

            // mengganti nilai subtotal awal dengan yang baru
            $("#subtotal").text(subtotal);

            // jika subtotal NaN maka diberi nilai 0
            if (isNaN(subtotal)) {
                $("#subtotal").text('0');
            } else if (qty <=0){
                $("#subtotal").text(harga);
            }

            if (qty>stock) {
                $('#info-max').text('Maks. pembelian barang ini adalah ' + stock + ' item, kurangi pembelianmu')
            } else if (qty <=0){
                $('#info-max').text('Min. pembelian barang ini adalah 1 barang')
            }

        });

        // saat user klik tombol atas bawah
        $("#qty").click(function(){
            // mendapatkan nilai harga dalam bentuk int
            var harga = parseInt($("#price").text(), 10);

            // mendapatkan nilai qty dlm bentuk int
            var qty = parseInt($(this).val(), 10);

            // mendapatakan nilai stock
            var stock = $('#stock').text();

            // mendapatkan nilai subtotal
            var subtotal = harga * qty; 

            // mengganti nilai subtotal awal dengan yang baru
            $("#subtotal").val(subtotal);

            // jika subtotal NaN maka diberi nilai 0
            if (isNaN(subtotal)) {
                $("#subtotal").text('0');
            } else if (qty <=0){
                $("#subtotal").text(harga);
            }

            if (qty>stock) {
                $('#info-max').text('Maks. pembelian barang ini adalah ' + stock + ' item, kurangi pembelianmu')
            } else if (qty <=0){
                $('#info-max').text('Min. pembelian barang ini adalah 1 barang')
            }

        });
    }); 
</script>
@endsection