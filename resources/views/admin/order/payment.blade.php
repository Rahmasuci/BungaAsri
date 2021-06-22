@extends('layouts.admin')
@section('title', 'Payment Verification')
@section('content')
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Verifikasi Pembayaran</h2>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Produk</th>
                                        <th>Total/Produk</th>
                                        <th>Total Semua</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr id="colum-{{$order->id}}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$order->orderDetail->payment->payment_code}}</td>
                                        <td>{{$order->user->name}}</td>
                                        <td>{{$order->orderDetail->product->name}}</td>
                                        <td>{{$order->orderDetail->qty}}</td>
                                        <td>{{$order->orderDetail->total}}</td>
                                        <td>{{$order->orderDetail->payment->total_payment}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="modal" data-target="#modalInfo-{{$order->id}}" class="btn btn-info btn-xs"><i class="ti-eye"></i></button>
                                                <button class="btn btn-xs btn-success" id="verify-{{$order->id}}"><i class="ti-check"></i></button>
                                            </div>
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
    <!-- Modal Bukti Pembayaran -->
    @foreach($orders as $order)
    <div id="modalInfo-{{$order->id}}" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Pembayaran</h4>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('storage/payment/'.$order->orderDetail->payment->payment) }}" alt=" " class="img-responsive">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('addJs')
<script>
@foreach($orders as $order)
    $(document).ready(function(){
        $('#verify-{{$order->id}}').on('click', function(e) {
            $.ajax({
                url: '{{route('admin.order.update', $order->id) }}',
                type: 'PATCH',            
                data: {
                    'id' : {{$order->id}},
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    // console.log(data);
                    // location.reload();
                    $( '#colum-{{$order->id}}' ).hide();
                    iziToast.success({
                        title: 'Berhasil',
                        message: data.success,
                        position: 'topRight'
                    });
                },
                error: function (data) {
                    console.log(data.responseText);
                }
            });
        });
    });
@endforeach
</script>
@endsection