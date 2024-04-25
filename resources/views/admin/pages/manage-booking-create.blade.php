@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('admin.manage-booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Bukti Pembayaran</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <img src="" class="card-img-top" alt="" style="display: none;">
                                <label for="book_payment">Upload Bukti Pembayaran</label>
                                <input type="file" name="book_payment" id="book_payment" class="form-control" accept="image/*">
                                @error('book_payment') <small class="text-danger">{{ $message }}</small>  @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Data Pesanan</h4>
                            <div class="">
                                <a href="{{ route('admin.manage-booking.index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <label for="book_client_name">Nama Client</label>
                                    <input type="text" class="form-control" name="book_client_name" id="book_client_name" placeholder="Inputkan nama product...">
                                    @error('book_client_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12 col-12">
                                    <label for="book_client_email">Kontak Client ( Email )</label>
                                    <input type="email" class="form-control" name="book_client_email" id="book_client_email" placeholder="Inputkan email client...">
                                    @error('book_client_email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12 col-12">
                                    <label for="book_client_phone">Kontak Client ( Whatsapp)</label>
                                    <input type="text" class="form-control" name="book_client_phone" id="book_client_phone" placeholder="Inputkan nomor telepon client...">
                                    @error('book_client_phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="book_product_id">Pilih Product</label>
                                    <select name="book_product_id" id="book_product_id" class="form-select">
                                        <option selected disabled>Pilih Product</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->id }}" data-price="{{ $item->raw_product_price }}">{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('book_product_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_price">Harga Product + 11% PPN</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Inputkan harga product...">
                                    @error('product_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="book_date">Tanggal Booking</label>
                                    <input type="date" name="book_date" id="book_date" class="form-control" placeholder="Inputkan tanggal booking...">
                                    @error('book_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="book_time">Waktu Booking</label>
                                    <input type="time" name="book_time" id="book_time" class="form-control" placeholder="Inputkan waktu booking...">
                                    <small>Jam operasional kami pukul 07.00 - 22.00 WIB</small><br>
                                    @error('book_time')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="book_locate">Lokasi Titik Temu</label>
                                    <textarea name="book_locate" id="book_locate" class="form-control" cols="30" rows="10" placeholder="Copy Link Dari Google Map Kesini :)"></textarea>
                                    @error('book_locate')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="book_note">Deskripsi Product</label>
                                    <textarea name="book_note" class="form-control" cols="30" rows="10" placeholder="Ada catatan tambahan?"></textarea>
                                    @error('book_note')
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
<script>
    document.getElementById("book_payment").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.card-img-top');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<script src="{{ asset('dist') }}/assets/extensions/tinymce/tinymce.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/tinymce.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#book_product_id').change(function(){
        var price = parseFloat($('option:selected', this).data('price'));
        var tax = price * 0.11; // Menghitung PPN 11%
        var total = price + tax; // Menambahkan PPN ke harga produk

        // Memformat total menjadi format mata uang Indonesia (IDR)
        var totalFormatted = 'Rp. ' + total.toLocaleString('id-ID');

        $('#product_price').val(totalFormatted);
    });
});
</script>


@endsection
