<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Alert;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\WebSetting;

class WebManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Website';
        $data['subdesc'] = 'Halaman untuk mengelola identitas website';
        $data['web'] = WebSetting::all()->first();

        return view('manager.pages.manage-web-index', $data);
    }
    public function update(Request $request){
        $request->validate([
            'slider_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_4' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_5' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_qris' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_head' => 'required|string|max:255',
            'site_desc' => 'required|string|max:255',
            'site_name' => 'required|string|max:255',
            'site_link' => 'required|url',
            'site_street' => 'required|string|max:255',
            'site_poscod' => 'required|string|max:255',
            'site_locate' => 'required|string|max:4096',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'required|string|max:255',
            'site_social_fb' => 'nullable|url|max:255',
            'site_social_ig' => 'nullable|url|max:255',
            'site_social_in' => 'nullable|url|max:255',
            'site_social_tw' => 'nullable|url|max:255',
        ]);

        $sweb = WebSetting::all()->first();

        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->site_logo != 'site_logo.png') {
                File::delete($destinationPath.'/'.$sweb->site_logo); // hapus gambar lama
            }
            $sweb->site_logo = $name;
        }
        if ($request->hasFile('slider_1')) {
            $image = $request->file('slider_1');
            $name = uniqid().'-slider_1.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->slider_1 != 'slider_1.jpg') {
                File::delete($destinationPath.'/'.$sweb->slider_1); // hapus gambar lama
            }
            $sweb->slider_1 = $name;
        }

        if ($request->hasFile('slider_2')) {
            $image = $request->file('slider_2');
            $name = uniqid().'-slider_2.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->slider_2 != 'slider_2.jpg') {
                File::delete($destinationPath.'/'.$sweb->slider_2); // hapus gambar lama
            }
            $sweb->slider_2 = $name;
        }

        if ($request->hasFile('slider_3')) {
            $image = $request->file('slider_3');
            $name = uniqid().'-slider_3.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->slider_3 != 'slider_3.jpg') {
                File::delete($destinationPath.'/'.$sweb->slider_3); // hapus gambar lama
            }
            $sweb->slider_3 = $name;
        }

        if ($request->hasFile('slider_4')) {
            $image = $request->file('slider_4');
            $name = uniqid().'-slider_4.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->slider_4 != 'slider_4.jpg') {
                File::delete($destinationPath.'/'.$sweb->slider_4); // hapus gambar lama
            }
            $sweb->slider_4 = $name;
        }

        if ($request->hasFile('slider_5')) {
            $image = $request->file('slider_5');
            $name = uniqid().'-slider_5.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->slider_5 != 'slider_5.jpg') {
                File::delete($destinationPath.'/'.$sweb->slider_5); // hapus gambar lama
            }
            $sweb->slider_5 = $name;
        }
        if ($request->hasFile('site_qris')) {
            $image = $request->file('site_qris');
            $name = uniqid().'-site_qris.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/images/default');
            $image->move($destinationPath, $name);
            if ($sweb->site_qris != 'site_qris.png') {
                File::delete($destinationPath.'/'.$sweb->site_qris); // hapus gambar lama
            }
            $sweb->site_qris = $name;
        }



        $sweb->site_head = $request->site_head;
        $sweb->site_desc = $request->site_desc;
        $sweb->site_name = $request->site_name;
        $sweb->site_link = $request->site_link;
        $sweb->site_email = $request->site_email;
        $sweb->site_phone = $request->site_phone;
        $sweb->site_street = $request->site_street;
        $sweb->site_poscod = $request->site_poscod;
        $sweb->site_locate = $request->site_locate;
        $sweb->site_social_fb = $request->site_social_fb;
        $sweb->site_social_ig = $request->site_social_ig;
        $sweb->site_social_tw = $request->site_social_tw;
        $sweb->site_social_in = $request->site_social_in;

        $sweb->save();
        Alert::success('Success', 'Data berhasil diupdate');
        return back();
    }
}
