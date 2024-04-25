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

        <!-- ======= Our Projects Section ======= -->
        <section id="Services" class="projects">
            <div class="container" data-aos="fade-up">


                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                    data-portfolio-sort="original-order">

                    <ul class="portfolio-flters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($productc as $item)
                            <li data-filter=".filter-{{ $item->slug }}">{{ $item->name }}</li>
                        @endforeach
                    </ul><!-- End Projects Filters -->

                    <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">

                        @foreach ($product as $item)
                            <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $item->cproduct->slug }}">
                                <div class="portfolio-content h-100">
                                    <img src="{{ asset('storage/images/product/cover/' . $item->product_cover) }}"
                                        class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <h4>{{ $item->cproduct->name }}</h4>
                                        <p>{{ $item->product_name }}</p>
                                        <a href="{{ asset('storage/images/product/cover/' . $item->product_cover) }}"
                                            title="{{ $item->product_name }}" data-gallery="portfolio-gallery-remodeling"
                                            class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                        <a href="{{ route('root.root-main-product-detail', $item->product_slug) }}"
                                            title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                    </div>
                                </div>
                            </div><!-- End Projects Item -->
                        @endforeach





                    </div><!-- End Projects Container -->

                </div>

            </div>
        </section><!-- End Our Projects Section -->

    </main><!-- End #main -->
@endsection
@section('custom-js')
@endsection
