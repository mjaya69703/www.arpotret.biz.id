<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
// use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Kategori Produk';
        $data['subdesc'] = 'Halaman untuk mengelola kategori produk';
        $data['web'] = WebSetting::all()->first();
        $data['pCategory'] = ProductCategory::all();

        return view('manager.pages.manage-product-category-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pcate = ProductCategory::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'author' => Auth::guard('admin')->user()->name,
        ]);
        $pcate->save();

        Alert::success('Success', 'Data berhasil ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pcate = ProductCategory::findOrFail($id);
        $pcate->name = $request->name;
        $pcate->slug = \Str::slug($request->name);
        $pcate->author = Auth::guard('admin')->user()->name;
        $pcate->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }

    public function destroy($id){
        $pcate = ProductCategory::findOrFail($id);
        $pcate->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return back();
    }
}
