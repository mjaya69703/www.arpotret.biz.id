<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\DB;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\Balance;

class BalanceManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Balance';
        $data['subdesc'] = 'Halaman utama untuk mengelola data keuangan';
        $data['web'] = WebSetting::all()->first();
        $data['balance'] = Balance::all();
        $data['balIncome'] = Balance::where('bal_type', 1)->sum('bal_value');
        $data['balOutcome'] = Balance::where('bal_type', 2)->sum('bal_value');
        $data['balPending'] = Balance::where('bal_type', 0)->sum('bal_value');
        $data['balSekarang'] = $data['balIncome'] - $data['balOutcome'];

        return view('manager.pages.manage-balance-index', $data);
    }

    public function pending(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Balance';
        $data['subdesc'] = 'Halaman utama untuk mengelola data keuangan';
        $data['web'] = WebSetting::all()->first();
        $data['balance'] = Balance::where('bal_type', 0)->get();
        $data['balIncome'] = Balance::where('bal_type', 1)->sum('bal_value');
        $data['balOutcome'] = Balance::where('bal_type', 2)->sum('bal_value');
        $data['balPending'] = Balance::where('bal_type', 0)->sum('bal_value');
        $data['balSekarang'] = $data['balIncome'] - $data['balOutcome'];

        return view('manager.pages.manage-balance-index', $data);
    }

    public function sekarang(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Balance';
        $data['subdesc'] = 'Halaman utama untuk mengelola data keuangan';
        $data['web'] = WebSetting::all()->first();
        $data['balance'] = Balance::whereIn('bal_type', [1, 2])->get();
        $data['balIncome'] = Balance::where('bal_type', 1)->sum('bal_value');
        $data['balOutcome'] = Balance::where('bal_type', 2)->sum('bal_value');
        $data['balPending'] = Balance::where('bal_type', 0)->sum('bal_value');
        $data['balSekarang'] = $data['balIncome'] - $data['balOutcome'];

        return view('manager.pages.manage-balance-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'bal_type' => 'required|integer',
            'bal_value' => 'required|integer',
            'bal_desc' => 'required',
        ]);

        $balance = new Balance;
        $balance->bal_admin_id = Auth::guard()->user()->id;
        $balance->bal_ucode = uniqid();
        $balance->bal_value = $request->bal_value;
        $balance->bal_type = $request->bal_type;
        $balance->bal_desc = $request->bal_desc;

        $balance->save();

        Alert::success('Success', 'Data balance berhasil ditambahkan');
        return back();

    }

    public function update(Request $request, $id){
        $request->validate([
            'bal_type' => 'required|integer',
            'bal_value' => 'required',
            'bal_desc' => 'required',
        ]);

        $balance = Balance::findOrFail($id);
        $balance->bal_admin_id = Auth::guard()->user()->id;
        $balance->bal_ucode = uniqid();
        $balance->bal_value = $request->bal_value;
        $balance->bal_type = $request->bal_type;
        $balance->bal_desc = $request->bal_desc;

        $balance->save();

        Alert::success('Success', 'Data balance berhasil diupdate');
        return back();

    }

    public function destroy($id){
        $balance = Balance::findOrFail($id);
        $balance->delete();

        Alert::success('Success', 'Data balance berhasil dihapus');
        return back();

    }

}
