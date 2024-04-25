<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Alert;
use Auth;
use PDF;
// UNTUK KONEKSI MODEL
use App\Models\WebSetting;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Balance;
use App\Models\Booking;
use App\Models\Connect;
use App\Models\Rating;

class RootAuthController extends Controller
{
    public function checkoutProduct($slug){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Checkout Product';
        $data['subdesc'] = 'Halaman untuk checkout product';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['product'] = Product::where('product_slug', $slug)->first();

        return view('root.member.root-member-payment', $data);
    }

    //  ON DEVELOPMENT
    public function historyCheckout(){
        if(Auth::check()){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Riwayat Pesanan';
        $data['subdesc'] = 'Halaman untuk melihat riwayat pesanan.';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['book'] = Booking::where('book_author_id', Auth::id())->get();

        return view('root.member.root-member-history-checkout', $data);
    } else {
        Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
        return redirect()->back();}
    }

    public function cetakInformasiPembayaran($code){
        if(Auth::check()){
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['book'] = Booking::where('book_author_id', Auth::id())->get();
        // $data['booking'] = Booking::findOrFail($id);
        $data['booking'] = Booking::where('book_code', $code)->first();

        // return view('base.pdf.pdf-informasi-pembayaran', $data);
        $pdf = PDF::loadView('base.pdf.pdf-informasi-pembayaran', $data);
        $pdf->setPaper('a4');
        return $pdf->download('Data-Informasi-Pembayaran.pdf');
        Alert::success('success', 'Sukses, data berhasil dicetak kedalam PDF.');
        return back();
    } else {
        Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
        return redirect()->back();}
    }

    public function historyCheckoutDetails($code){
        if(Auth::check()){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Riwayat Pesanan';
        $data['subdesc'] = 'Halaman untuk melihat detail riwayat pesanan.';
        $data['web'] = WebSetting::all()->first();
        $data['productc'] = ProductCategory::all();
        $data['book'] = Booking::where('book_code', $code)->first();
        // $data['book'] = Booking::findOrFail($id);
        // $data['product'] = Product::findOrFail($id);

        return view('root.member.root-member-history-detail', $data);

        } else {
            Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
            return redirect()->back();
        }
    }

    public function connectView($code){
        if(Auth::check()){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Halaman Connect';
        $data['subdesc'] = 'Halaman untuk meeting bersama admin.';
        $data['web'] = WebSetting::all()->first();
        $data['connect'] = Connect::where('connect_code', $code)->first();
        $data['connectr'] = Connect::where('connect_codr', $code)->latest()->get();
        $data['booking'] = Booking::all();

        // return view('admin.pages.manage-connect-view', $data);

        return view('root.member.root-member-connect-view', $data);

        } else {
            Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
            return redirect()->back();
        }
    }

    public function replyMember(Request $request){
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
        $connect->users_id = Auth::user()->id;
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
        $conn = Connect::where('connect_code', $request->connect_codr)->first();
        $conn->connect_stat = 1;
        $conn->update();

        $connect->save();


        Alert::success('Success', 'Anda berhasil menambahkan pesan.');
        return back();
    }

    public function checkoutProductStore(Request $request, $slug){
        if(Auth::check()){

            $request->validate([
                'book_product_id' => 'required',
                'book_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'book_locate' => 'required',
                'book_date' => 'required',
                'book_time' => 'required',
                'book_note' => 'required',
            ]);
            $product = Product::where('product_slug', $slug)->first();
            $book = new Booking;
            $book->book_author_id = Auth::user()->id;
            $book->book_product_id = $request->book_product_id;
            $book->book_locate = $request->book_locate;
            $book->book_code = uniqid();
            $book->book_date = $request->book_date;
            $book->book_time = $request->book_time;
            $book->book_note = $request->book_note;
            if ($request->hasFile('book_payment')) {
                $image = $request->file('book_payment');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('app/public/images/payment');
                $image->move($destinationPath, $name);
                if ($book->book_payment != 'default.jpg') {
                    // File::delete($destinationPath.'/'.$book->book_payment); // hapus gambar lama
                }
                $book->book_payment = $name;
            }

            // TAMBAH DATA KEUANGAN
            $balance = new Balance;
            $balance->bal_admin_id = 0;
            $balance->bal_ucode = $book->book_code;
            $balance->bal_value = $product->raw_product_price;
            $balance->bal_type = 0;
            $balance->bal_desc = 'Balance masuk dari transaksi #'.$book->book_code;

            $balance->save();

            $book->save();

            Alert::success('Success', 'Anda berhasil membuat pesanan. Silakan cek riwayat pemesanan.');
            return back();
        } else {
            Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
            return redirect()->back();
        }
    }

    public function giveRateProducts(Request $request){
        $request->validate([
            'book_id' => 'required',
            'pack_id' => 'required',
            'rate_score' => 'required',
            'rate_desc' => 'required',
        ]);

        $rating = new Rating;
        $rating->book_id = $request->book_id;
        $rating->pack_id = $request->pack_id;
        $rating->user_id = Auth::user()->id;
        $rating->rate_score = $request->rate_score;
        $rating->rate_desc = $request->rate_desc;

        $rating->save();

        Alert::success('Success', 'Terima kasih atas ratingnya :)');
        return back();
    }
}
