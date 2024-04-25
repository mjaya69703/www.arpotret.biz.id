<?php

namespace App\Http\Controllers\Profile;

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
use App\Models\WebSetting;


class AdminController extends Controller
{
    public function LoginForm(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Halaman Admin';
        $data['submenu'] = 'Login Admin';
        $data['subdesc'] = 'Halaman login Khusus untuk Admin';
        $data['web'] = WebSetting::all()->first();


        return view('base.auth.auth-signin', $data);
    }

    public function LoginPost(Request $request){
        $request->validate([
            'login'=>'required',
            'password'=>'required',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : (preg_match('/^[0-9]{10}+$/', $request->input('login')) ? 'phone' : 'username');

        $request->merge([
            $login_type => $request->input('login')
        ]);

        $user = Admin::where($login_type, $request->login)->first();

        if(!$user){
            Alert::error('Error', 'Mohon maaf akun anda belum terdaftar');
            return back();
        }

        if (Auth::guard('admin')->attempt([$login_type => $request->login, 'password' => $request->password])) {

            if($user->rawtype == 0){
                Alert::success('Success', 'Anda berhasil login');
                return redirect()->route('manager.dashboard');
            }elseif($user->rawtype == 1){
                Alert::success('Success', 'Anda berhasil login');
                return redirect()->route('admin.dashboard');

            }elseif($user->rawtype == 2){
                Alert::success('Success', 'Anda berhasil login');
                return redirect()->route('fotografer.profile.index');
            }

        }else{
            Alert::error('Error', 'Username/Email atau Password salah');
            return back();
        }
    }

    public function RegistForm(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Halaman Admin';
        $data['submenu'] = 'Register Admin';
        $data['subdesc'] = 'Halaman Register Khusus untuk Admin';
        $data['web'] = WebSetting::all()->first();


        return view('base.auth.auth-signup', $data);
    }


    public function RegistPost(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'username' => 'required|max:255|unique:admins',
            'phone' => 'required|max:255|unique:admins',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'verify_token' => Str::random(40), // generate a random verification token
            'token_created_at' => now(), // store the current time
        ]);

        if ($user) {
            Mail::send('base.mail.base-mail-verify', ['user' => $user], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Email Verification');
                $message->from('no-reply@yourapp.com','ARPotRet');
                // $message->embedData(file_get_contents(public_path('/storage/images/default/logo.svg')), 'logo.svg', 'image/svg+xml');
            });

            Alert::success('Success', 'Anda berhasil mendaftar. Silakan cek email Anda untuk verifikasi.');
            return redirect()->route('auth.auth-signin');
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat mendaftar');
            return back();
        }
    }

    public function verify($token) {
        $user = Admin::where('verify_token', $token)->first();

        if ($user && !$user->is_verified && \Carbon\Carbon::parse($user->token_created_at)->diffInHours() < 1) {
            $user->is_verified = true;
            $user->save();

            Alert::success('Success', 'Email Anda berhasil diverifikasi');
            return redirect()->route('auth.auth-signin');
        } else {
            Alert::error('Error', 'Token verifikasi tidak valid atau telah kedaluwarsa');
            return back();
        }
    }

    // public function dashboard()
    // {
    //     $data['title'] = 'ARPotRet';
    //     $data['menu'] = 'Halaman Admin';
    //     $data['submenu'] = 'Dashboard Admin';
    //     $data['subdesc'] = 'Halaman dashboard Khusus untuk Admin';
    //     $data['web'] = WebSetting::all()->first();


    //     // return view('admin.dash-index', $data);
    //     $admin = Auth::guard('admin')->user();

    //     switch ($admin->type) {
    //         case 'Super Admin': // super admin
    //             return view('admin.dash-index', $data);
    //         case 'General Admin': // general admin
    //             return view('admin.dash-index', $data);
    //         case 'Author Admin': // author
    //             return view('admin.dash-index', $data);
    //         default:
    //             return redirect('admin/login');
    //     }

    // }


    public function logout(){
        Auth::guard('admin')->logout();
        Alert::success('Success', 'Anda berhasil logout');
        return redirect()->route('auth.auth-signin');
    }
}
