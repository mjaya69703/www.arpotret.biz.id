<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
// use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\ContactMe;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Rating;

class RootController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Utama';
        $data['subdesc'] = 'Halaman utama website';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['posts'] = Post::all();
        $data['rating'] = Rating::where('is_hide', 1)->get();
        $data['product'] = Product::paginate(12);

        // dd($data['rating']);
        return view('root.root-main-index', $data);
    }

    public function contact(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Hubungi Kami';
        $data['subdesc'] = 'Halaman untuk menghubungi kami';
        $data['web'] = WebSetting::all()->first();

        return view('root.root-main-contact-us', $data);
    }

    public function contactStore(Request $request){

        $request->validate([
            'contact_name' => 'required',
            'contact_mail' => 'required',
            'contact_subject' => 'required',
            'contact_message' => 'required',
        ]);

        $contact = new ContactMe;
        $contact->contact_code = uniqid();
        $contact->contact_name = $request->contact_name;
        $contact->contact_mail = $request->contact_mail;
        $contact->contact_subject = $request->contact_subject;
        $contact->contact_message = $request->contact_message;

        $contact->save();

        Alert::success('Success', 'Pesan kamu sudah terkirim, terima kasih.');
        return back();
    }

    public function product(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar Product';
        $data['subdesc'] = 'Halaman untuk menampilkan data produk';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['product'] = Product::all();

        return view('root.root-main-product', $data);
    }

    public function productDetail($slug){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Detail Product';
        $data['subdesc'] = 'Halaman untuk menampilkan detail produk';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['product'] = Product::where('product_slug', $slug)->first();

        return view('root.root-main-productd', $data);
    }

    public function portofolio(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar Portofolio Kami';
        $data['subdesc'] = 'Halaman untuk menampilkan portofolio kami';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        // $data['product'] = Product::all();
        $data['gallery'] = Gallery::all();

        return view('root.root-main-portofolio', $data);
    }

    public function portofolioDetail($slug){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Detail Portofolio Kami';
        $data['subdesc'] = 'Halaman untuk menampilkan detail portofolio kami';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        // $data['product'] = Product::where('product_slug', $slug)->first();
        $data['gallery'] = Gallery::where('gallery_slug', $slug)->first();

        return view('root.root-main-portofoliod', $data);
    }

    public function blogIndex(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar blog kami';
        $data['subdesc'] = 'Halaman untuk menampilkan blog seputar kami';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tags'] = Tag::all();
        $data['posts'] = Post::all();


        return view('root.root-main-blog-index', $data);
    }

    public function blogTags(Tag $tag){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar tags kami';
        $data['subdesc'] = 'Halaman untuk menampilkan tags seputar kami';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tags'] = Tag::all();
        $data['posts'] = $tag->posts()->latest()->get();


        return view('root.root-main-blog-index', $data);
    }

    public function blogCategory(Category $category){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar kategori kami';
        $data['subdesc'] = 'Halaman untuk menampilkan kategori seputar kami';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tags'] = Tag::all();
        $data['posts'] = $category->posts()->latest()->get();


        return view('root.root-main-blog-index', $data);
    }

    public function blogDetails($slug){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Lihat Postingan';
        $data['subdesc'] = 'Halaman untuk melihat isi postingan blog';
        $data['web'] = WebSetting::all()->first();
        $data['category'] = Category::all();
        $data['tags'] = Tag::all();
        $data['post'] = Post::all();
        $data['posts'] = Post::where('post_slug', $slug)->first();


        return view('root.root-main-blog-details', $data);
    }
}
