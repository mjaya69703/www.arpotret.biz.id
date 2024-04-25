@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('admin.manage-email.sendto') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Data Informasi Kirim Email</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_send">Pilih Nama Penerima</label>
                                <select name="contact_send" id="contact_send" class="form-select">
                                    <option value="" selected>Pilih Nama Penerima</option>
                                    @foreach ($users as $item)
                                    <option value="{{ $item->email }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('contact_send')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_name">Nama Pengirim</label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" value="{{ Auth::guard('admin')->user()->name }}">
                                @error('contact_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_mail">Alamat Email Pengirim</label>
                                <input type="text" class="form-control" name="contact_mail" id="contact_mail" value="{{ Auth::guard('admin')->user()->email }}">
                                @error('contact_mail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Data Pesanan</h4>
                            <div class="">
                                <a href="{{ route('admin.manage-email.index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <label for="contact_subject">Subject Pesan</label>
                                    <input type="text" class="form-control" name="contact_subject" id="contact_subject" placeholder="Isi subject pesan...">
                                    @error('contact_subject')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12 col-12">
                                    <label for="contact_message">Detail Isi Pesan</label>
                                    <textarea name="contact_message" id="dark" class="form-control" cols="5" rows="10" placeholder="Inputkan isi balasan pesan..."></textarea>
                                    @error('contact_message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('custom-js')
<script src="{{ asset('dist') }}/assets/extensions/tinymce/tinymce.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/tinymce.js"></script>


@endsection
