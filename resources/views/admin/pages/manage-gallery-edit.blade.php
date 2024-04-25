@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('admin.manage-product.portofolio-update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Cover Gallery</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <img src="{{ asset('storage/images/gallery/cover/'. $gallery->gallery_cover) }}" class="card-img-top" alt="" style="">
                                <label for="gallery_cover">Upload cover gallery</label>
                                <input type="file" name="gallery_cover" id="gallery_cover" class="form-control" accept="image/*">
                                @error('gallery_cover') <small class="text-danger">{{ $message }}</small>  @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Product</h4>
                            <div class="">
                                <a href="{{ route('admin.manage-product.portofolio-index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <label for="gallery_name">Nama Album Gallery</label>
                                    <input type="text" class="form-control" name="gallery_name" id="gallery_name" placeholder="Inputkan nama album gallery..." value="{{ $gallery->gallery_name }}" >
                                    @error('gallery_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="cproduct_id">Pilih Kategori Product</label>
                                    <select name="cproduct_id" id="cproduct_id" class="form-select">
                                        <option selected disabled>Pilih Kategori Product</option>
                                        @foreach ($productC as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $gallery->cproduct_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cproduct_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_id">Pilih Product</label>
                                    <select name="product_id" id="product_id" class="form-select">
                                        <option selected disabled>Pilih Product</option>
                                        @foreach ($product as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $gallery->product_id ? 'selected' : '' }} >{{ $item->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12 col-12">
                                    <label for="gallery_desc">Deskripsi Product</label>
                                    <textarea name="gallery_desc" id="dark" class="form-control" cols="5" rows="10" placeholder="Inputkan deskripsi gallery..." value="{{ $gallery->gallery_desc }}">{{ $gallery->gallery_desc }}</textarea>
                                    @error('gallery_desc')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach(['gallery_image_1', 'gallery_image_2', 'gallery_image_3', 'gallery_image_4', 'gallery_image_5', 'gallery_image_6'] as $image)
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah {{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <img id="{{ $image }}-preview" src="{{ asset('storage/images/gallery/image/'. $gallery->$image) }}" class="card-img-top" alt="" style="">
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
    document.getElementById("gallery_cover").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.card-img-top');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<script>
    function previewImage(event, id) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(id + "-preview");
            output.src = reader.result;
            output.style.display = "block";
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<script src="{{ asset('dist') }}/assets/extensions/tinymce/tinymce.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/tinymce.js"></script>
@endsection
