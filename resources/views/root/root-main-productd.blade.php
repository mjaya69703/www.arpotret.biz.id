@extends('base.base-root-index')
@section('custom-css')
    <style>
        .btn {
            border-radius: 20px;
        }
    </style>
@endsection
@section('content')
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center"
            style="background-image: url('{{ asset('root') }}/assets/img/breadcrumbs-bg.jpg');">
            <div class="container position-relative d-flex flex-column align-items-center text-center" data-aos="fade">

                <h2>{{ $submenu }}</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{ $submenu }}</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Projet Details Section ======= -->
        <section id="project-details" class="project-details">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="position-relative h-100"
                    style="max-width: 560px; margin: 0 auto; text-align: center; display: flex; justify-content: center; align-items: center;">
                    <div class="slides-1 portfolio-details-slider swiper" style="">
                        <div class="swiper-wrapper align-items-center">

                            <div class="swiper-slide">
                                <img src="{{ asset('storage/images/product/cover/' . $product->product_cover) }}" alt="">
                            </div>
                            @if ($product->product_image_1)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_1) }}" alt="">
                                </div>
                            @endif
                            @if ($product->product_image_2)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_2) }}" alt="">
                                </div>
                            @endif
                            @if ($product->product_image_3)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_3) }}" alt="">
                                </div>
                            @endif
                            @if ($product->product_image_4)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_4) }}" alt="">
                                </div>
                            @endif
                            @if ($product->product_image_5)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_5) }}" alt="">
                                </div>
                            @endif
                            @if ($product->product_image_6)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/product/image/' . $product->product_image_6) }}" alt="">
                                </div>
                            @endif

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>


                <div class="row justify-content-between gy-4 mt-4">

                    <div class="col-lg-8">
                        <div class="portfolio-description">
                            <h2>{{ $product->product_name . (' - Kategori ') . $product->cproduct->name }}</h2>
                            <hr>
                            <p>{!! $product->product_desc !!}</p>


                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="portfolio-info">
                            <h3>{{ $product->product_price }}</h3>
                            <ul>
                                <li><strong>Kategori</strong> <span><a href="">{{ $product->cproduct->name }}</a></span></li>
                                @if($product->author_id === 0)
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginMember" class="btn btn-outline-danger"><i class="fa-solid fa-lock" style="margin-right: 20px"></i> Login Untuk Pesan</a>
                                </li>
                                @endguest
                                @auth
                                <li>
                                    <a href="{{ route('root.root-main-product-checkout', $product->product_slug) }}" class="btn btn-outline-warning"><i class="fa-solid fa-cart-shopping" style="margin-right: 20px"></i> Pesan Sekarang</a>
                                </li>
                                <li>

                                    <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-star" style="margin-right: 20px"></i> Berikan Rating</a>
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
@endsection
