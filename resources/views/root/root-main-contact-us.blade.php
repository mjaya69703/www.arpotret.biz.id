@extends('base.base-root-index')
@section('custom-css')
@endsection
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ asset('root') }}/assets/img/breadcrumbs-bg.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center text-center" data-aos="fade">

        <h2>{{ $submenu }}</h2>
        <ol>
          <li><a href="/">Home</a></li>
          <li>{{ $submenu }}</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

          <div class="row gy-4">
            <div class="col-lg-6">
              <div class="info-item  d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-map"></i>
                <h3>Our Address</h3>
                <p>{{ $web->site_street . (', ') . $web->site_poscod }}</p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p><a href="mailto:{{ $web->site_email }}">{{ $web->site_email }}</a></p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-lg-3 col-md-6">
              <div class="info-item  d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p><a href="tel:{{ $web->site_phone }}">{{ $web->site_phone }}</a></p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="row gy-4 mt-1">
            <div class="col-lg-6 ">
                {!! $web->site_locate !!}
            </div><!-- End Google Maps -->

            <div class="col-lg-6">
              <form action="{{ route('root.root-main-contact-store') }}" method="post" class="mail-form">
                @csrf
                <div class="row gy-4">
                  <div class="col-lg-6 form-group">
                    <input type="text" name="contact_name" class="form-control" id="contact_name" placeholder="Your Name..." value="{{ Auth::user()->name ?? '' }}" required>
                    @error('contact_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <input type="email" class="form-control" name="contact_mail" id="contact_mail" placeholder="Your Email..." value="{{ Auth::user()->email ?? '' }}" required>
                    @error('contact_mail') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="contact_subject" id="contact_subject" placeholder="Your subject..." required>
                  @error('contact_subject') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="contact_message" rows="5" placeholder="Enter your message in here..." required></textarea>
                  @error('contact_message') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="my-3">
                </div>
                <div class="text-center"><button type="submit" class="btn btn-outline-warning">Send Message</button></div>
              </form>
            </div><!-- End Contact Form -->

          </div>

        </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

@endsection
@section('custom-js')

@endsection
