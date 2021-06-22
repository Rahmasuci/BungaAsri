@extends('layout.app')
@section('title', 'Home')
@section('content')
<!-- /girds_bottom-->
<div class="grids_bottom">
    <div class="style-grids">
        <div class="col-md-6 style-grid style-grid-1">
            <img src="{{asset('images/index_page/1 Go-To Hijab.jpg')}}" alt="shoe">
        </div>
    </div>
    <div class="col-md-6 style-grid style-grid-2">
        <div class="style-image-1_info">
            <div class="style-grid-2-text_info">
                <h3>Go-To Hijab Pajamas Set</h3>
                <p>Lounge wear unik didesain spesial untuk para hijabi yang aktif di dalam rumah. Tinggal naik dan turunkan resleting bisa kamu jadikan hijab ataupun hoodie. Ga perlu repot lagi peniti sana-sini kalau mau keluar rumah.</p>
                <div class="shop-button">
                    <a href="shop.html">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="style-image-2">
            <img src="{{asset('images/index_page/background2.jpg')}}" alt="shoe">
            <div class="style-grid-2-text">
                <h3>Sleepware</h3>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<!-- /girds_bottom_2-->
<div class="grids_sec_2">
    <div class="style-grids_main">
        <div class="col-md-6 grids_sec_2_left">
            <div class="grid_sec_info">
                <div class="style-grid-2-text_info">
                    <h3>Gift Box</h3>
                    <p>Giftbox hardbox model buka tutup dihias pita yang exclusive. Cocok untuk hadiah. Harga sudah berikut Kartu Ucapan kosong.
                    **Isi dari kartu ucapan dapat ditulis melalui note, jika tidak ada note maka kartu ucapan akan dikosongkan (tulis sendiri ketika sampai)</p>
                    <div class="shop-button">
                        <a href="shop.html">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="style-image-2">
                <img src="image/awalgift.jpeg" alt="shoe">
                <div class="style-grid-2-text">
                    <h3></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 grids_sec_2_left">

            <div class="style-image-2">
                <img src="image/awal mukena.jpeg" alt="shoe">
                <div class="style-grid-2-text">
                    <h3>Mukena</h3>
                </div>
            </div>
            <div class="grid_sec_info last">
                <div class="style-grid-2-text_info">
                    <h3> Mukena Rafa Polos - Katun Silky</h3>
                    <p>Mukena travel seri “Rafa” bahan katun silky ringan dan nyaman, kombinasi renda yg cantik, motif dan design exclusive, dan ringan seperti mukena pompom. Ringkes dan mudah dibawa dalam perjalanan dengan tampilan Mukena dan tas yg mewah dan limited.</p>
                    <div class="shop-button two">
                        <a href="shop.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection