<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// UNTUK PLUGIN TAMBAHAN
use Illuminate\Support\Facades\File;
use Alert;
use Auth;
use PDF;
// UNTUK KONEKSI MODEL
use App\Models\Booking;
use App\Models\Admin;
use App\Models\Balance;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\WebSetting;

class BookingController extends Controller
{
    public function index(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pesanan';
        $data['subdesc'] = 'Halaman utama untuk mengelola data pesanan';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::all();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('admin.pages.manage-booking-index', $data);
    }
    public function onProcess(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pesanan';
        $data['subdesc'] = 'Halaman utama untuk mengelola data pesanan yang dalam proses';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::whereIn('book_stat', [0, 1, 2, 3, 4])->get();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('admin.pages.manage-booking-index', $data);
    }
    public function finished(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pesanan';
        $data['subdesc'] = 'Halaman utama untuk mengelola data pesanan yang sudah selesai';
        $data['web'] = WebSetting::all()->first();
        $data['product'] = Product::all();
        $data['book'] = Booking::where('book_stat', 5)->get();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('admin.pages.manage-booking-index', $data);
    }
    public function create(){
        $data['title'] = 'ARPotRet';
        $data['menu'] = 'Beranda';
        $data['submenu'] = 'Kelola Pesanan';
        $data['subdesc'] = 'Halaman utama untuk menambah data pesanan manual';
        $data['web'] = WebSetting::all()->first();
        $data['book'] = Booking::all();
        $data['product'] = Product::all();
        $data['fotografer'] = Admin::where('type', 2)->get();

        return view('admin.pages.manage-booking-create', $data);
    }

    public function store(Request $request){
        if(Auth::check()){

            $request->validate([
                'book_client_name' => 'required',
                'book_client_phone' => 'required',
                'book_client_email' => 'required',
                'book_product_id' => 'required',
                'book_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'book_locate' => 'required',
                'book_date' => 'required',
                'book_time' => 'required',
                'book_note' => 'required',
            ]);
            // $product = Product::where('product_slug', $slug)->first();
            $book = new Booking;
            // $book->book_author_id = Auth::guard()->id;
            $book->book_client_name = $request->book_client_name;
            $book->book_client_email = $request->book_client_email;
            $book->book_client_phone = $request->book_client_phone;
            $book->book_product_id = $request->book_product_id;
            $book->book_locate = $request->book_locate;
            $book->book_code = uniqid();
            $book->book_date = $request->book_date;
            $book->book_time = $request->book_time;
            $book->book_note = $request->book_note;
            if($request->book_assign_to = null) {
                $book->book_assign_to = 0;
            } else {
                $book->book_assign_to = $request->book_assign_to;

            }
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
            $balance->bal_admin_id = Auth::id();
            $balance->bal_ucode = $book->book_code;
            $balance->bal_value = $request->product_price;
            $balance->bal_type = 0;
            $balance->bal_desc = 'Balance masuk dari transaksi #'.$book->book_code;

            $balance->save();

            // dd($request->all());
            $book->save();
            Alert::success('Success', 'Anda berhasil menambahkan pesanan manual.');
            return back();
        } else {
            Alert::error('Error', 'Unauthorized, Silahkan Login terlebih dahulu.');
            return redirect()->back();
        }

    }

    public function update(Request $request, $id){
        $request->validate([
            'book_stat' => 'required',
            'book_date' => 'required',
            'book_time' => 'required',
            'book_product_id' => 'required',
        ]);
        $book = Booking::findOrFail($id);

        $book->book_product_id = $request->book_product_id;
        $book->book_assign_to = $request->book_assign_to;
        $book->book_stat = $request->book_stat;
        $book->book_date = $request->book_date;
        $book->book_time = $request->book_time;


        // TAMBAH DATA KEUANGAN
        $balance = Balance::where('bal_ucode', $book->book_code)->first();
        if($request->book_stat == 0){
            $balance->bal_type = 0;
        } else {
            $balance->bal_type = 1;
        }
        $balance->save();

        $book->save();

        Alert::success('Success', 'Data pesanan berhasil diupdate.');
        return back();
    }

    public function destroy($id){
        $book = Booking::findOrFail($id);
        if ($book->book_payment != 'default.jpg') {
            File::delete(storage_path('app/public/images/payment/'.$book->book_payment));
        }

        $book->delete();
        Alert::success('Success', 'Data pesanan berhasil dihapus.');
        return back();
    }

    public function cetakData(Request $request)
    {
        $data['web'] = WebSetting::all()->first();

        $month = $request->input('month');
        $year = $request->input('year');

        // Jika bulan adalah 'all', maka kita ambil semua data booking di tahun tersebut
        if ($month === 'all') {
            $bookings = Booking::whereYear('created_at', $year)->get();
        } else {
            // Jika bukan 'all', maka kita ambil data booking di bulan dan tahun tersebut
            $bookings = Booking::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->get();
        }

        // Mengatur nama laporan berdasarkan bulan dan tahun
        $monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $reportName = 'Laporan Data Pemesanan ';

        if ($month === 'all') {
            $reportName .= 'Tahun ' . $year;
        } else {
            $reportName .= 'Bulan ' . $monthNames[$month - 1] . ' Tahun ' . $year;
        }

        $reportName .= '.pdf'; // Menambahkan ekstensi .pdf ke nama laporan

        $income = 0;
        foreach ($bookings as $booking) {
            $income += $booking->book_product->raw_product_price;
        }
        // dd($income);
        // Mengubah data booking menjadi PDF
        // return view('base.pdf.pdf-cetak-data-booking', $data,['bookings' => $bookings, 'month' => $month, 'year' => $year, 'income' => $income]);

        $pdf = PDF::loadView('base.pdf.pdf-cetak-data-booking', $data, ['bookings' => $bookings, 'month' => $month, 'year' => $year, 'income' => $income]);

        // Mengembalikan response download
        return $pdf->download($reportName);
    }

}
