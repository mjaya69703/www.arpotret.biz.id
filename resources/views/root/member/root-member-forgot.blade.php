
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
                    <form action="{{ route('auth-member.auth-forgot-post', $user->verify_token) }}" method="POST" enctype="multipart/form-data">   
                        @csrf                 
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span style="font-size: 20px;">{{ $submenu }}</span>
                                <div class="">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="form-group col-lg-6 col-12 mb-2">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Inputkan email address..." value="{{ $user->email }}" disabled>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12 mb-2">
                                    <label for="verify_token">Token Verifikasi</label>
                                    <input type="text" name="verify_token" id="verify_token" class="form-control" placeholder="Inputkan token verifikasi address..." value="{{ $user->verify_token }}" disabled>
                                    @error('verify_token') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12 mb-2">
                                    <label for="password">Kata Sandi Baru</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Inputkan kata sandi baru...">
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12 mb-2">
                                    <label for="password">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Inputkan kata sandi baru...">
                                    @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->
@endsection
@section('custom-css')
    
@endsection
@section('custom-js')
    
@endsection