<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">


    <title>{{ $web->site_name . ' - ' . $menu . ' - ' . $submenu }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('root') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('root') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    {{-- FORM EXIT --}}
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('dist') }}//assets/compiled/css/table-datatable.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('root') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('root') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('root') }}/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('root') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('root') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('root') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor') }}/sweetalerts2/sweetalerts2.css">


    <!-- Template Main CSS File -->
    <link href="{{ asset('root') }}/assets/css/main.css" rel="stylesheet">
    <style>
        /* CSS untuk tampilan mobile */
        @media (max-width: 768px) {
            .footer-menu {
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                /* Animasi tampilan menu */
                opacity: 0;
                /* Awalnya sembunyikan teks dengan opacity 0 */
            }

            .footer-links h4 {
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: space-between;
                transition: transform 0.3s ease;
                /* Animasi ikon */
            }

            .footer-links.active .footer-menu {
                max-height: 300px;
                /* Sesuaikan dengan tinggi menu yang Anda inginkan */
                opacity: 1;
                /* Tampilkan teks dengan opacity 1 saat dibuka */
            }

            .footer-links.active h4 .dropdown-indicator {
                transform: scale(0.8);
                /* Mengubah ukuran ikon ketika dibuka */
            }

            .footer-links .dropdown-indicator {
                display: inline;
                /* Tampilkan ikon di tampilan mobile */
            }
        }

        /* CSS untuk tampilan desktop */
        @media (min-width: 769px) {
            .footer-links .dropdown-indicator {
                display: none;
                /* Sembunyikan ikon di tampilan desktop */
            }
        }
    </style>
    @yield('custom-css')
</head>

<body>
    @include('sweetalert::alert')
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('storage/images/default/' . $web->site_logo) }}" alt="">
                {{-- <h1>UpConstruction<span>.</span></h1> --}}
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            @php  $page = App\Models\PageManager::where('page_id', 1)->get() @endphp
            <nav id="navbar" class="navbar">
                <ul>
                    @foreach ($page as $item)
                        <li>
                            <a href="{{ url($item->page_link) }}" class="{{ Str::is($item->page_link, request()->path()) ? 'active' : '' }}">{{ $item->page_name }}</a>
                        </li>
                    @endforeach
                    @guest
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginMember">Sign In</a></li>
                    @endguest
                    @auth
                        <li class="dropdown">
                            <a href="#"><i class="fa-solid fa-user-circle"
                                    style="font-size: 20px; margin-right: 8px;"></i>
                                <span style="margin-right: 5px;">{{ Auth::user()->name }}</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i>
                            </a>
                            <ul>
                                <li><a href="{{ route('auth-member.history-checkout') }}">Riwayat Pesanan</a></li>
                                <li>
                                    <a href="#" onclick="logout(event)">Sign Out</a>
                                    <form id="logout-form" action="{{ route('auth-member.auth-signout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth

                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('content')
    @include('base.base-root-modal')


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>{{ $web->site_name }}</h3>
                            <p>
                                {{ $web->site_street }} <br>
                                {{ $web->site_poscod }}<br><br>
                                <strong>Phone:</strong> <a
                                    href="tel:{{ $web->site_phone }}">{{ $web->site_phone }}</a><br>
                                <strong>Email:</strong> <a
                                    href="mailto:{{ $web->site_email }}">{{ $web->site_email }}</a><br>
                            </p>
                            <div class="social-links d-flex mt-3">
                                <a href="#" class="d-flex align-items-center justify-content-center"><i
                                        class="bi bi-twitter"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i
                                        class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div><!-- End footer info column-->

                    @php $pagea = App\Models\PageManager::where('id', 2)->first(); @endphp
                    @php $page1 = App\Models\PageManager::where('page_id', '2')->paginate(5); @endphp
                    @if($page1->count() > 1)
                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>{{ $pagea->page_name }} <i class="bi bi-chevron-down dropdown-indicator"></i></h4>
                        <ul class="footer-menu">
                            @foreach ($page1 as $key => $item)
                                <li><a href="{{ $item->page_link }}">{{ $item->page_name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End footer links column-->
                    @endif

                    @php $pageb = App\Models\PageManager::where('id', 3)->first(); @endphp
                    @php $page2 = App\Models\PageManager::where('page_id', '3')->paginate(5); @endphp
                    @if($page2->count() > 1)
                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>{{ $pageb->page_name }} <i class="bi bi-chevron-down dropdown-indicator"></i></h4>
                        <ul class="footer-menu">
                            @foreach ($page2 as $key => $item)
                                <li><a href="{{ $item->page_link }}">{{ $item->page_name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End footer links column-->
                    @endif

                    @php $pagec = App\Models\PageManager::where('id', 4)->first(); @endphp
                    @php $page3 = App\Models\PageManager::where('page_id', '4')->paginate(5); @endphp
                    @if($page3->count() > 1)
                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>{{ $pagec->page_name }} <i class="bi bi-chevron-down dropdown-indicator"></i></h4>
                        <ul class="footer-menu">
                            @foreach ($page3 as $key => $item)
                                <li><a href="{{ $item->page_link }}">{{ $item->page_name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End footer links column-->
                    @endif

                    @php $paged = App\Models\PageManager::where('id', 5)->first(); @endphp
                    @php $page4 = App\Models\PageManager::where('page_id', '5')->paginate(5); @endphp
                    @if($page4->count() > 0)
                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>{{ $paged->page_name }} <i class="bi bi-chevron-down dropdown-indicator"></i></h4>
                        <ul class="footer-menu">
                            @foreach ($page4 as $key => $item)
                                <li><a href="{{ $item->page_link }}">{{ $item->page_name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End footer links column-->
                    @endif



                </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>{{ $web->site_name }}</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('root') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('root') }}/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('root') }}/assets/js/main.js"></script>
    <script src="{{ asset('vendor') }}/sweetalerts2/custom-sweetalert.js"></script>
    <script src="{{ asset('vendor') }}/sweetalerts2/sweetalerts2.min.js"></script>
    {{-- FORM EXIT --}}
    <script src="{{ asset('dist') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('dist') }}/assets/static/js/pages/simple-datatables.js"></script>
    <script>
        function logout(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, log out',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Logout cancelled',
                        'error'
                    );
                }
            });
        }
    </script>
    <script>
        const footerLinks = document.querySelectorAll('.footer-links');

        footerLinks.forEach((link) => {
            const title = link.querySelector('h4');
            title.addEventListener('click', () => {
                link.classList.toggle('active');
            });
        });
    </script>
    @yield('custom-js')


</body>

</html>
