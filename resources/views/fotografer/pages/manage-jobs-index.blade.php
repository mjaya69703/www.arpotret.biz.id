@extends('base.base-admin-index')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12 col-12 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Jobs Untuk Kamu</h4>
                    <div class="">

                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Jumlah Semua Pesanan: {{ \App\Models\Booking::all()->count() }}</span>
                        <span>Jumlah Pesanan Punya Kamu: {{ \App\Models\Booking::where('book_assign_to', Auth::guard('admin')->user()->id)->count() }}</span>
                        <span>Jumlah Pesanan OnProcess: {{ \App\Models\Booking::whereIn('book_stat', [0,1,2,3,4])->count() }}</span>
                        <span>Jumlah Pesanan Finished: {{ \App\Models\Booking::where('book_stat', 5)->count() }}</span>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center">Tanggal</th> --}}
                                    <th class="text-center">#</th>
                                    <th class="text-center">Kode Transaksi</th>
                                    <th class="text-center">Tanggal Booking</th>
                                    <th class="text-center">Nama Product</th>
                                    <th class="text-center">Harga Product</th>
                                    <th class="text-center">Nama Client</th>
                                    <th class="text-center">Status Pesanan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($book as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td class="text-center"><span style="text-transform: uppercase">#{{ $item->book_code }}</span></td>
                                        <td class="">{{ \Carbon\Carbon::parse($item->book_date)->isoFormat('dddd, D MMMM YYYY') . (' - ') .\Carbon\Carbon::parse($item->book_time)->isoFormat('HH:mm') . (' WIB ')  }}</td>
                                        <td class="text-center">{{ $item->book_product->product_name }}</td>
                                        <td class="text-center">{{ $item->book_product->product_price }}</td>
                                        @if ($item->book_author_id == '0')

                                        <td class="text-center">{{ $item->book_client_name }}</td>
                                        @else

                                        <td class="text-center">{{ $item->book_author->name }}</td>
                                        @endif
                                        <td class="text-center">
                                            @if($item->raw_book_stat == 0)
                                                <span class="btn btn-danger">{{ $item->book_stat }}</span>
                                            @elseif($item->raw_book_stat == 1)
                                                <span class="btn btn-secondary">{{ $item->book_stat }}</span>
                                            @elseif($item->raw_book_stat == 2)
                                                <span class="btn btn-warning">{{ $item->book_stat }}</span>
                                            @elseif($item->raw_book_stat == 3)
                                                <span class="btn btn-primary">{{ $item->book_stat }}</span>
                                            @elseif($item->raw_book_stat == 4)
                                                <span class="btn btn-info">{{ $item->book_stat }}</span>
                                            @elseif($item->raw_book_stat == 5)
                                                <span class="btn btn-success">{{ $item->book_stat }}</span>

                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>
@endsection
@section('custom-js')

@endsection
