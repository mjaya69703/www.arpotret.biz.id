<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
// use Illuminate\Support\Facades\File;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Tags';
        $data['subdesc'] = 'Halaman untuk mengelola tags blog';
        $data['web'] = WebSetting::all()->first();
        $data['tags'] = Tag::all();

        return view('admin.pages.manage-blog-tags-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'tags_name' => 'required|string|max:255',
            // 'tags_slug' => 'required|string|max:255',
            'tags_keyword' => 'required|string|max:255',
            'tags_metadesc' => 'required|string|max:255',
        ]);

        $tags = new Tag;
        $tags->tags_name = $request->tags_name;
        $tags->tags_slug = \Str::slug($request->tags_name);
        $tags->tags_keyword = $request->tags_keyword;
        $tags->tags_metadesc = $request->tags_metadesc;

        $tags->save();

        Alert::success('Success', 'Tags berhasil ditambahkan.');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'tags_name' => 'required|string|max:255',
            // 'tags_slug' => 'required|string|max:255',
            'tags_keyword' => 'required|string|max:255',
            'tags_metadesc' => 'required|string|max:255',
        ]);

        $tags = Tag::findOrFail($id);
        $tags->tags_name = $request->tags_name;
        $tags->tags_slug = \Str::slug($request->tags_name);
        $tags->tags_keyword = $request->tags_keyword;
        $tags->tags_metadesc = $request->tags_metadesc;

        $tags->save();

        Alert::success('Success', 'Tags berhasil diupdate.');
        return back();
    }

    public function destroy($id){
        $tags = Tag::findOrFail($id);

        $tags->delete();

        Alert::success('Success', 'Tags berhasil dihapus.');
        return back();
    }
}
