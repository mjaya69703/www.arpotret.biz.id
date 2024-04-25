@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('admin.manage-web.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit QRIS Payment</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/images/default/' . $web->site_qris) }}" class="card-img-top"
                                alt="">
                            <label for="site_qris">Upload Logo</label>
                            <input type="file" name="site_qris" id="site_qris" class="form-control" accept="image/*">
                            @error('site_qris') <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Identitas Website</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="row card-body">
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_name">Nama Website</label>
                                <input type="text" name="site_name" id="site_name" class="form-control" placeholder="Inputkan nama website..." value="{{ $web->site_name }}">
                                @error('site_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_link">Link Website</label>
                                <input type="text" name="site_link" id="site_link" class="form-control" placeholder="Inputkan link website..." value="{{ $web->site_link }}">
                                @error('site_link') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_head">Tag Line Atas</label>
                                <input type="text" name="site_head" id="site_head" class="form-control" placeholder="Inputkan Tag Line Atas..." value="{{ $web->site_head }}">
                                @error('site_head') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_desc">Tag Line Bawah</label>
                                <input type="text" name="site_desc" id="site_desc" class="form-control" placeholder="Inputkan Tag Line Bawah..." value="{{ $web->site_desc }}">
                                @error('site_desc') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_street">Nama Jalan</label>
                                <input type="text" name="site_street" id="site_street" class="form-control" placeholder="Inputkan nama jalan..." value="{{ $web->site_street }}">
                                @error('site_street') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_poscod">Kode Pos / Region</label>
                                <input type="text" name="site_poscod" id="site_poscod" class="form-control" placeholder="Inputkan kode pos / region..." value="{{ $web->site_poscod }}">
                                @error('site_poscod') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_email">Email</label>
                                <input type="email" name="site_email" id="site_email" class="form-control" placeholder="Inputkan email..." value="{{ $web->site_email }}">
                                @error('site_email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_phone">Telepon</label>
                                <input type="text" name="site_phone" id="site_phone" class="form-control" placeholder="Inputkan nomor telepon..." value="{{ $web->site_phone }}">
                                @error('site_phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_social_fb">Facebook</label>
                                <input type="url" name="site_social_fb" id="site_social_fb" class="form-control" placeholder="Inputkan tautan Facebook..." value="{{ $web->site_social_fb }}">
                                @error('site_social_fb') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_social_ig">Instagram</label>
                                <input type="url" name="site_social_ig" id="site_social_ig" class="form-control" placeholder="Inputkan tautan Instagram..." value="{{ $web->site_social_ig }}">
                                @error('site_social_ig') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_social_in">LinkedIn</label>
                                <input type="url" name="site_social_in" id="site_social_in" class="form-control" placeholder="Inputkan tautan LinkedIn..." value="{{ $web->site_social_in }}">
                                @error('site_social_in') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="site_social_tw">Twitter</label>
                                <input type="url" name="site_social_tw" id="site_social_tw" class="form-control" placeholder="Inputkan tautan Twitter..." value="{{ $web->site_social_tw }}">
                                @error('site_social_tw') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="site_locate">Embed Lokasi Map ( Tempelkan Link Embed)</label>
                                <input type="text" name="site_locate" id="site_locate" class="form-control" placeholder="Tempelkan link embed google maps..." value="{{ $web->site_locate }}">
                                @error('site_locate') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                @foreach(['site_logo', 'slider_1', 'slider_2', 'slider_3', 'slider_4', 'slider_5'] as $image)
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit {{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/images/default/' . $web->$image) }}" class="card-img-top" alt="">
                            <label for="{{ $image }}">Upload {{ ucfirst(str_replace('_', ' ', $image)) }}</label>
                            <input type="file" name="{{ $image }}" id="{{ $image }}" class="form-control" accept="image/*" onchange="previewImage(event, '{{ $image }}')">
                            @error($image) <small class="text-danger">{{ $message }}</small>  @enderror
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </form>
    </section>
@endsection
@section('custom-js')
    <script>
        document.getElementById("site_logo").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        @foreach(['slider_1', 'slider_2', 'slider_3', 'slider_4', 'slider_5', 'site_qris', 'site_logo'] as $image)
            document.getElementById("{{ $image }}").addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = event.target.parentNode.querySelector('.card-img-top');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        @endforeach
    </script>
@endsection
