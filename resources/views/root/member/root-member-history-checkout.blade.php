
@extends('base.base-root-index')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center"
        style="background-image: url('{{ asset('root') }}/assets/img/breadcrumbs-bg.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
            <h2>{{ $submenu }}</h2>
            <ol>
                <li><a href="/">{{ $menu }}</a></li>
                <li>{{ $submenu }}</li>
            </ol>
        </div>
    </div><!-- End Breadcrumbs -->

    <section id="testimonials" class="testimonials section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>{{ $submenu }}</h2>
                <p>{{ $subdesc }}</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span style="font-size: 20px;">{{ $submenu }}</span>
                            <div class="">
                                <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            {{-- <th class="text-center">Tanggal</th> --}}
                                            <th class="text-center">#</th>
                                            <th class="text-center">Kode Pesanan</th>
                                            <th class="text-center">Tanggal Pesanan</th>
                                            <th class="text-center">Nama Kategori</th>
                                            <th class="text-center">Nama Product</th>
                                            <th class="text-center">Nominal Transfer</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book as $key => $item)
                                            <tr class="">
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td class="text-center"><span style="text-transform: uppercase">#{{ $item->book_code }}</span></td>
                                                <td class="text-center">{{ Carbon\Carbon::parse($item->book_date)->format('d F Y') }}</td>
                                                <td class="text-center">{{ $item->book_product->cproduct->name }}</td>
                                                <td class="text-center">{{ $item->book_product->product_name }}</td>
                                                <td class="text-center">Rp. {{ number_format((int) $item->book_product->raw_product_price * 1.11, 0, ',', '.') }}</td>
                                                <td class="text-center">
                                                    @if($item->raw_book_stat == 0)
                                                        <span class="btn btn-sm btn-danger">{{ $item->book_stat }}</span>
                                                    @elseif($item->raw_book_stat == 1)
                                                        <span class="btn btn-sm btn-secondary">{{ $item->book_stat }}</span>
                                                    @elseif($item->raw_book_stat == 2)
                                                        <span class="btn btn-sm btn-warning">{{ $item->book_stat }}</span>
                                                    @elseif($item->raw_book_stat == 3)
                                                        <span class="btn btn-sm btn-primary">{{ $item->book_stat }}</span>
                                                    @elseif($item->raw_book_stat == 4)
                                                        <span class="btn btn-sm btn-info">{{ $item->book_stat }}</span>
                                                    @elseif($item->raw_book_stat == 5)
                                                        <span class="btn btn-sm btn-success">{{ $item->book_stat }}</span>

                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center align-items-center" style="">
                                                    @if ($item->raw_book_stat >= 1 && $item->raw_book_stat <= 4)
                                                    <a href="{{ route('auth-member.connect-view', $item->book_code) }}" style="margin-right: 10px" class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-message"></i>
                                                    </a>
                                                    @endif
                                                    @if ($item->raw_book_stat == 5)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ratingMe{{ $item->id }}" style="margin-right: 10px" class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-star"></i>
                                                    </a>
                                                    @endif
                                                    <a href="{{ route('auth-member.history-details', $item->book_code) }}" style="margin-right: 10px" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('auth-member.cetak.data-transaksi', $item->book_code) }}" style="margin-right: 10px" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7">Jumlah Total Pesanan</td>
                                            <td colspan="1" class="text-center">{{ \App\Models\Booking::where('book_author_id', Auth::id())->count() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->
@foreach ($book as $item)
<div class="modal fade" id="ratingMe{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('auth-member.give-rate-product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="font-size: 20px">
                    <h5 class="modal-title" id="tabsModalLabel">Berikan Rating - <span style="text-transform: uppercase">#{{ $item->book_code }}</span></h5>
                    <div class="d-flex justify-content-between align-items-center">

                        <button style="margin-right: 10px; border-radius: 20px;" type="submit"
                            class="btn btn-rounded btn-outline-primary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                        <button style="border-radius: 20px;" type="button" class="btn btn-rounded btn-outline-warning"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-close"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2" style="display: none">
                        <label for="book_id">Booking ID</label>
                        <input type="text" class="form-control" name="book_id" value="{{ $item->id }}" placeholder="inputkan booking id kamu...">
                        @error('book_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2" style="display: none">
                        <label for="pack_id">Product ID</label>
                        <input type="text" class="form-control" name="pack_id" value="{{ $item->book_product->id }}" placeholder="inputkan product id kamu...">
                        @error('pack_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="rate_score">Rate Score</label>
                        <select name="rate_score" id="rate_score" class="form-control">
                            <option value="" class="text-center" selected>================ Pilih Rate Score ================</option>
                            <option value="1" class="text-center">================ 1 ================</option>
                            <option value="2" class="text-center">================ 2 ================</option>
                            <option value="3" class="text-center">================ 3 ================</option>
                            <option value="4" class="text-center">================ 4 ================</option>
                            <option value="5" class="text-center">================ 5 ================</option>
                        </select>
                        @error('rate_score') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="rate_desc">Berikan Ulasan Kamu</label>
                        <textarea name="rate_desc" id="rate_desc" placeholder="Berikan ulasan terbaikmu..." class="form-control" cols="30" rows="10"></textarea>
                        @error('rate_desc') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
@endsection
@section('custom-css')

@endsection
@section('custom-js')

@endsection
