<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Alert;
use Auth;
// UNTUK KONEKSI MODEL
// use App\Models\Admin;
use App\Models\WebSetting;
use App\Models\ContactMe;
use App\Models\Admin;

class MailManagerController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Email';
        $data['subdesc'] = 'Halaman untuk mengelola Email masuk dan keluar';
        $data['web'] = WebSetting::all()->first();
        $data['email'] = ContactMe::latest()->get();

        return view('admin.pages.manage-email-index', $data);
    }

    public function create(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Email';
        $data['subdesc'] = 'Halaman untuk mengirim email.';
        $data['web'] = WebSetting::all()->first();
        $data['email'] = ContactMe::all();
        $data['users'] = Admin::all();

        return view('admin.pages.manage-email-create', $data);
    }

    public function view($code){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Email';
        $data['subdesc'] = 'Halaman untuk melihat detail isi email';
        $data['web'] = WebSetting::all()->first();
        $data['email'] = ContactMe::where('contact_code', $code)->first();

        return view('admin.pages.manage-email-view', $data);
    }

    public function destroy($id){
        $email = ContactMe::findOrFail($id);
        $email->delete();

        Alert::success('Success', 'Data email berhasil dihapus.');
        return back();
    }

    public function sendto(Request $request){
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_mail' => 'required|string|max:255',
            // 'contact_codr' => 'required|string|max:255',
            'contact_send' => 'required|string|max:255',
            // 'contact_type' => 'required|integer|max:255',
            'contact_subject' => 'required|string|max:1024',
            'contact_message' => 'required|string|max:4196',
        ]);

        $email = new ContactMe;
        // $email->contact_type = $request->contact_type;
        $email->contact_type = 2;
        // $email->contact_codr = $request->contact_codr;
        $email->contact_code = uniqid();
        $email->contact_name = $request->contact_name;
        $email->contact_send = $request->contact_send;
        $email->contact_mail = $request->contact_mail;
        $email->contact_subject = $request->contact_subject;
        $email->contact_message = $request->contact_message;


        // Mail::send([], [], function ($message) use ($request) {
        //     $message->to($request->contact_send)
        //         ->subject($request->contact_subject)
        //         ->html($request->contact_message) // Menggunakan metode 'html()' alih-alih 'setBody()'
        //         ->setReplyTo('noreply@arpotret.biz.id');
        // });
        // dd($request->all());

        $email->save();

        Alert::success('Success', 'Pesan berhasil dikirim.');
        return back();
    }

    public function store(Request $request){
        $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_mail' => 'required|string|max:255',
            'contact_codr' => 'required|string|max:255',
            'contact_send' => 'required|string|max:255',
            'contact_type' => 'required|integer|max:255',
            'contact_subject' => 'required|string|max:1024',
            'contact_message' => 'required|string|max:4196',
        ]);

        $email = new ContactMe;
        $email->contact_type = $request->contact_type;
        $email->contact_codr = $request->contact_codr;
        $email->contact_code = uniqid();
        $email->contact_name = $request->contact_name;
        $email->contact_send = $request->contact_send;
        $email->contact_mail = $request->contact_mail;
        $email->contact_subject = $request->contact_subject;
        $email->contact_message = $request->contact_message;


        // Mail::send([], [], function ($message) use ($request) {
        //     $message->to($request->contact_send)
        //         ->subject($request->contact_subject)
        //         ->html($request->contact_message) // Menggunakan metode 'html()' alih-alih 'setBody()'
        //         ->setReplyTo('noreply@arpotret.biz.id');
        // });

        Mail::send('base.pdf.pdf-reply-email-client', ['email' => $email], function($message) use ($email) {
            $message->to($email->contact_send);
            $message->subject($email->contact_subject);
            $message->from('no-reply@smtp.mjaya69703.com','ARPotRet');
            // $message->embedData(file_get_contents(public_path('/storage/images/default/logo.svg')), 'logo.svg', 'image/svg+xml');
        });
        // dd($request->all());

        $email->save();

        Alert::success('Success', 'Sukses!, Email berhasil direply.');
        return back();
    }
}
