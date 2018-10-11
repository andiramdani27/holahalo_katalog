<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Str;

use DB;
use App\product;
use App\category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 
        
        return view('product.index', compact('products','kategori'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        $products = Product::all();

        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 
        
        return view('customer', compact('products','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 

        return view('product.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photo     = $request->file('picture');
        // $RandomString = uniqid();
        // $photo = $request->file('picture')->storeAs('', $StringR .'.jpg');
        $namaFile   = $photo->getClientOriginalName();

        $request->file('picture')->move('picture', $namaFile);

        $do             = new Product ($request->all());
        $do->picture    = $namaFile;
        $do->save();

        Session::flash('message','Data Produk Berhasil Ditambahkan');

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Cari data produk
     *     
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function CariDataProduk(Request $request)
    {
        
        if ($request->input('filter') == "All") {
            $products = Product::all();
        }
        else {
            $products = DB::table('products')
            ->where('kategori', \Request::input('filter') )
            ->orderBy('id', 'asc')
            ->get();
        }

        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 

        return view('product.index', compact('products','kategori'));
    }

    /**
     * Cari data produk Frontend
     *     
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function FilterDataProduk(Request $request)
    {
        if ($request->input('filter') == "All") {
            $products = Product::all();
        }
        else {
            $products = DB::table('products')
            ->where('kategori', \Request::input('filter') )
            ->orderBy('id', 'asc')
            ->get();
        }

        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 

        return view('customer', compact('products','kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);

        $kategori   = DB::table('categories')
                    ->select('title')
                    ->groupBy('title')
                    ->get(); 
        
        return view('product.edit', compact('products','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::find($id);

        if ($request->picture) {
            $photo     = $request->file('picture');
            $namaFile   = $photo->getClientOriginalName();

            $request->file('picture')->move('picture', $namaFile);

            // save photo change
            $product->picture = $namaFile;
            $product->save();
        }

        // save product change
        $product->nama = $request->input('nama');
        $product->model = $request->input('model');
        $product->kategori = $request->input('kategori');
        $product->save();

        Session::flash('message','Data Produk Berhasil Diperbarui');

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        
        $product->delete();

        Session::flash('message','Data Produk Berhasil Dihapus');

        return redirect('products');
    }
}
