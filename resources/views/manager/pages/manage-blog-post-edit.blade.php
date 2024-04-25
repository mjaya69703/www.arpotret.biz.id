@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <form action="{{ route('manager.manage-blog.posts-update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">

                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Cover Postingan</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <img src="{{ asset('storage/images/posts/cover/'. $post->post_cover) }}" class="card-img-top" alt="" style="display: block;">
                                <label for="post_cover">Upload Cover Postingan</label>
                                <input type="file" name="post_cover" id="post_cover" class="form-control" accept="image/*">
                                @error('post_cover') <small class="text-danger">{{ $message }}</small>  @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Edit Data Postingan</h4>
                            <div class="">
                                <a href="{{ route('manager.manage-blog.posts-index') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-12 col-12">
                                    <label for="post_title">Nama Judul Postingan</label>
                                    <input type="text" class="form-control" name="post_title" id="post_title" value="{{ $post->post_title }}" placeholder="Inputkan judul postingan...">
                                    @error('post_title')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="category_id">Pilih Kategori Postingan</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}" {{ $post->category_id == $item->id ? 'selected' : '' }} >{{ $item->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-6 col-12">
                                    <label for="tags[]">Pilih Tags</label>
                                    <select name="tags[]" class="choices form-select multiple-remove" multiple="multiple">
                                        <option value="">Pilih Tags</option>
                                        @foreach ($tag as $item)
                                        <option value="{{ $item->id }}" {{ in_array($item->id, old('tags[]', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $item->tags_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags[]')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-12 col-12">
                                    <label for="post_keyword">Keyword Postingan</label>
                                    <input type="text" class="form-control" name="post_keyword" id="post_keyword" value="{{ $post->post_keyword }}" placeholder="Inputkan keyword postingan...">
                                    @error('post_keyword')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-12 col-12">
                                    <label for="post_metadesc">Meta Deskripsi Postingan</label>
                                    <input type="text" class="form-control" name="post_metadesc" id="post_metadesc" value="{{ $post->post_metadesc }}" placeholder="Inputkan metadesc postingan...">
                                    @error('post_metadesc')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group col-lg-12 col-12">
                                <label for="post_desc">Detail Isi Pesan</label>
                                <textarea name="post_desc" id="summernote" class="form-control" cols="5" rows="10" placeholder="Inputkan isi postingan...">{!! $post->post_desc !!}</textarea>
                                @error('post_desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
    document.getElementById("post_cover").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.card-img-top');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
<script src="{{ asset('dist') }}/assets/extensions/jquery/jquery.min.js"></script>
<script src="{{ asset('dist') }}/assets/extensions/summernote/summernote-lite.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/summernote.js"></script>
<script src="{{ asset('dist') }}/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/form-element-select.js"></script>


@endsection
@section('custom-css')
<link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/summernote/summernote-lite.css">
<link rel="stylesheet" href="{{ asset('dist') }}/assets/compiled/css/form-editor-summernote.css">
<link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/choices.js/public/assets/styles/choices.css">
@endsection
