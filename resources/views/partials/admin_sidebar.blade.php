<div class="sidebar-menu">
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active"><a href="{{route('admin.index')}}"><i class="ti-dashboard"></i><span>Home</span></a></li>
                    <li><a href="{{route('index')}}"><i class="ti-layout"></i><span>Kembali ke Toko</span></a></li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true">
                            <i class="ti-bag"></i><span>Kelola Pesanan</span>
                        </a>
                        <ul class="collapse">
                            <li><a href="{{route('admin.payment.index')}}"><i class="ti-credit-card"></i> Verifikasi Pembayaran</a></li>
                            <li><a href="{{route('admin.order.index')}}"><i class="ti-bag"></i> Daftar Pesanan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-home"></i><span>Kelola Toko
                            </span></a>
                        <ul class="collapse">
                            <li><a href="{{route('admin.category.index')}}"><i class="ti-tag"></i> Kategori</a></li>
                            <li><a href="{{route('admin.product.index')}}"><i class="ti-star"></i> Produk</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Kelola Pengguna
                            </span></a>
                        <ul class="collapse">
                            <li><a href="customer.php"><i class="fas fa-user-tag"></i> <span>Kelola Pelanggan</span></a></li>
                            <li><a href="user.php"><i class="ti-id-badge"></i> <span>Kelola Staff</span></a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							<i class="fas fa-sign-out-alt"></i> Logout
						</a></li>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
                        
                    </li>
                    
                </ul>
            </nav>
        </div>
    </div>
</div>