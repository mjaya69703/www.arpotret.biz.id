<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Post';
        $data['subdesc'] = 'Halaman untuk mengelola postingan blog';
        $data['web'] = WebSetting::all()->first();
        $data['post'] = Post::all();

        return view('admin.pages.manage-blog-post-index', $data);
    }

    public function create(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Post';
        $data['subdesc'] = 'Halaman untuk menambah postingan blog';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tag'] = Tag::all();

        return view('admin.pages.manage-blog-post-create', $data);
    }

    public function edit($id){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Post';
        $data['subdesc'] = 'Halaman untuk mengedit postingan blog';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tag'] = Tag::all();
        $data['post'] = Post::findOrFail($id);

        return view('admin.pages.manage-blog-post-edit', $data);
    }

    public function store(Request $request){
        $request->validate([
            'category_id' => 'required|integer|max:255',
            // 'tags[]' => 'required',
            'post_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_title' => 'required|string|max:255',
            'post_desc' => 'required',
            'post_keyword' => 'required|string|max:255',
            'post_metadesc' => 'required|string|max:255',
        ]);

        $post = new Post;
        if ($request->hasFile('post_cover')) {
            $image = $request->file('post_cover');
            $name = uniqid().('-cover').'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/posts/cover');
            $image->move($destinationPath, $name);
            if ($post->post_cover != 'post_cover.png') {
                File::delete($destinationPath.'/'.$post->post_cover); // hapus gambar lama
            }
            $post->post_cover = $name;
        }
        $post->post_title = $request->post_title;
        $post->post_slug = \Str::slug($request->post_title);
        $post->category_id = $request->category_id;
        $post->author_id = Auth::guard('admin')->user()->id;
        $post->post_desc = $request->post_desc;
        $post->post_keyword = $request->post_keyword;
        $post->post_metadesc = $request->post_metadesc;
        $post->save();

        $post->tags()->attach($request->tags);

        Alert::success('Success', 'Postingan berhasil ditambahkan.');
        return back();
        // dd($request->all());
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_id' => 'required|integer|max:255',
            // 'tags[]' => 'required',
            'post_cover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'post_title' => 'required|string|max:255',
            'post_desc' => 'required',
            'post_keyword' => 'required|string|max:255',
            'post_metadesc' => 'required|string|max:255',
        ]);

        $post = Post::findOrFail($id);
        if ($request->hasFile('post_cover')) {
            $image = $request->file('post_cover');
            $name = uniqid().('-cover').'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/posts/cover');
            $image->move($destinationPath, $name);
            if ($post->post_cover != 'post_cover.png') {
                File::delete($destinationPath.'/'.$post->post_cover); // hapus gambar lama
            }
            $post->post_cover = $name;
        }
        $post->post_title = $request->post_title;
        $post->post_slug = \Str::slug($request->post_title);
        $post->category_id = $request->category_id;
        $post->author_id = Auth::guard('admin')->user()->id;
        $post->post_desc = $request->post_desc;
        $post->post_keyword = $request->post_keyword;
        $post->post_metadesc = $request->post_metadesc;
        $post->save();

        $post->tags()->sync($request->tags);

        Alert::success('Success', 'Postingan berhasil diupdate.');
        return back();
        // dd($request->all());
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->tags()->detach();

        if ($post->post_cover != 'post_cover.png') {
            File::delete(storage_path('app/public/images/posts/cover/'.$post->post_cover));
        }
        $post->delete();

        Alert::success('Success', 'Postingan berhasil dihapus.');
        return back();
    }
}
