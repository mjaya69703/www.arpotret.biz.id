<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Alert;
use Auth;
use PDF;
// UNTUK KONEKSI MODEL
use App\Models\User;
use App\Models\Booking;
use App\Models\Connect;
use App\Models\ProductCategory;
use App\Models\WebSetting;

class ConnectManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Connect';
        $data['subdesc'] = 'Halaman utama untuk melihat data connect';
        $data['web'] = WebSetting::all()->first();
        $data['connect'] = Connect::whereNotNull('connect_code')->get();
        $data['booking'] = Booking::all();

        return view('admin.pages.manage-connect-index', $data);
    }

    public function view($code){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Connect';
        $data['subdesc'] = 'Halaman untuk melihat sesi connect - #'.  strtoupper($code);
        $data['web'] = WebSetting::all()->first();
        $data['connect'] = Connect::where('connect_code', $code)->first();
        $data['connectr'] = Connect::where('connect_codr', $code)->latest()->get();
        $data['booking'] = Booking::all();

        return view('admin.pages.manage-connect-view', $data);
    }

    public function store(Request $request){
        $request->validate([
            'book_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            'send_to' => 'required|integer',
            // 'connect_type' => 'required|integer',
            // 'connect_stat' => 'required|integer',
            'connect_code' => 'required|string|unique:connects,connect_code',
            // 'connect_codr' => 'nullable|string',
            'connect_subject' => 'required|string',
            'connect_message' => 'required|string',
            'connect_attach_1' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_2' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_3' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_4' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_5' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
        ]);

        $connect = new Connect;
        $connect->book_id = $request->book_id;
        $connect->admin_id = Auth::guard('admin')->user()->id;
        $connect->send_to = $request->send_to;
        $connect->connect_code = $request->connect_code;
        $connect->connect_core = uniqid();
        // $connect->connect_subject = $request->connect_subject;
        $enkripsiSubject = Crypt::encryptString($request->connect_subject);
        $connect->connect_subject = $enkripsiSubject;
        $enkripsiMessage = Crypt::encryptString($request->connect_message);
        $connect->connect_message = $enkripsiMessage;
        // $connect->connect_message = $request->connect_message;
        if ($request->hasFile('connect_attach_1')) {
            $filename = $request->connect_code . '-attach-1.' . $request->file('connect_attach_1')->getClientOriginalExtension();
            $path = $request->file('connect_attach_1')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_1 = $path;
        }

        if ($request->hasFile('connect_attach_2')) {
            $filename = $request->connect_code . '-attach-2.' . $request->file('connect_attach_2')->getClientOriginalExtension();
            $path = $request->file('connect_attach_2')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_2 = $path;
        }

        if ($request->hasFile('connect_attach_3')) {
            $filename = $request->connect_code . '-attach-3.' . $request->file('connect_attach_3')->getClientOriginalExtension();
            $path = $request->file('connect_attach_3')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_3 = $path;
        }

        if ($request->hasFile('connect_attach_4')) {
            $filename = $request->connect_code . '-attach-4.' . $request->file('connect_attach_4')->getClientOriginalExtension();
            $path = $request->file('connect_attach_4')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_4 = $path;
        }

        if ($request->hasFile('connect_attach_5')) {
            $filename = $request->connect_code . '-attach-5.' . $request->file('connect_attach_5')->getClientOriginalExtension();
            $path = $request->file('connect_attach_5')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_5 = $path;
        }

        $connect->save();

        Alert::success('Success', 'Anda berhasil menambahkan pesan.');
        return back();
    }

    public function replyAdmin(Request $request){
        $request->validate([
            'book_id' => 'required|integer',
            // 'user_id' => 'required|integer',
            'send_to' => 'required|integer',
            // 'connect_type' => 'required|integer',
            // 'connect_stat' => 'required|integer',
            // 'connect_code' => 'required|string',
            'connect_codr' => 'required|string',
            'connect_subject' => 'required|string',
            'connect_message' => 'required|string',
            'connect_attach_1' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_2' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_3' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_4' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
            'connect_attach_5' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,docx,doc,csv,csr,crt,key,xlsx,xls|max:2048',
        ]);

        $connect = new Connect;
        $connect->book_id = $request->book_id;
        $connect->admin_id = Auth::guard('admin')->user()->id;
        $connect->send_to = $request->send_to;
        // $connect->connect_code = uniqid();
        $connect->connect_codr = $request->connect_codr;
        $connect->connect_core = uniqid();
        // $connect->connect_subject = $request->connect_subject;
        $enkripsiSubject = Crypt::encryptString($request->connect_subject);
        $connect->connect_subject = $enkripsiSubject;
        $enkripsiMessage = Crypt::encryptString($request->connect_message);
        $connect->connect_message = $enkripsiMessage;
        // $connect->connect_message = $request->connect_message;
        if ($request->hasFile('connect_attach_1')) {
            $filename = $request->connect_codr . ('-') . uniqid() . '-attach-reply-1.' . $request->file('connect_attach_1')->getClientOriginalExtension();
            $path = $request->file('connect_attach_1')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_1 = $filename;
        }

        if ($request->hasFile('connect_attach_2')) {
            $filename = $request->connect_codr . ('-') . uniqid() . '-attach-reply-2.' . $request->file('connect_attach_2')->getClientOriginalExtension();
            $path = $request->file('connect_attach_2')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_2 = $filename;
        }

        if ($request->hasFile('connect_attach_3')) {
            $filename = $request->connect_codr . ('-') . uniqid() . '-attach-reply-3.' . $request->file('connect_attach_3')->getClientOriginalExtension();
            $path = $request->file('connect_attach_3')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_3 = $filename;
        }

        if ($request->hasFile('connect_attach_4')) {
            $filename = $request->connect_codr . ('-') . uniqid() . '-attach-reply-4.' . $request->file('connect_attach_4')->getClientOriginalExtension();
            $path = $request->file('connect_attach_4')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_4 = $filename;
        }

        if ($request->hasFile('connect_attach_5')) {
            $filename = $request->connect_codr . ('-') . uniqid() . '-attach-reply-5.' . $request->file('connect_attach_5')->getClientOriginalExtension();
            $path = $request->file('connect_attach_5')->storeAs('public/attach/connect', $filename);
            $connect->connect_attach_5 = $filename;
        }

        $connect->save();

        Alert::success('Success', 'Anda berhasil menambahkan pesan.');
        return back();
    }
}
