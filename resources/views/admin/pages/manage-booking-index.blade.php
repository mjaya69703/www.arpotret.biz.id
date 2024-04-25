@extends('base.base-admin-index')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12 col-12 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Pesanan</h4>
                    <div class="">

                        <a href="{{ route('admin.manage-booking.create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></a>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#xPrintButton" class="btn btn-outline-danger"><i class="fa-solid fa-file-pdf"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Jumlah Semua Pesanan: {{ \App\Models\Booking::all()->count() }}</span>
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
                                    <th class="text-center">Action</th>
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
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                data-bs-target="#xContactClient{{ $item->id }}" class="btn btn-outline-info"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                data-bs-target="#xUpdateStatus{{ $item->id }}" class="btn btn-outline-primary"><i
                                                    class="fas fa-edit"></i></a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('admin.manage-booking.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                    data-original-title="Delete"
                                                    data-url="{{ route('admin.manage-booking.destroy', $item->id) }}"
                                                    data-name="{{ $item->name }}"
                                                    onclick="deleteData('{{ $item->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </form>
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


    <div class="me-1 mb-1 d-inline-block">
        <!--large size Modal -->
        <form action="{{ route('admin.manage-booking.cetak') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left" id="xPrintButton" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Laporan Data Transaksi Pemesanan</h4>
                        <div class="">

                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-6 mb-3">
                            <label for="month">Pilih Bulan</label>
                            <select name="month" id="month" class="form-control">
                                <option value="all">Semua Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="year">Pilih Tahun</label>
                            <select name="year" id="year" class="form-control">
                                @for ($i = 2023; $i <= 2030; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-12 mb-3">
                            <label for="report_name">Nama Laporan</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="text" name="report_name" id="report_name" class="form-control" value="Laporan Data Pemesanan " readonly>
                                <button type="submit" class="btn btn-outline-danger" style="margin-left: 10px"><i class="fa-solid fa-file-pdf"></i></button>
                                {{-- <a href="#" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-envelope"></i></a> --}}
                                {{-- <a href="{{ route('admin.manage-booking.cetak', ['month' => 'all', 'year' => '2023']) }}" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-envelope"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>

        @foreach ($book as $item)
        <div class="modal fade text-left" id="xContactClient{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($item->book_author_id == '0')
                        <h4 class="modal-title" id="myModalLabel16">Data Informasi Client - {{ $item->book_client_name }}</h4>
                        @else
                        <h4 class="modal-title" id="myModalLabel16">Data Informasi Client - {{ $item->book_author->name }}</h4>
                        @endif
                        <div class="">

                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body">
                        @if($item->book_author_id == '0')
                        <div class="form-group mb-3">
                            <label for="name">Nama Client</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $item->book_client_name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email Client</label>
                            <div class=" d-flex justify-content-between align-items-center">

                                <input type="text" name="email" id="email" class="form-control" value="{{ $item->book_client_email }}">
                                <a href="mailto:{{$item->book_client_email}}" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Nomor Telepon Client</label>
                            <div class=" d-flex justify-content-between align-items-center">

                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $item->book_client_phone }}">
                                <a href="tel:{{$item->book_client_phone}}" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-phone"></i></a>
                            </div>
                        </div>
                        @else
                        <div class="form-group mb-3">
                            <label for="name">Nama Client</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $item->book_author->name }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email Client</label>
                            <div class=" d-flex justify-content-between align-items-center">

                                <input type="text" name="email" id="email" class="form-control" value="{{ $item->book_author->email }}">
                                <a href="mailto:{{$item->book_author->email}}" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-envelope"></i></a>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Nomor Telepon Client</label>
                            <div class=" d-flex justify-content-between align-items-center">

                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $item->book_author->phone }}">
                                <a href="tel:{{$item->book_author->phone}}" class="btn btn-outline-primary btn-rounded" style="margin-left: 10px "><i class="fa-solid fa-phone"></i></a>
                            </div>
                        </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach ($book as $item)
        <form action="{{ route('admin.manage-booking.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="modal fade text-left" id="xUpdateStatus{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">Data Informasi Pesanan - <span style="text-transform: uppercase">#{{ $item->book_code }}</span></h4>
                            <div class="">

                                <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body row">
                            @if ($item->book_author_id == '0')

                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_author_id">Nama Client</label>
                                <input type="text" name="book_author_id" id="book_author_id" class="form-control" disabled value="{{ $item->book_client_name }}">
                            </div>
                            @else

                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_author_id">Nama Client</label>
                                <input type="text" name="book_author_id" id="book_author_id" class="form-control" disabled value="{{ $item->book_author->name }}">
                            </div>
                            @endif
                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_stat">Status Pesanan</label>
                                <select name="book_stat" id="book_stat" class="form-select">
                                    <option disabled>Pilih Status Pesanan</option>
                                    <option value="0" {{ $item->raw_book_stat == 0 ? 'selected' : '' }}>Proses Verifikasi Pembayaran</option>
                                    <option value="1" {{ $item->raw_book_stat == 1 ? 'selected' : '' }}>Proses Perencanaan (Dengan Client)</option>
                                    <option value="2" {{ $item->raw_book_stat == 2 ? 'selected' : '' }}>Menunggu Shooting</option>
                                    <option value="3" {{ $item->raw_book_stat == 3 ? 'selected' : '' }}>Shooting</option>
                                    <option value="4" {{ $item->raw_book_stat == 4 ? 'selected' : '' }}>Proses Editing</option>
                                    <option value="5" {{ $item->raw_book_stat == 5 ? 'selected' : '' }}>Diterima Client</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_product_id">Nama Package</label>
                                <select name="book_product_id" id="book_product_id" class="form-select">
                                    <option selected disabled>Pilih Status Pesanan</option>
                                    @foreach ($product as $item_p)
                                    <option value="{{ $item_p->id }}" {{ $item->book_product_id == $item_p->id ? 'selected' : '' }}>{{ $item_p->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_product_price">Harga + 11 % PPN</label>
                                <input type="text" name="book_product_price" id="book_product_price" class="form-control" disabled value="Rp. {{ number_format((int) $item->book_product->raw_product_price * 1.11, 0, ',', '.') }}">
                            </div>
                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_date">Tanggal Booking</label>
                                <input type="date" name="book_date" id="book_date" class="form-control" value="{{ $item->book_date }}">
                            </div>
                            <div class="form-group col-lg-6 col-12 mb-3">
                                <label for="book_time">Waktu Booking</label>
                                <input type="time" name="book_time" id="book_time" class="form-control" value="{{ $item->book_time }}">
                            </div>
                            <div class="form-group col-lg-12 col-12 mb-3">
                                <label for="book_assign_to">Pilih Fotografer ID</label>
                                <select name="book_assign_to" id="book_assign_to" class="form-select">
                                    <option selected disabled>Pilih Fotografer ID</option>
                                    @foreach ($fotografer as $author)
                                    <option value="{{ $author->id }}" {{ $item->book_assign_to == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-12 col-12 mb-3 text-center">
                                <span style="font-size: 20px">Bukti Pembayaran</span>
                                <br><hr>
                                <img src="{{ asset('storage/images/payment/'. $item->book_payment) }}" class="card-img-top" style="max-width: 250px;" alt="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
</section>
@endsection
@section('custom-js')
<script>
    document.getElementById('month').addEventListener('change', function() {
        updateReportName();
    });

    document.getElementById('year').addEventListener('change', function() {
        updateReportName();
    });

    function updateReportName() {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var reportName = 'Laporan Data Pemesanan ';

        if (month === 'all') {
            reportName += 'Tahun ' + year;
        } else {
            reportName += 'Bulan ' + monthNames[month - 1] + ' Tahun ' + year;
        }

        reportName += '.pdf'; // Menambahkan ekstensi .pdf ke nama laporan

        document.getElementById('report_name').value = reportName;
    }
</script>
<script>
    document.getElementById('month').addEventListener('change', function() {
        updateUrl();
    });

    document.getElementById('year').addEventListener('change', function() {
        updateUrl();
    });

    function updateUrl() {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var url = "{{ route('admin.manage-booking.cetak', ['month' => 'MONTH', 'year' => 'YEAR']) }}";

        url = url.replace('MONTH', month);
        url = url.replace('YEAR', year);

        document.querySelector('.btn-outline-primary').href = url;
    }
</script>

@endsection
