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
        $products = Product::with('categories')->get();

        // $test = $products[0]->categories[0]->description;        

        // dd($test);

        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
                    ->get();
        
        return view('product.index', ['products' => $products, 'kategori' => $kategori]);

        // return view('product.index', compact('products','kategori'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        $products = Product::with('categories')->get();

        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
                    ->get(); 

        return view('customer', ['products' => $products, 'kategori' => $kategori]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
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
            'nama'            => 'required|max:100',
            'model'           => 'max:100',
            'category_id'     => 'required|array',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $categories_id = $request->input('category_id');

        $photo     = $request->file('picture');
        
        // get only extention file
        $extension = $photo->getClientOriginalExtension();

        // get filename with extention
        $Name   = $photo->getClientOriginalName();
        // get only filename
        $filename = pathinfo($Name, PATHINFO_FILENAME);
        
        // get random string
        $rs = uniqid();

        $fixname = $filename. '_' . $rs . '.' . $extension;

        $request->file('picture')->move('picture', $fixname);

        $db             = new Product ($request->all());
        $db->picture    = $fixname;
        $db->save();

        $db->categories()->attach($categories_id);

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
            $products = Product::with('categories')->get();
        }
        else {
            $filter = $request->input('filter');
            $products = Product::whereHas('categories', function($q) use ($filter) {
                        $q->where('categories.id', $filter);
                    })->get();
        }

        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
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
            $products = Product::with('categories')->get();
        }
        else {
            $filter = $request->input('filter');
            $products = Product::whereHas('categories', function($q) use ($filter) {
                        $q->where('categories.id', $filter);
                    })->get();
        }

        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
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
        
        $products = Product::with('categories')->find($id);

        $categories_id = array();
        
        foreach ($products->categories as $category) {
            $categories_id[] = $category->id;
        }

        $kategori   = DB::table('categories')
                    ->select('id','title')
                    ->groupBy('id','title')
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
            'nama'            => 'required|max:100',
            'model'           => 'max:100',
            'category_id'     => 'required|array',
        ]);

        // get categories id
        $categories_id = $request->input('category_id');

        $product = Product::find($id);

        if ($request->picture) {
            // get only extention file
            $extension = $photo->getClientOriginalExtension();

            // get filename with extention
            $Name   = $photo->getClientOriginalName();
            // get only filename
            $filename = pathinfo($Name, PATHINFO_FILENAME);
            
            // get random string
            $rs = uniqid();

            $fixname = $filename. '_' . $rs . '.' . $extension;

            $request->file('picture')->move('picture', $fixname);

            // save photo change
            $product->picture = $fixname;
            $product->save();
        }

        // save product change
        $product->nama = $request->input('nama');
        $product->model = $request->input('model');
        $product->save();

        // update pivot table
        $product->categories()->sync($categories_id);

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
