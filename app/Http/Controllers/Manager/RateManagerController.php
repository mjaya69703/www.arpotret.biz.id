<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Alert;
// UNTUK KONEKSI MODEL
use App\Models\Rating;
use App\Models\WebSetting;

class RateManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Rating Product';
        $data['subdesc'] = 'Halaman untuk mengelola rating product';
        $data['web'] = WebSetting::all()->first();
        $data['rating'] = Rating::all();

        return view('manager.pages.manage-product-rating', $data);
    }

    public function update(Request $request, $id){

        $request->validate([
            'is_hide' => 'required|integer'
        ]);

        $rating = Rating::findOrFail($id);
        $rating->is_hide = $request->is_hide;
        $rating->update();

        Alert::success('Success', 'Rating berhasil diupdate.');
        return back();

    }
    public function destroy($id){

        $rating = Rating::findOrFail($id);
        $rating->delete();

        Alert::success('Success', 'Rating berhasil dihapus.');
        return back();

    }
}
