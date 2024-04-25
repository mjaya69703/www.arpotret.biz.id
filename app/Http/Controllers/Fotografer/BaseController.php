<?php

namespace App\Http\Controllers\Fotografer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\Connect;
use App\Models\Post;
use App\Models\Balance;
use App\Models\Product;
use App\Models\Booking;
use App\Models\WebSetting;

class BaseController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Utama';
        $data['subdesc'] = 'Halaman utama dashboard fotografer';
        $data['web'] = WebSetting::latest()->first();
        $data['news'] = Post::all()->first();
        $data['rconnect'] = Connect::where('connect_stat', 0)->orderBy('created_at', 'desc')->take(5)->get();
        $data['balance'] = Balance::all();
        $data['balIncome'] = Balance::where('bal_type', 1)->sum('bal_value');
        $data['balOutcome'] = Balance::where('bal_type', 2)->sum('bal_value');
        $data['balPending'] = Balance::where('bal_type', 0)->sum('bal_value');
        $data['balSekarang'] = $data['balIncome'] - $data['balOutcome'];

        // Tambahkan baris ini untuk mendapatkan data penjualan
        $data['salesData'] = $this->getSalesData();

        return view('fotografer.dash-index', $data);
    }

    // Tambahkan fungsi ini ke dalam controller Anda
    public function getSalesData()
    {
        return DB::table('bookings')
            ->where('book_assign_to', Auth::guard('admin')->user()->id)
            ->join('products', 'bookings.book_product_id', '=', 'products.id')
            ->select(DB::raw('MONTH(book_date) as month'), 'product_name', DB::raw('COUNT(*) as sales'))
            ->groupBy('month', 'product_name')
            ->get();
    }

    public function jobsIndex(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar Jobs';
        $data['subdesc'] = 'Halaman untuk melihat daftar job';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::where('book_assign_to', Auth::guard('admin')->user()->id)->get();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('fotografer.pages.manage-jobs-index', $data);
    }
    public function jobsOnProcess(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar Jobs';
        $data['subdesc'] = 'Halaman untuk melihat daftar job';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::where('book_assign_to', Auth::guard('admin')->user()->id)->whereIn('book_stat', [0, 1, 2, 3, 4])->get();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('fotografer.pages.manage-jobs-index', $data);
    }
    public function jobsCompleted(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Daftar Jobs';
        $data['subdesc'] = 'Halaman untuk melihat daftar job';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::where('book_assign_to', Auth::guard('admin')->user()->id)->where('book_stat', 5)->get();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('fotografer.pages.manage-jobs-index', $data);
    }


    public function profile(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Profile Fotografer';
        $data['subdesc'] = 'Halaman profile Fotografer';
        $data['web'] = WebSetting::all()->first();

        return view('fotografer.profile-index', $data);
    }

    public function profileUpdate(Request $request){
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::guard('admin')->user()->id,
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::guard('admin')->user()->id,
        ]);
        $user = Auth::guard('admin')->user();

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/profile');
            $image->move($destinationPath, $name);
            if ($user->photo != 'default.jpg') {
                File::delete($destinationPath.'/'.$user->photo); // hapus gambar lama
            }
            $user->photo = $name;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->biography = $request->biography;
        $user->birthday_city = $request->birthday_city;
        $user->birthday_date = $request->birthday_date;
        $user->social_fb = $request->social_fb;
        $user->social_ig = $request->social_ig;
        $user->social_in = $request->social_in;
        $user->social_tw = $request->social_tw;
        $user->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();

        // return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
