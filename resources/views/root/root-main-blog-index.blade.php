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
                    <li><a href="/">Home</a></li>
                    <li>{{ $submenu }}</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 posts-list">

                    @foreach ($posts as $key => $item)
                        <div class="col-xl-4 col-md-6">
                            <div class="post-item position-relative h-100">

                                <div class="post-img position-relative overflow-hidden">
                                    <img src="{{ asset('storage/images/posts/cover/' . $item->post_cover) }}" class="img-fluid"
                                        alt="">
                                    <span class="post-date">{{ $item->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="post-content d-flex flex-column">

                                    <h3 class="post-title">{{ $item->post_title }}</h3>

                                    <div class="meta d-flex align-items-center">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person"></i> <span class="ps-2">{{ $item->author->name }}</span>
                                        </div>
                                        <span class="px-3 text-black-50">/</span>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-folder2"></i> <span
                                                class="ps-2">{{ $item->category->category_name }}</span>
                                        </div>
                                    </div>

                                    <p>
                                        {!! Str::limit(strip_tags($item->post_desc), 60) !!}
                                    </p>

                                    <hr>

                                    <a href="{{ route('root.root-main-blog-details', $item->post_slug) }}"
                                        class="readmore stretched-link"><span>Read More</span><i
                                            class="bi bi-arrow-right"></i></a>

                                </div>

                            </div>
                        </div><!-- End post list item -->
                    @endforeach

                </div><!-- End blog posts list -->


                <div class="blog-pagination">
                    <ul class="justify-content-center">
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                    </ul>
                </div><!-- End blog pagination -->

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
@section('custom-js')
@endsection
