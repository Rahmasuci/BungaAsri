@extends('layouts.admin')
@section('title', 'Category')
@section('content')
<div class="main-content-inner">
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar Kategori</h2>
                        <button style="margin-bottom:20px" data-toggle="modal" data-target="#modalAdd" class="btn btn-info "><i class="ti-plus"></i> Kategori</button>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kategori</th>
                                        <th>Jumlah Produk</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->product->count()}}</td>
                                        <td>{{$category->created_at}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="modal" data-target="#modalEdit-{{$category->id}}" class="btn btn-xs btn-success"><i class="ti-pencil-alt"></i></button>
                                                <button data-toggle="modal" data-target="#modalDelete-{{$category->id}}" class="btn btn-xs btn-danger"><i class="ti-trash"></i></button>
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
</div>
<!-- Modal Tambah Kategori -->
<div id="modalAdd" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.category.store')}}">
                    @csrf
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input name="name" type="text" class="form-control" required autofocus>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Tambah">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah Kategori -->
@foreach($categories as $category)
<div id="modalEdit-{{$category->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.category.update', $category->id)}}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input name="name" type="text" class="form-control" required autofocus value="{{$category->name}}">
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
@endforeach

<!-- Modal Hapus Kategori -->
@foreach($categories as $category)
<div id="modalDelete-{{$category->id}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Kategori</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.category.destroy', $category->id)}}">
                    @csrf
					@method('DELETE')
                    <div class="form-group text-center">
                         <p>Apa anda yakin ingin menghapus kategori {{$category->name}}?</p>
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

@endsection