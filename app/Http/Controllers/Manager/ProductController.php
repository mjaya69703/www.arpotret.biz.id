<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
// use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\ProductCategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Product';
        $data['subdesc'] = 'Halaman untuk mengelola Product';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::all();

        return view('manager.pages.manage-product-index', $data);
    }

    public function create(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Tambah Product';
        $data['subdesc'] = 'Halaman untuk menambahkan Product';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::all();

        return view('manager.pages.manage-product-create', $data);
    }
    public function edit($id){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Tambah Product';
        $data['subdesc'] = 'Halaman untuk menambahkan Product';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::findOrFail($id);

        return view('manager.pages.manage-product-edit', $data);
    }



    public function update(Request $request, $id){
        $request->validate([
            'cproduct_id' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:8192',
            'product_price' => 'required|string|max:255',
            'product_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('product_cover')) {
            $image = $request->file('product_cover');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/product/cover');
            $image->move($destinationPath, $name);
            if ($product->product_cover != 'product_cover.png') {
                File::delete($destinationPath.'/'.$product->product_cover); // hapus gambar lama
            }
            $product->product_cover = $name;
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'product_image_'.$i;
            if ($request->hasFile($image_name)) {
                $image = $request->file($image_name);
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/product/image');
                $image->move($destinationPath, $name);
                if ($product->$image_name != 'product_image.png') {
                    File::delete($destinationPath.'/'.$product->$image_name); // hapus gambar lama
                }
                $product->$image_name = $name;
            }
        }

        $product->cproduct_id = $request->cproduct_id;
        $product->author_id = Auth::guard('admin')->user()->id;
        $product->product_name = $request->product_name;
        $product->product_slug = \Str::slug($request->product_name);
        $product->product_desc = $request->product_desc;
        $product->product_price = floatval(str_replace(['Rp', ' ', '.'], '', $request->product_price));
        // dd($request->all());


        // dd($request->all());
        $product->save();
        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function store(Request $request){
        $request->validate([
            'cproduct_id' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string|max:8192',
            'product_price' => 'required|numeric|gt:0',
            'product_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product;

        if ($request->hasFile('product_cover')) {
            $image = $request->file('product_cover');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/product/cover');
            $image->move($destinationPath, $name);
            if ($product->product_cover != 'product_cover.png') {
                File::delete($destinationPath.'/'.$product->product_cover); // hapus gambar lama
            }
            $product->product_cover = $name;
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'product_image_'.$i;
            if ($request->hasFile($image_name)) {
                $image = $request->file($image_name);
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/product/image');
                $image->move($destinationPath, $name);
                if ($product->$image_name != 'product_image.png') {
                    File::delete($destinationPath.'/'.$product->$image_name); // hapus gambar lama
                }
                $product->$image_name = $name;
            }
        }

        $product->cproduct_id = $request->cproduct_id;
        $product->author_id = Auth::guard('admin')->user()->id;
        $product->product_name = $request->product_name;
        $product->product_slug = \Str::slug($request->product_name);
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;

        // dd($request->all());
        $product->save();
        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        if ($product->product_cover != 'product_cover.png') {
            File::delete(storage_path('app/public/images/product/cover/'.$product->product_cover));
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'product_image_'.$i;
            if ($product->$image_name != 'product_image.png') {
                File::delete(storage_path('app/public/images/product/image/'.$product->$image_name));
            }
        }
        $product->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }
}
