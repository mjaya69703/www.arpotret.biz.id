@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-12 mb-3">
                <form action="#" method="POST" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Detail Pesan - {{ $email->contact_subject }}</h4>
                            <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_name">Nama Pengirim</label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{ $email->contact_name }}">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_name">Email Pengirim</label>
                                <input type="text" name="contact_mail" id="contact_mail" class="form-control" value="{{ $email->contact_mail }}">
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_name">Subject Pesan</label>
                                <input type="text" name="contact_subject" id="contact_subject" class="form-control" value="{{ $email->contact_subject }}">
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_message">Detail Isi Pesan</label>
                                <textarea name="contact_message" id="dark" class="form-control" cols="5" rows="10" value="{{ $email->contact_message }}">{{ $email->contact_message }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-12 mb-3">
                <form action="{{ route('admin.manage-email.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Balas Pesan - {{ $email->contact_name }}</h4>
                            <div class="">
                                <a href="{{ route('admin.manage-email.index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_codr">Kode Pesan</label>
                                <input type="text" name="contact_codr" id="contact_codr" class="form-control" value="{{ $email->contact_code }}">
                                @error('contact_codr')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_send">Email Tujuan</label>
                                <input type="text" name="contact_send" id="contact_send" class="form-control" value="{{ $email->contact_mail }}">
                                @error('contact_send')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12" style="display: none">
                                <label for="contact_type">Type Pesan</label>
                                <select name="contact_type" id="contact_type" class="form-select">
                                    <option value="1" selected>Pesan Keluar</option>
                                </select>
                                @error('contact_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_name">Nama Pengirim</label>
                                <input type="text" name="contact_name" id="contact_name" class="form-control" value="{{ Auth::guard('admin')->user()->name }}">
                                @error('contact_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="contact_mail">Email Pengirim</label>
                                <input type="email" name="contact_mail" id="contact_mail" class="form-control" value="{{ Auth::guard('admin')->user()->email }}">
                                @error('contact_mail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="contact_name">Subject Pesan</label>
                                <input type="text" name="contact_subject" id="contact_subject" class="form-control" value="Reply to {{ $email->contact_subject }}">
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
                </form>
            </div>
        </div>
    </section>
@endsection
@section('custom-js')
<script src="{{ asset('dist') }}/assets/extensions/tinymce/tinymce.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/tinymce.js"></script>
@endsection
