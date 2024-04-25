@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-12 mb-3">
                <form action="{{ route('admin.manage-blog.category-store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Kategori</h4>
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="category_name">Nama Kategori</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Inputkan nama Kategori...">
                                @error('category_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_keyword">Keyword Kategori</label>
                                <input type="text" name="category_keyword" id="category_keyword" class="form-control" placeholder="Inputkan keyword Kategori...">
                                @error('category_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_metadesc">Meta Description Kategori</label>
                                <input type="text" name="category_metadesc" id="category_metadesc" class="form-control" placeholder="Inputkan meta desc Kategori...">
                                @error('category_metadesc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-8 col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Kategori</h4>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Jumlah Semua Post: {{ \App\Models\Post::all()->count() }}</span>
                            <span>Jumlah Semua Kategori: {{ \App\Models\Category::all()->count() }}</span>
                            <span>Jumlah Semua Tags: {{ \App\Models\Tag::all()->count() }}</span>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">Tanggal</th> --}}
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Kategori</th>
                                        <th class="text-center">Slug Kategori</th>
                                        <th class="text-center">Keyword Kategori</th>
                                        <th class="text-center">Meta Desc Kategori</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->category_name }}</td>
                                            <td class="text-center">{{ $item->category_slug }}</td>
                                            <td class="text-center">{{ $item->category_keyword }}</td>
                                            <td class="">{{ $item->category_metadesc }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target="#xEditKategori{{ $item->id }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.manage-blog.category-destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('admin.manage-blog.category-destroy', $item->id) }}"
                                                        data-name="{{ $item->name }}"
                                                        onclick="deleteData('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="me-1 mb-1 d-inline-block">
        @foreach ($category as $item)
        <form action="{{ route('admin.manage-blog.category-update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="modal fade text-left" id="xEditKategori{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel17" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">Data Informasi Kategori - <span style="text-transform: uppercase">#{{ $item->category_name }}</span></h4>
                            <div class="">

                                <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="category_name">Nama Kategori</label>
                                <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $item->category_name }}" placeholder="Inputkan nama Kategori...">
                                @error('category_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="category_slug">Slug Kategori</label>
                                <input type="text" name="category_slug" id="category_slug" class="form-control" disabled value="{{ $item->category_slug }}" placeholder="Inputkan slug Kategori...">
                                @error('category_slug')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="category_keyword">Keyword Kategori</label>
                                <input type="text" name="category_keyword" id="category_keyword" class="form-control" value="{{ $item->category_keyword }}" placeholder="Inputkan keyword Kategori...">
                                @error('category_keyword')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="category_metadesc">Meta Description Kategori</label>
                                <input type="text" name="category_metadesc" id="category_metadesc" class="form-control" value="{{ $item->category_metadesc }}" placeholder="Inputkan meta desc Kategori...">
                                @error('category_metadesc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>


@endsection
