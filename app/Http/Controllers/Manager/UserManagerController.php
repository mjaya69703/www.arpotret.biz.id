<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK AUTHENTIKASI
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
// UNTUK PLUGIN TAMBAHAN
use Alert;
// UNTUK KONEKSI MODEL
use App\Models\Admin;
use App\Models\User;
use App\Models\WebSetting;
// use App\Models\PageManager;d

class UserManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pengguna Member';
        $data['subdesc'] = 'Halaman untuk mengelola pengguna member';
        $data['web'] = WebSetting::all()->first();
        $data['member'] = User::all();

        return view('manager.pages.manage-member-index', $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:admins,email', 'unique:users,email'],
            'username' => ['required', 'max:255', 'unique:admins,username', 'unique:users,username'],
            'phone' => ['required', 'max:255', 'unique:admins,phone', 'unique:users,phone'],
            'type' => ['required', 'integer'],
            // 'password' => 'required|confirmed|min:8',
        ]);

        $admin = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => Hash::make($request->phone),
            'is_verified' => true,
        ]);

        $admin->save();

        Alert::success('Success', 'Pengguna berhasil ditambahkan.');
        return back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'string|max:255',
            'username' => 'string|max:255|unique:users,username,' . Auth::guard('admin')->user()->id,
            'phone' => 'numeric',
            'email' => 'email|max:255|unique:users,email,' . Auth::guard('admin')->user()->id,
            'type' => ['required'],
            // 'password' => 'required|confirmed|min:8',
        ]);

        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->type = $request->type;
        $admin->is_verified = $request->is_verified;
        $admin->email = $request->email;
        $admin->username = $request->username;

        $admin->save();

        Alert::success('Success', 'Pengguna berhasil diupdate.');
        return back();
    }

    public function destroy($id){
        $admin = User::findOrFail($id);
        if ($admin->photo != 'default.jpg') {
            File::delete(storage_path('app/public/images/profile/'.$product->photo));
        }

        $admin->delete();
        Alert::success('Success', 'Pengguna berhasil dihapus.');
        return back();
    }

    public function AdminIndex(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pengguna Admin';
        $data['subdesc'] = 'Halaman untuk mengelola pengguna admin';
        $data['web'] = WebSetting::all()->first();
        $data['admin'] = Admin::all();

        return view('manager.pages.manage-admin-index', $data);
    }

    public function AdminStore(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:admins,email', 'unique:users,email'],
            'username' => ['required', 'max:255', 'unique:admins,username', 'unique:users,username'],
            'phone' => ['required', 'max:255', 'unique:admins,phone', 'unique:users,phone'],
            'type' => ['required', 'integer'],
            // 'password' => 'required|confirmed|min:8',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => Hash::make($request->phone),
            'is_verified' => true,
        ]);

        $admin->save();

        Alert::success('Success', 'Pengguna berhasil ditambahkan.');
        return back();
    }

    public function AdminUpdate(Request $request, $id){
        $request->validate([
            'name' => 'string|max:255',
            'username' => 'string|max:255|unique:users,username,' . Auth::guard('admin')->user()->id,
            'phone' => 'numeric',
            'email' => 'email|max:255|unique:users,email,' . Auth::guard('admin')->user()->id,
            'type' => ['required'],
            // 'password' => 'required|confirmed|min:8',
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->type = $request->type;
        $admin->is_verified = $request->is_verified;
        $admin->email = $request->email;
        $admin->username = $request->username;

        $admin->save();

        Alert::success('Success', 'Pengguna berhasil diupdate.');
        return back();
    }


    public function AdminDestroy($id){
        $admin = Admin::findOrFail($id);
        if ($admin->photo != 'default.jpg') {
            File::delete(storage_path('app/public/images/profile/'.$product->photo));
        }

        $admin->delete();
        Alert::success('Success', 'Pengguna berhasil dihapus.');
        return back();
    }

}
