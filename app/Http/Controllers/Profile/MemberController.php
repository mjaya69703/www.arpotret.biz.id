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
use App\Models\User;
use App\Models\WebSetting;

class MemberController extends Controller
{
    // public function LoginForm(){
    //     $data['title'] = 'ARPotRet';
    //     $data['menu'] = 'Halaman Admin';
    //     $data['submenu'] = 'Login Admin';
    //     $data['subdesc'] = 'Halaman login Khusus untuk Admin';
    //     $data['web'] = WebSetting::all()->first();


    //     return view('base.auth.auth-signin', $data);
    // }

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

        $user = User::where($login_type, $request->login)->first();

        if(!$user){
            Alert::error('Error', 'Mohon maaf akun anda belum terdaftar');
            return back();
        }

        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            // return redirect()->route('/');
            // toast('Your Post as been submited!','success');
            Alert::success('Success', 'Anda berhasil login');
            return back();

        }else{
            Alert::error('Error', 'Username/Email atau Password salah');
            return back();
        }
    }


    public function forgotSend(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email', // validasi email dan cek apakah email ada di tabel users
        ]);

        $user = User::where('email', $request->email)->first();
        $user->verify_token = Str::random(40);
        $user->token_created_at = now();

        if ($user->save()) {
            Mail::send('base.mail.base-mail-forgot-member', ['user' => $user], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Forgot Code Arrived');
                $message->from('no-reply@smtp.mjaya69703.com','ARPotRet');
                // $message->embedData(file_get_contents(public_path('/storage/images/default/logo.svg')), 'logo.svg', 'image/svg+xml');
            });

            Alert::success('Success', 'Email berhasil dikirim.');
            return back();
            // return redirect()->route('root.root-main-index');
        } else {
            Alert::error('Error', 'Email tidak terdaftar');
            return back();
        }
    }

    public function forgotChange($token){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Reset Password';
        $data['subdesc'] = 'Halaman untuk mereset Password pengguna';
        $data['web'] = WebSetting::all()->first();
        $data['user'] = User::where('verify_token', $token)->first();

        return view('root.member.root-member-forgot', $data);

    }

    public function forgotPost(Request $request, $token) {

        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('verify_token', $token)->first();

        if ($user && \Carbon\Carbon::parse($user->token_created_at)->diffInHours() < 1) {
            $user->password = Hash::make($request->password);
            $user->save();

            Alert::success('Success', 'Password berhasil diubah');
            return redirect()->route('root.root-main-index');
            // return back();

        } else {
            Alert::error('Error', 'Token verifikasi tidak valid atau telah kedaluwarsa');
            return back();
        }
    }

    public function RegistPost(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => ['required', 'email', 'max:255', 'unique:admins,email', 'unique:users,email'],
            'username' => ['required', 'max:255', 'unique:admins,username', 'unique:users,username'],
            'phone' => ['required', 'max:255', 'unique:admins,phone', 'unique:users,phone'],
            'password' => 'required|confirmed|min:8',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'verify_token' => Str::random(40), // generate a random verification token
            'token_created_at' => now(), // store the current time
        ]);

        if ($user) {
            Mail::send('base.mail.base-mail-verify-member', ['user' => $user], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Email Verification');
                $message->from('no-reply@smtp.mjaya69703.com','ARPotRet');
                // $message->embedData(file_get_contents(public_path('/storage/images/default/logo.svg')), 'logo.svg', 'image/svg+xml');
            });

            Alert::success('Success', 'Anda berhasil mendaftar. Silakan cek email Anda untuk verifikasi.');
            return back();
            // return redirect()->route('root.root-main-index');
        } else {
            Alert::error('Error', 'Terjadi kesalahan saat mendaftar');
            return back();
        }
    }

    public function verify($token) {
        $user = User::where('verify_token', $token)->first();

        if ($user && !$user->is_verified && \Carbon\Carbon::parse($user->token_created_at)->diffInHours() < 1) {
            $user->is_verified = true;
            $user->save();

            Alert::success('Success', 'Email Anda berhasil diverifikasi');
            return redirect()->route('root.root-main-index');
            // return back();

        } else {
            Alert::error('Error', 'Token verifikasi tidak valid atau telah kedaluwarsa');
            return back();
        }
    }

    public function dashboard()
    {
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Halaman Admin';
        $data['submenu'] = 'Dashboard Admin';
        $data['subdesc'] = 'Halaman dashboard Khusus untuk Admin';
        $data['web'] = WebSetting::all()->first();


        // return view('admin.dash-index', $data);
        $member = Auth::user();

        switch ($member->type) {
            case 'Super Admin': // super admin
                return view('admin.dash-index', $data);
            case 'General Admin': // general admin
                return view('admin.dash-index', $data);
            case 'Author Admin': // author
                return view('admin.dash-index', $data);
            default:
                return redirect('admin/login');
        }

    }


    public function logout(){
        Auth::logout();
        Alert::success('Success', 'Logout telah berhasil');
        return redirect()->route('root.root-main-index');

    }
}
