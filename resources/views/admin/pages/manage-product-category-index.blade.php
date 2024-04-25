@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-12 mb-3">
                <form action="{{ route('admin.manage-product.category.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Kategori</h4>
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Inputkan nama kategori...">
                                @error('name')
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
                        <h4 class="card-title">Daftar Kategori Produk</h4>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Jumlah Semua Product: {{ \App\Models\Product::all()->count() }}</span>
                            <span>Jumlah Semua Kategori Product: {{ \App\Models\ProductCategory::all()->count() }}</span>
                            <span>Jumlah Semua Rating: {{ \App\Models\Rating::all()->count() }}</span>
                            <span>Jumlah Semua Portofolio: {{ \App\Models\Gallery::all()->count() }}</span>
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
                                        <th class="text-center">Author</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pCategory as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->slug }}</td>
                                            @if($item->author === 'System')
                                            <td class="text-center"><span class="btn btn-sm btn-danger">{{ $item->author }}</span></td>
                                            @else
                                            <td class="text-center"><span class="btn btn-sm btn-primary">{{ $item->author }}</span></td>
                                            @endif
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                    data-bs-target="#xUpdateCategory{{ $item->id }}" class="btn btn-outline-primary"><i
                                                        class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.manage-product.category.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('admin.manage-product.category.destroy', $item->id) }}"
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

    @foreach ($pCategory as $item)
        <div class="modal fade text-left w-100" id="xUpdateCategory{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <form action="{{ route('admin.manage-product.category.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">Edit Kategori - {{ $item->name }}</h4>
                            <div class="">

                                <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal"
                                    aria-label="Submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Inputkan nama kategori..." value="{{ $item->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
