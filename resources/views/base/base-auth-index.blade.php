<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link
            rel="apple-touch-icon"
            sizes="76x76"
            href="{{ asset('auth') }}/assets/img/apple-icon.png">
        <link
            rel="icon"
            type="image/png"
            href="{{ asset('auth') }}/assets/img/favicon.png">
        <title>{{ $title . (' - ') . $menu . (' - ') . $submenu }}</title>

 
        <meta
            property="og:description"
            content="Argon Dashboard 2 is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you."/>
        <meta property="og:site_name" content="Creative Tim"/>

        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
            rel="stylesheet"/>

        <link href="{{ asset('auth') }}/assets/css/nucleo-icons.css" rel="stylesheet"/>
        <link href="{{ asset('auth') }}/assets/css/nucleo-svg.css" rel="stylesheet"/>

        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{ asset('auth') }}/assets/css/nucleo-svg.css" rel="stylesheet"/>

        <link
            id="pagestyle"
            href="{{ asset('auth') }}/assets/css/argon-dashboard.min.css?v=2.0.4"
            rel="stylesheet"/>

        <style>
            .async-hide {
                opacity: 0 !important;
            }
        </style>

    </head>
    <body class="class">

        <noscript>
            <iframe
                src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
                height="0"
                width="0"
                style="display:none;visibility:hidden"></iframe>
        </noscript>

        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">

                    <nav
                        class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                        <div class="container-fluid">
                            <a
                                class="navbar-brand font-weight-bolder ms-lg-0 ms-3 "
                                href="{{ url('admin/login') }}">
                                {{ $title }}
                            </a>
                            <button
                                class="navbar-toggler shadow-none ms-2"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navigation"
                                aria-controls="navigation"
                                aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon mt-2">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </span>
                            </button>
                            <div class="collapse navbar-collapse" id="navigation">
                                <ul class="navbar-nav mx-auto">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link d-flex align-items-center me-2 active"
                                            aria-current="page"
                                            href="{{ asset('auth') }}">
                                            <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="{{ asset('auth') }}/pages/profile.html">
                                            <i class="fa fa-user opacity-6 text-dark me-1"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="{{ asset('auth') }}/pages/sign-up.html">
                                            <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                            Sign Up
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link me-2" href="{{ asset('auth') }}/pages/sign-in.html">
                                            <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                            Sign In
                                        </a>
                                    </li>
                                </ul>
                                    @if(Route::is('auth.auth-signin'))
                                    <ul class="navbar-nav d-lg-block d-none">
                                        <li class="nav-item">
                                            <a href="/admin/regist" class="btn btn-sm mb-0 me-1 btn-primary">Register User</a>
                                        </li>
                                    </ul>
                                @elseif(Route::is('auth.auth-signup'))
                                    <ul class="navbar-nav d-lg-block d-none">
                                        <li class="nav-item">
                                            <a href="/admin/login" class="btn btn-sm mb-0 me-1 btn-primary">Login User</a>
                                        </li>
                                    </ul>
                                @endif
                            
                            </div>
                        </div>
                    </nav>

                </div>
            </div>
        </div>
        <main class="main-content  mt-0">
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                              @yield('content')
                            </div>
                            <div
                                class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                                <div
                                    class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                    style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
          background-size: cover;">
                                    <span class="mask bg-gradient-primary opacity-6"></span>
                                    <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new currency"</h4>
                                    <p class="text-white position-relative">The more effortless the writing looks,
                                        the more effort the writer actually put into the process.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script src="{{ asset('auth') }}/assets/js/core/popper.min.js"></script>
        <script src="{{ asset('auth') }}/assets/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('auth') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('auth') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator
                .platform
                .indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>

        <script src="{{ asset('auth') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
        <script
            defer="defer"
            src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
            integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
            data-cf-beacon='{"rayId":"82157e3d9e753e2f","version":"2023.10.0","token":"1b7cbb72744b40c580f8633c6b62637e"}'
            crossorigin="anonymous"></script>
    </body>
</html>