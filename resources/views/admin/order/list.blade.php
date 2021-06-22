@extends('layouts.admin')
@section('title', 'List Order')
@section('content')
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar Pesanan</h2>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr id="colum-{{$order->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->user->name}}</td>
                                        <td>{{$order->orderDetail->product->name}}</td>
                                        <td>{{$order->orderDetail->qty}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>        
                                        @if($order->status == 'Payment Accepted')
                                        <form action="{{route('admin.order.update', $order->id)}}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-xs btn-success" id="verify-{{$order->id}}"><i class="ti-truck"></i></button>
                                        </form>  
                                        @endif                      
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>      
@endsection