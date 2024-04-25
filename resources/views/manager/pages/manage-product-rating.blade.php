@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Rating</h4>
                        <div class="">

                            {{-- <a href="{{ route('manager.manage-product.rating-create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></a> --}}
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
                                        <th class="text-center">#</th>
                                        <th class="text-center">Kode Booking</th>
                                        <th class="text-center">Nama Product</th>
                                        <th class="text-center">Nama Pengguna</th>
                                        <th class="text-center">Rate Skor Max ( 5 )</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">CreatedAt</th>
                                        <th class="text-center">Tombol Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rating as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td class="text-center">#<span style="text-transform: uppercase">{{ $item->book->book_code }}</span></td>
                                            <td class="text-center">{{ $item->book->book_product->product_name }}</td>
                                            <td class="text-center">{{ $item->user->name }}</td>
                                            <td class="text-center">{{ $item->rate_score }}</td>
                                            @if($item->is_hide == 0)
                                            <td class="text-center"><span class="btn btn-outline-danger">Tidak Terlihat</span></td>
                                            @elseif($item->is_hide == 1)
                                            <td class="text-center"><span class="btn btn-outline-success">Terlihat</span></td>
                                            @endif
                                            <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM YYYY ( HH:mm )') }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewRate{{ $item->id }}" style="margin-right: 10px" class="btn btn-outline-info"><i class="fas fa-eye"></i></a>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editRate{{ $item->id }}" style="margin-right: 10px" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('manager.manage-product.rating-destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('manager.manage-product.rating-destroy', $item->id) }}"
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
        @foreach ($rating as $item)
        <div class="modal fade" id="viewRate{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('auth-member.give-rate-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header" style="font-size: 20px">
                            <h5 class="modal-title" id="tabsModalLabel">Lihat Rating - <span style="text-transform: uppercase">#{{ $item->book->book_code }}</span></h5>
                            <div class="d-flex justify-content-between align-items-center">

                                {{-- <button style="margin-right: 10px; border-radius: 20px;" type="submit"
                                    class="btn btn-rounded btn-outline-primary" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button> --}}
                                <button style="border-radius: 20px;" type="button" class="btn btn-rounded btn-outline-warning"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="rate_score">Rate Score</label>
                                <select name="rate_score" id="rate_score" class="form-control">
                                    <option value="" class="text-center" selected>================ Pilih Rate Score ================</option>
                                    <option value="1" {{ $item->rate_score == 1 ? 'selected' : '' }} class="text-center">================ 1 ================</option>
                                    <option value="2" {{ $item->rate_score == 2 ? 'selected' : '' }} class="text-center">================ 2 ================</option>
                                    <option value="3" {{ $item->rate_score == 3 ? 'selected' : '' }} class="text-center">================ 3 ================</option>
                                    <option value="4" {{ $item->rate_score == 4 ? 'selected' : '' }} class="text-center">================ 4 ================</option>
                                    <option value="5" {{ $item->rate_score == 5 ? 'selected' : '' }} class="text-center">================ 5 ================</option>
                                </select>
                                @error('rate_score') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="rate_desc">Berikan Ulasan Kamu</label>
                                <textarea name="rate_desc" id="rate_desc" placeholder="Berikan ulasan terbaikmu..." class="form-control" cols="30" rows="10">{{ $item->rate_desc }}</textarea>
                                @error('rate_desc') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
        @foreach ($rating as $item)
        <div class="modal fade" id="editRate{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('manager.manage-product.rating-update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header" style="font-size: 20px">
                            <h5 class="modal-title" id="tabsModalLabel">Edit Rating - <span style="text-transform: uppercase">#{{ $item->book->book_code }}</span></h5>
                            <div class="d-flex justify-content-between align-items-center">

                                <button style="margin-right: 10px; border-radius: 20px;" type="submit"
                                    class="btn btn-rounded btn-outline-primary" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                                <button style="border-radius: 20px;" type="button" class="btn btn-rounded btn-outline-warning"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa-solid fa-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="is_hide">Rate Score</label>
                                <select name="is_hide" id="is_hide" class="form-control">
                                    <option value="" class="text-center" selected>================ Pilih Status Hide ================</option>
                                    <option value="0" {{ $item->is_hide == 0 ? 'selected' : '' }} class="text-center">================ False ================</option>
                                    <option value="1" {{ $item->is_hide == 1 ? 'selected' : '' }} class="text-center">================ Truth ================</option>
                                </select>
                                @error('is_hide') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>

@endsection
