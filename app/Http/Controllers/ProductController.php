<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ImgProduct;
use Session;  

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = DB::table('categories')->get();
        // dd($categories);
        $products = Product::all();

        if(Auth::check()){
            if (Auth::user()->role == 0) {
                $page = view('admin.store.product', [
                    'products' => $products,
                    'categories' => $categories
                ]);
            } else {
                $page = view('customer.product', [
                    'products' => $products,
                    'categories' => $categories
                ]);
            }
        } else {
            $page = view('customer.product', [
                'products' => $products,
                'categories' => $categories
            ]);
        } 

        return $page;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // melakukan validasi inputan user
        $this->validate($request,[
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'category'      => 'required',
        ]);

        // membuat produk di DB
        $product = Product::create([
            'name'          => $request->name,
            'description'   => $request->description,  
            'price'         => $request->price,
            'stock'         => $request->stock,
            'category_id'   => $request->category,
        ]);

        // cek apakah ada inputan gambar
        if($request->hasFile('imgs_product')){
            // jika ada, maka di proses
            $files = $request->file('imgs_product');
            foreach($files as $file){
                // mendapatkan ekstensi
                $extension = $file->extension();

                // membuat nama baru angka random dari 1-9999
                $imgname = rand(1,9999).'.'.$extension;

                // validasi gambar dengan ukuran max 5mb
                $this->validate($request, ['imgs_product' => 'required|max:2000']);

                // membawa file ke storage
                $path = Storage::putFileAs('public/product', $file, $imgname);

                // simpan gambar di database
                ImgProduct::create([
                    'path_img'      => $imgname,
                    'product_id'    => $product->id
                ]);
            }
        } else{
            // jika tidak ada maka muncul tulisan "tidak ada gambar"
            return 'tidak ada gambar';
        }

        Session::flash('success', 'Produk Berhasil Ditambahkan');
 
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {   
        if(Auth::check()){
            if (Auth::user()->role == 1) {
                return view('customer.detail_product', [
                    'product' => $product,
                ]);
            }
        } else {
            return view('customer.detail_product', [
                'product' => $product,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {   
        // dd($request);
        // melakukan validasi inputan user
        $this->validate($request,[
            'name'          => 'required',
            'description'   => 'required',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'category'      => 'required',
        ]);

        // mengubah produk di DB
        $product->update([
            'name'          => $request->name,
            'description'   => $request->description,  
            'price'         => $request->price,
            'stock'         => $request->stock,
            'category_id'   => $request->category,
        ]);

        // cek apakah ada inputan gambar
        if($request->hasFile('imgs_product')){
            // jika ada, maka di proses
            $files = $request->file('imgs_product');
            foreach($files as $file){
                // mendapatkan ekstensi
                $extension = $file->extension();

                // membuat nama baru angka random dari 1-9999
                $imgname = rand(1,9999).'.'.$extension;

                // validasi gambar dengan ukuran max 5mb
                $this->validate($request, ['imgs_product' => 'required|max:2000']);

                // membawa file ke storage
                $path = Storage::putFileAs('public/product', $file, $imgname);

                // simpan gambar di database
                ImgProduct::create([
                    'path_img'      => $imgname,
                    'product_id'    => $product->id
                ]);
            }
        } 

        Session::flash('success', 'Produk Berhasil Diubah');
 
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $imgProduct = DB::table('images_product')->where('product_id', $product->id)->get();
        // dd($product);
        // dd($imgProduct);
        
        // Hapus gambar pada storage
        foreach($imgProduct as $img){
            $path_img = '/product/'.$img->path_img;

            if(Storage::disk('public')->exists($path_img)){
                // dd('yee ada');
                Storage::disk('public')->delete($path_img);          

            }
        }

        // Hapus produk
        $product->delete();       

        Session::flash('success', 'Produk Berhasil Dihapus');

        return redirect()->route('admin.product.index');
    }
}
