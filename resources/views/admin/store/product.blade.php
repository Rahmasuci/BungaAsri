@extends('layouts.admin')
@section('title', 'Product')
@section('content')
<div class="main-content-inner">
               
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h2>Daftar Produk</h2>
                        <button style="margin-bottom:20px" data-toggle="modal" data-target="#modalAdd" class="btn btn-info "><i class="ti-plus"></i> Produk</button>
                    </div>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="display" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{Str::of($product->description)->words(5)}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-toggle="modal" data-target="#modalDetail-{{$product->id}}" class="btn btn-xs btn-info"><i class="ti-eye"></i></button>
                                                <button data-toggle="modal" data-target="#modalEdit-{{$product->id}}" class="btn btn-xs btn-success"><i class="ti-pencil-alt"></i></button>
                                                <button data-toggle="modal" data-target="#modalDelete-{{$product->id}}" class="btn btn-xs btn-danger"><i class="ti-trash"></i></button>
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

    <!-- Modal Tambah Produk -->
    <div id="modalAdd" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                </div>
                
                <div class="modal-body">
                <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data" >
                @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input name="name" type="text" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category" class="form-control" required>
                                    <option selected>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" cols="5" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <input name="price" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <input name="stock" type="number" class="form-control" required>
                            </div>
                        </div>
                    </div>
                                      
                    <div class="form-group">
                        <label>Gambar</label>
                        <input name="imgs_product[]" type="file" class="form-control" multiple requireds>
                        <span class="text-warning">Bisa upload lebih dari 1 gambar</span>
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

    <!-- Modal Detail Produk -->
    @foreach($products as $product)
    <div id="modalDetail-{{$product->id}}" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Produk</h4>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input name="name" type="text" class="form-control" required autofocus value="{{$product->name}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category" class="form-control" required>
                                    <option selected>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>                            
                            </div>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" cols="5" rows="3" required>{{$product->description}}
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga</label>
                                <input name="price" type="number" class="form-control" required value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <input name="stock" type="number" class="form-control" required value="{{$product->stock}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Gambar Produk</label> <br>
                        <div class="row ">
                            @foreach($product->imgProduct as $img)
                            <div class="card ml-3" style="width: 10rem;">
                                <img class="card-img-top" src="{{ asset('storage/product/'.$img->path_img) }}" alt="Card image cap">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div> 
    @endforeach
    
    <!-- Modal Ubah Produk -->
    @foreach($products as $product)
    <div id="modalEdit-{{$product->id}}" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Produk</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input name="name" type="text" class="form-control" required autofocus value="{{$product->name}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="category" class="form-control" required>
                                        <option selected>Pilih Kategori</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif >{{$category->name}}</option>
                                        @endforeach
                                    </select>                            
                                </div>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control" cols="5" rows="3" required>{{$product->description}}
                            </textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input name="price" type="number" class="form-control" required value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input name="stock" type="number" class="form-control" required value="{{$product->stock}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tambah Gambar</label>
                            <input name="imgs_product[]" type="file" class="form-control" multiple requireds>
                            <span class="text-warning">Bisa upload lebih dari 1 gambar</span>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>                        
                        </div>
                    </form>
                    <hr>
                    <div class="form-group">
                        <label for="">Gambar Produk</label> <br>
                        <div class="row ">
                            @foreach($product->imgProduct as $img)
                            <div class="card ml-3" style="width: 10rem;">
                                <img class="card-img-top" src="{{ asset('storage/product/'.$img->path_img) }}" alt="Card image cap">
                                <div class="text-center mt-2">
                                    <form action="{{route('admin.imgProduct.destroy', $img->id)}}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="ti-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                </div>               
            </div>
        </div>
    </div> 
    @endforeach

    <!-- Modal Hapus Produk -->
    @foreach($products as $product)
    <div id="modalDelete-{{$product->id}}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Produk</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.product.destroy', $product->id)}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group text-center">
                            <p>Apa anda yakin ingin menghapus produk {{$product->name}}?</p>
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