@extends('base.base-root-index')
@section('custom-css')
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center"
        style="background-image: url('{{ asset('root') }}/assets/img/breadcrumbs-bg.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

            <h2>{{ $submenu }}</h2>
            <ol>
                <li><a href="/">Beranda</a></li>
                <li>{{ $submenu }}</li>
            </ol>

        </div>
    </div><!-- End Breadcrumbs -->

    <section id="project-details" class="project-details">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="position-relative h-100"
                style="max-width: 560px; margin: 0 auto; text-align: center; display: flex; justify-content: center; align-items: center;">
                <div class="slides-1 portfolio-details-slider swiper" style="">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="{{ asset('storage/images/product/cover/' . $book->book_product->product_cover) }}"
                                alt="">
                        </div>
                        @if ($book->book_product->product_image_1)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_1) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($book->book_product->product_image_2)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_2) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($book->book_product->product_image_3)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_3) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($book->book_product->product_image_4)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_4) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($book->book_product->product_image_5)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_5) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($book->book_product->product_image_6)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $book->book_product->product_image_6) }}"
                                    alt="">
                            </div>
                        @endif

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>


            <div class="row justify-content-between gy-4 mt-4">
                <div class="col-lg-9 col-12 mb-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span style="font-size: 20px">Data Informasi Pesanan</span>
                            <a href="{{ route('auth-member.history-checkout') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i> Kembali</a>

                        </div>
                        <div class="card-body row">
                            <div class="col-lg-12 col-12 form-group mb-2">
                                <label for="book_payment">Pilih File Bukti Pembayaran (Gambar)</label>
                                <input type="file" class="form-control" name="book_payment" id="book_payment" accept="image/*" onchange="previewImage(event)" disabled value="{{ $book->book_payment }}">
                                <div class="text-center">
                                    <img id="preview" src="{{ asset('storage/images/payment/'. $book->book_payment) }}" alt="Preview" style="display:block; max-width: 100%; height: auto; margin: 10px auto;">
                                </div>
                                @error('book_payment')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-2 form-group">
                                <label for="book_code">ID Transaksi</label>
                                <input type="text" class="form-control" name="book_code" id="book_code" style="text-transform: uppercase" disabled value="#{{ $book->book_code }}">
                                @error('book_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-2 form-group">
                                <label for="book_product_price">Harga Product + 11 % PPN</label>
                                <input type="text" class="form-control" name="book_product_price" id="book_product_price" disabled value="Rp. {{ number_format((int) $book->book_product->raw_product_price * 1.11, 0, ',', '.') }}">
                                @error('book_product_price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-2 form-group">
                                <label for="book_note">Catatan Tambahan</label>
                                <textarea name="book_note" id="book_note" class="form-control" cols="30" rows="10" disabled
                                    placeholder="Ada catatan tambahan? :)" value="{{ $book->book_note }}">{{ $book->book_note }}</textarea>
                                @error('book_note')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-2 form-group">
                                <label for="book_locate">Titik Temu Lokasi Shoot</label>
                                <textarea name="book_locate" id="book_locate" class="form-control" cols="30" rows="10" disabled
                                    placeholder="Copy Link Dari Google Map Kesini :)" value="{{ $book->book_locate }}">{{ $book->book_locate }}</textarea>
                                @error('book_locate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 mb-2 form-group" style="display: none">
                                <label for="book_product_id">Product ID</label>
                                <input type="text" name="book_product_id" id="book_product_id" class="form-control" value="{{ $book->book_product->id }}">
                                @error('book_product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-info">
                        <h3>{{ $book->book_product->product_price }}</h3>
                        <ul>
                            <li><strong>Nama Product</strong> <span>{{ $book->book_product->product_name }}</span></li>
                            <li><strong>Kategori Product</strong> <span><a href="">{{ $book->book_product->cproduct->name }}</a></span></li>
                            <li><strong>Metode Pembayaran</strong> <span>Scan QRIS</span></li>
                            @if ($book->book_product->author_id === 0)
                                <li><strong>Pengelola</strong> <span>System Administrator</span></li>
                            @else
                                <li><strong>Pengelola</strong> <span>{{ $book->book_product->author->name }}</span></li>
                            @endif
                            @if ($book->book_assign_to === 0)
                                <li><strong>Fotografer</strong> <span>Belum Dipilih</span></li>
                            @else
                                <li><strong>Fotografer</strong> <span>{{ $book->book_assign->name }}</span></li>
                            @endif

                            <li><strong>Tanggal Pesan</strong>
                                <span>
                                    {{ \Carbon\Carbon::parse($book->created_at)->isoFormat('dddd, D MMMM YYYY') . (' - ') .\Carbon\Carbon::parse($book->created_at)->isoFormat('HH:mm') . (' WIB ')  }}
                                </span>
                            </li>
                            <li><strong>Status Booking Saat Ini</strong>
                                <span>
                                    {{ $book->book_stat }}
                                </span>
                            </li>
                            <li><strong>Tanggal Booking Shoot</strong>
                                <span>
                                    {{ \Carbon\Carbon::parse($book->book_date)->isoFormat('dddd, D MMMM YYYY') . (' - ') .\Carbon\Carbon::parse($book->book_time)->isoFormat('HH:mm') . (' WIB ')  }}
                                </span>
                            </li>



                            @guest
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginMember" class="btn btn-outline-danger">
                                        <i class="fa-solid fa-lock" style="margin-right: 20px"></i> Login Untuk Pesan
                                    </a>
                                </li>
                            @endguest
                            @auth
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#scanQRIS" class="btn btn-outline-warning" style="border-radius: 20px">
                                        <i class="fa-solid fa-cart-plus" style="margin-right: 20px"></i> Scan QRIS Di Sini
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#transferBank" class="btn btn-outline-warning" style="border-radius: 20px">
                                        <i class="fa-solid fa-cart-plus" style="margin-right: 20px"></i> Transfer Bank BRI ( Manual)
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>




            </div>

        </div>
    </section><!-- End Projet Details Section -->

</main><!-- End #main -->
@endsection
@section('custom-js')
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            // Pastikan ada file yang dipilih
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
