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
                            <img src="{{ asset('storage/images/product/cover/' . $product->product_cover) }}"
                                alt="">
                        </div>
                        @if ($product->product_image_1)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_1) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($product->product_image_2)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_2) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($product->product_image_3)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_3) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($product->product_image_4)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_4) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($product->product_image_5)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_5) }}"
                                    alt="">
                            </div>
                        @endif
                        @if ($product->product_image_6)
                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/image/' . $product->product_image_6) }}"
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
                    <form action="{{ route('root.root-main-product-checkout.store', $product->product_slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span style="font-size: 20px">Data Informasi Pesanan</span>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i> Buat Pesanan</button>

                            </div>
                            <div class="card-body row">
                                <div class="col-lg-12 col-12 form-group mb-2">
                                    <label for="book_payment">Pilih File Bukti Pembayaran (Gambar)</label>
                                    <input type="file" class="form-control" name="book_payment" id="book_payment" accept="image/*" onchange="previewImage(event)">
                                    <div class="text-center">
                                        <img id="preview" src="#" alt="Preview" style="display:none; max-width: 100%; height: auto; margin: 10px auto;">
                                    </div>
                                    @error('book_payment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mb-2 form-group">
                                    <label for="book_date">Pilih Tanggal Booking</label>
                                    <input type="date" class="form-control" name="book_date" id="book_date">
                                    @error('book_date')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mb-2 form-group">
                                    <label for="book_time">Pilih Waktu Booking</label>
                                    <input type="time" class="form-control" name="book_time" id="book_time">
                                    <small>Jam Operasional Kami Pukul 07.00 WIB - 22.00 WIB</small>
                                    @error('book_time')
                                        <br>
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mb-2 form-group">
                                    <label for="book_note">Catatan Tambahan</label>
                                    <textarea name="book_note" id="book_note" class="form-control" cols="30" rows="10"
                                        placeholder="Ada catatan tambahan? :)"></textarea>
                                    @error('book_note')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mb-2 form-group">
                                    <label for="book_locate">Titik Temu Lokasi Shoot</label>
                                    <textarea name="book_locate" id="book_locate" class="form-control" cols="30" rows="10"
                                        placeholder="Copy Link Dari Google Map Kesini :)"></textarea>
                                    @error('book_locate')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mb-2 form-group" style="display: none">
                                    <label for="book_product_id">Product ID</label>
                                    <input type="text" name="book_product_id" id="book_product_id" class="form-control" value="{{ $product->id }}">
                                    @error('book_product_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3">
                    <div class="portfolio-info">
                        <h3>{{ $product->product_price }}</h3>
                        <ul>
                            <li><strong>Nama Product</strong> <span>{{ $product->product_name }}</span></li>
                            <li><strong>Kategori Product</strong> <span><a href="">{{ $product->cproduct->name }}</a></span></li>
                            <li><strong>Metode Pembayaran</strong> <span>Scan QRIS</span></li>
                            @if ($product->author_id === 0)
                                <li><strong>Pengelola</strong> <span>System Administrator</span></li>
                            @else
                                <li><strong>Pengelola</strong> <span>{{ $product->author->name }}</span></li>
                            @endif
                            <li><strong>Ditambahkan Pada</strong>
                                <span>
                                    {{ \Carbon\Carbon::parse($product->created_at)->isoFormat('dddd, D MMMM YYYY') }}
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
