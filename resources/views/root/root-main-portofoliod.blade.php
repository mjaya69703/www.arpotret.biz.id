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
                                <img src="{{ asset('storage/images/gallery/cover/' . $gallery->gallery_cover) }}" alt="">
                            </div>
                            @if ($gallery->gallery_image_1)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_1) }}" alt="">
                                </div>
                            @endif
                            @if ($gallery->gallery_image_2)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_2) }}" alt="">
                                </div>
                            @endif
                            @if ($gallery->gallery_image_3)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_3) }}" alt="">
                                </div>
                            @endif
                            @if ($gallery->gallery_image_4)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_4) }}" alt="">
                                </div>
                            @endif
                            @if ($gallery->gallery_image_5)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_5) }}" alt="">
                                </div>
                            @endif
                            @if ($gallery->gallery_image_6)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/images/gallery/image/' . $gallery->gallery_image_6) }}" alt="">
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
                            <h2>{{ $gallery->gallery_name . (' - Kategori ') . $gallery->cproduct->name }}</h2>
                            <hr>
                            <p>{!! $gallery->gallery_desc !!}</p>


                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="portfolio-info">
                            <h3>{{ $gallery->product->product_price }}</h3>
                            <ul>
                                <li><strong>Lihat Kategori</strong> <span><a href="">{{ $gallery->cproduct->name }}</a></span></li>
                                <li><strong>Lihat Product</strong> <span><a href="{{ route('root.root-main-product-detail', $gallery->product->product_slug) }}">{{ $gallery->product->product_name }}</a></span></li>
                                @if($gallery->author_id === 0)
                                <li><strong>Pengelola</strong> <span>System Administrator</span></li>
                                @else
                                <li><strong>Pengelola</strong> <span>{{ $gallery->author->name }}</span></li>
                                @endif
                                <li><strong>Ditambahkan Pada</strong>
                                    <span>
                                        {{ \Carbon\Carbon::parse($gallery->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                                    </span>
                                </li>
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
