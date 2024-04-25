<?php

namespace App\Http\Controllers\Manager;

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
use App\Models\WebSetting;

class BaseController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Utama';
        $data['subdesc'] = 'Halaman utama dashboard manager';
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

        return view('manager.dash-index', $data);
    }

    // Tambahkan fungsi ini ke dalam controller Anda
    public function getSalesData()
    {
        return DB::table('bookings')
            ->join('products', 'bookings.book_product_id', '=', 'products.id')
            ->select(DB::raw('MONTH(book_date) as month'), 'product_name', DB::raw('COUNT(*) as sales'))
            ->groupBy('month', 'product_name')
            ->get();
    }

    public function profile(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Profile Manager';
        $data['subdesc'] = 'Halaman profile manager';
        $data['web'] = WebSetting::all()->first();

        return view('manager.profile-index', $data);
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
        $user->save();

        Alert::success('Success', 'Data berhasil diupdate');
        return back();

        // return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
