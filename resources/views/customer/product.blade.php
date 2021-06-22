@extends('layouts.main')
@section('title', 'Product')
@section('content')
<div class="ads-grid_shop">
    <div class="shop_inner_inf">
        <!-- tittle heading -->

        <!-- //tittle heading -->
        <!-- product left -->
        <div class="side-bar col-md-3">
            
            <!--category -->
            <div class="left-side">
                <h3 class="agileits-sear-head">Kategori</h3>
                <ul>
                    @foreach($categories as $category)
                    <li>
                        <input type="checkbox" class="checked">
                        <span class="span">{{$category->name}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- // category -->
        </div>
        <!-- //product left -->

        <!-- product right -->
        <div class="left-ads-display col-md-9">
            <div class="wrapper_top_shop">                
                <!-- product-sec1 -->
                <div class="product-sec1">
                @foreach($products as $product)
                    <div class="col-md-4 product-men">
                        <div class="product-shoe-info shoe">
                            <div class="men-pro-item">
                                <div class="men-thumb-item">
                                    @foreach($product->imgProduct->take(1) as $img)
                                    <img src="{{ asset('storage/product/'.$img->path_img) }}" alt="">
                                    @endforeach
                                    <div class="men-cart-pro">
                                        <div class="inner-men-cart-pro">
                                            <a href="{{route('detail.product', $product->id)}}" class="link-product-add-cart">Quick View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="item-info-product">
                                    <h4>
                                        <a href="{{route('detail.product', $product->id)}}">{{$product->name}} </a>
                                    </h4>
                                    <div class="info-product-price">
                                        <div class="grid_meta">
                                            <div class="product_price">
                                                <div class="grid-price ">
                                                    <span class="money ">Rp{{$product->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="shoe single-item hvr-outline-out">
                                            <button type="submit" class="shoe-cart pshoe-cart" data-toggle="modal" data-target="#modalCart-{{$product->id}}"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
                    <div class="clearfix"></div>

                </div>
                <!-- //product-sec1 -->
                
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- MOdal Keranjang -->
    @foreach($products as $product)
    <div id="modalCart-{{$product->id}}" class="modal fade">
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
                            <input type="number" name="qty" id="qty-{{$product->id}}" value="1" class="form-control">
                            <span id="info-max-{{$product->id}}" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label>Stock : </label><span id="stock-{{$product->id}}">{{$product->stock}}</span>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" id="subtotal-{{$product->id}}" name="total" class="form-control" value="{{$product->price}}">
                            <!-- <p>Rp <span id="subtotal">{{$product->price}}</span></p> -->
                            <span id="price-{{$product->id}}" hidden>{{$product->price}}</span>
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
    @endforeach
</div>
@endsection

@section('checkout')
 <!-- kerananjang -->
 <script>
 @foreach($products as $product)
    $(document).ready(function(){
        // saat user melepas tombol keyboard
        $("#qty-{{$product->id}}").keyup(function(){
            // mendapatkan nilai harga dalam bentuk int
            var harga = parseInt($("#price-{{$product->id}}").text(), 10);

            // mendapatkan nilai qty dlm bentuk int
            var qty = parseInt($(this).val(), 10);

            // mendapatakan nilai stock
            var stock = $('#stock-{{$product->id}}').text();

            // mendapatkan nilai subtotal
            var subtotal = harga * qty; 

            // mengganti nilai subtotal awal dengan yang baru
            $("#subtotal-{{$product->id}}").text(subtotal);

            // jika subtotal NaN maka diberi nilai 0
            if (isNaN(subtotal)) {
                $("#subtotal-{{$product->id}}").text('0');
            } else if (qty <=0){
                $("#subtotal-{{$product->id}}").text(harga);
            }

            if (qty>stock) {
                $('#info-max-{{$product->id}}').text('Maks. pembelian barang ini adalah ' + stock + ' item, kurangi pembelianmu')
            } else if (qty <=0){
                $('#info-max-{{$product->id}}').text('Min. pembelian barang ini adalah 1 barang')
            }

        });

        // saat user klik tombol atas bawah
        $("#qty-{{$product->id}}").click(function(){
            // mendapatkan nilai harga dalam bentuk int
            var harga = parseInt($("#price-{{$product->id}}").text(), 10);

            // mendapatkan nilai qty dlm bentuk int
            var qty = parseInt($(this).val(), 10);

            // mendapatakan nilai stock
            var stock = $('#stock-{{$product->id}}').text();

            // mendapatkan nilai subtotal
            var subtotal = harga * qty; 

            // mengganti nilai subtotal awal dengan yang baru
            $("#subtotal-{{$product->id}}").val(subtotal);

            // jika subtotal NaN maka diberi nilai 0
            if (isNaN(subtotal)) {
                $("#subtotal-{{$product->id}}").text('0');
            } else if (qty <=0){
                $("#subtotal-{{$product->id}}").text(harga);
            }

            if (qty>stock) {
                $('#info-max-{{$product->id}}').text('Maks. pembelian barang ini adalah ' + stock + ' item, kurangi pembelianmu')
            } else if (qty <=0){
                $('#info-max-{{$product->id}}').text('Min. pembelian barang ini adalah 1 barang')
            }

        });
    }); 
@endforeach
</script>

@endsection