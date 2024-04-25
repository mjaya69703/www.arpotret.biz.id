@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('admin.manage-product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Cover Product</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <img src="{{ asset('storage/images/product/cover/' . $product->product_cover) }}" class="card-img-top" alt="">                                <label for="product_cover">Upload Logo</label>
                                <input type="file" name="product_cover" id="product_cover" class="form-control" accept="image/*">
                                @error('product_cover') <small class="text-danger">{{ $message }}</small>  @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Product</h4>
                            <div class="">
                                <a href="{{ route('admin.manage-product.index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <label for="product_name">Nama Product</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Inputkan nama product..." value="{{ $product->product_name }}">
                                    @error('product_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="cproduct_id">Pilih Kategori Product</label>
                                    <select name="cproduct_id" id="cproduct_id" class="form-select">
                                        <option selected disabled>Pilih Product</option>
                                        @foreach ($productC as $item)
                                            <option value="{{ $item->id }}" {{ $item->id === $product->cproduct_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cproduct_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="product_price">Harga Product</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price" placeholder="Inputkan harga product..." value="{{ $product->product_price }}">
                                    @error('product_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group col-lg-12 col-12">
                                    <label for="product_desc">Deskripsi Product</label>
                                    <textarea name="product_desc" id="dark" class="form-control" cols="5" rows="10" placeholder="Inputkan deskripsi product..." value="{{ $product->product_desc }}">{{ $product->product_desc }}</textarea>
                                    @error('product_desc')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach(['product_image_1', 'product_image_2', 'product_image_3', 'product_image_4', 'product_image_5', 'product_image_6'] as $image)
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Tambah {{ ucfirst(str_replace('_', ' ', $image)) }}</h4>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                            <div class="card-body">
                                <img id="{{ $image }}-preview" src="{{ asset('storage/images/product/image/' . $product->$image) }}" class="card-img-top" alt="" style="">
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
    document.getElementById("product_cover").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.card-img-top');
            output.src = reader.result;
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
