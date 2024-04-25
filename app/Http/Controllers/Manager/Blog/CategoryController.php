<?php

namespace App\Http\Controllers\Manager\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
// use Illuminate\Support\Facades\File;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Kategori Blog';
        $data['subdesc'] = 'Halaman untuk mengelola kategori blog';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();

        return view('admin.pages.manage-blog-category-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            // 'category_slug' => 'required|string|max:255',
            'category_keyword' => 'required|string|max:255',
            'category_metadesc' => 'required|string|max:255',
        ]);

        $tags = new Category;
        $tags->category_name = $request->category_name;
        $tags->category_slug = \Str::slug($request->category_name);
        $tags->category_keyword = $request->category_keyword;
        $tags->category_metadesc = $request->category_metadesc;

        $tags->save();

        Alert::success('Success', 'Tags berhasil ditambahkan.');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required|string|max:255',
            // 'category_slug' => 'required|string|max:255',
            'category_keyword' => 'required|string|max:255',
            'category_metadesc' => 'required|string|max:255',
        ]);

        $tags = Category::findOrFail($id);
        $tags->category_name = $request->category_name;
        $tags->category_slug = \Str::slug($request->category_name);
        $tags->category_keyword = $request->category_keyword;
        $tags->category_metadesc = $request->category_metadesc;

        $tags->save();

        Alert::success('Success', 'Tags berhasil diupdate.');
        return back();
    }

    public function destroy($id){
        $tags = Category::findOrFail($id);

        $tags->delete();

        Alert::success('Success', 'Tags berhasil dihapus.');
        return back();
    }
}
