@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Gallery</h4>
                        <div class="">

                            <a href="{{ route('manager.manage-product.portofolio-create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></a>
                            <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                        </div>
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
                                        <th class="text-center">Nama Gallery</th>
                                        <th class="text-center">Cover Image</th>
                                        <th class="text-center">Kategori Gallery</th>
                                        <th class="text-center">Author Gallery</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gallery as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->gallery_name }}</td>
                                            <td class="text-center"><img
                                                    src="{{ asset('storage/images/gallery/cover/' . $item->gallery_cover) }}"
                                                    alt="Paket-Picture" width="48px" class="rounded"></td>
                                            <td class="">{{ $item->cproduct->name }}</td>
                                            @if($item->author_id == '0')
                                                <td class="text-center"><span class="btn btn-sm btn-danger">System</span></td>
                                            @elseif($item->author_id > 0)
                                                <td class="text-center"><span
                                                        class="btn btn-sm btn-primary">{{ $item->author->name }}</span></td>
                                            @endif
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('manager.manage-product.portofolio-edit', $item->id) }}" style="margin-right: 10px"
                                                    class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('manager.manage-product.portofolio-destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('manager.manage-product.portofolio-destroy', $item->id) }}"
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

    </div>

@endsection
