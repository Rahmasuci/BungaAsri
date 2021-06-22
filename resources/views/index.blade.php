@extends('layouts.app')
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
                    <a href="{{route('products')}}">Shop Now</a>
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
                        <a href="{{route('products')}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="style-image-2">
                <img src="{{asset('images/index_page/awalgift.jpeg')}}" alt="shoe">
                <div class="style-grid-2-text">
                    <h3></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 grids_sec_2_left">

            <div class="style-image-2">
                <img src="{{asset('images/index_page/awal mukena.jpeg')}}" alt="shoe">
                <div class="style-grid-2-text">
                    <h3>Mukena</h3>
                </div>
            </div>
            <div class="grid_sec_info last">
                <div class="style-grid-2-text_info">
                    <h3> Mukena Rafa Polos - Katun Silky</h3>
                    <p>Mukena travel seri “Rafa” bahan katun silky ringan dan nyaman, kombinasi renda yg cantik, motif dan design exclusive, dan ringan seperti mukena pompom. Ringkes dan mudah dibawa dalam perjalanan dengan tampilan Mukena dan tas yg mewah dan limited.</p>
                    <div class="shop-button two">
                        <a href="{{route('products')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<!-- /Properties -->
<div class="mid_slider_w3lsagile">
    <div class="col-md-3 mid_slider_text">
        <h5>  Some More</h5>
    </div>
    <div class="col-md-9 mid_slider_info">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                <li data-target="#myCarousel" data-slide-to="3" class=""></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail">
                                <img src="{{asset('images/index_page/slide/1 slide.jpeg')}}" alt="Image" style="max-width:100%;">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/2 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/3 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/4 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/5 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/6 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/7 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/8 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/9 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/10 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/11 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/12 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/13 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/14 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/5 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 slidering">
                            <div class="thumbnail"><img src="{{asset('images/index_page/slide/7 slide.jpeg')}}" alt="Image" style="max-width:100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="fa fa-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="fa fa-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
            <!-- The Modal -->

        </div>
    </div>

    <div class="clearfix"> </div>
</div>
@endsection