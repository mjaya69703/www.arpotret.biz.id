<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Gallery;


class GalleryController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Gallery';
        $data['subdesc'] = 'Halaman untuk mengelola Gallery dan Portofolio';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::all();
        $data['gallery'] = Gallery::all();

        return view('admin.pages.manage-gallery-index', $data);
    }

    public function create(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Tambah Gallery';
        $data['subdesc'] = 'Halaman untuk menambahkan Gallery';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::all();
        $data['gallery'] = Gallery::all();

        return view('admin.pages.manage-gallery-create', $data);
    }
    public function edit($id){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Tambah Gallery';
        $data['subdesc'] = 'Halaman untuk menambahkan Gallery';
        $data['web'] = WebSetting::all()->first();
        $data['productC'] = ProductCategory::all();
        $data['product'] = Product::all();
        $data['gallery'] = Gallery::findOrFail($id);

        return view('admin.pages.manage-gallery-edit', $data);
    }

    public function store(Request $request){
        $request->validate([
            'cproduct_id' => 'required|integer',
            'product_id' => 'required|integer',
            'gallery_name' => 'required|string|max:255',
            'gallery_desc' => 'required|string|max:8192',
            // 'product_price' => 'required|numeric|gt:0',
            'gallery_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gallery = new Gallery;

        if ($request->hasFile('gallery_cover')) {
            $image = $request->file('gallery_cover');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/gallery/cover');
            $image->move($destinationPath, $name);
            if ($gallery->gallery_cover != 'gallery_cover.png') {
                File::delete($destinationPath.'/'.$gallery->gallery_cover); // hapus gambar lama
            }
            $gallery->gallery_cover = $name;
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'gallery_image_'.$i;
            if ($request->hasFile($image_name)) {
                $image = $request->file($image_name);
                $name = uniqid().('gallery_image_'.$i).'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/gallery/image');
                $image->move($destinationPath, $name);
                if ($gallery->$image_name != 'gallery_image.png') {
                    File::delete($destinationPath.'/'.$gallery->$image_name); // hapus gambar lama
                }
                $gallery->$image_name = $name;
            }
        }

        $gallery->cproduct_id = $request->cproduct_id;
        $gallery->product_id = $request->product_id;
        $gallery->author_id = Auth::guard('admin')->user()->id;
        $gallery->gallery_name = $request->gallery_name;
        $gallery->gallery_slug = \Str::slug($request->gallery_name);
        $gallery->gallery_desc = $request->gallery_desc;
        // $gallery->product_price = $request->product_price;

        // dd($request->all());
        $gallery->save();
        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'cproduct_id' => 'required|integer',
            'product_id' => 'required|integer',
            'gallery_name' => 'required|string|max:255',
            'gallery_desc' => 'required|string|max:8192',
            // 'product_price' => 'required|numeric|gt:0',
            'gallery_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('gallery_cover')) {
            $image = $request->file('gallery_cover');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/gallery/cover');
            $image->move($destinationPath, $name);
            if ($gallery->gallery_cover != 'gallery_cover.png') {
                File::delete($destinationPath.'/'.$gallery->gallery_cover); // hapus gambar lama
            }
            $gallery->gallery_cover = $name;
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'gallery_image_'.$i;
            if ($request->hasFile($image_name)) {
                $image = $request->file($image_name);
                $name = uniqid().('gallery_image_'.$i).'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/gallery/image');
                $image->move($destinationPath, $name);
                if ($gallery->$image_name != 'gallery_image.png') {
                    File::delete($destinationPath.'/'.$gallery->$image_name); // hapus gambar lama
                }
                $gallery->$image_name = $name;
            }
        }

        $gallery->cproduct_id = $request->cproduct_id;
        $gallery->product_id = $request->product_id;
        $gallery->author_id = Auth::guard('admin')->user()->id;
        $gallery->gallery_name = $request->gallery_name;
        $gallery->gallery_slug = \Str::slug($request->gallery_name);
        $gallery->gallery_desc = $request->gallery_desc;
        // $gallery->product_price = $request->product_price;

        // dd($request->all());
        $gallery->save();
        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function destroy($id){
        $gallery = Gallery::findOrFail($id);
        if ($gallery->gallery_cover != 'gallery_cover.png') {
            File::delete(storage_path('app/public/images/gallery/cover/'.$gallery->gallery_cover));
        }

        for ($i = 1; $i <= 6; $i++) {
            $image_name = 'gallery_image_'.$i;
            if ($gallery->$image_name != 'product_image.png') {
                File::delete(storage_path('app/public/images/gallery/image/'.$gallery->$image_name));
            }
        }
        $gallery->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }

}
