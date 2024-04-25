@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-12 mb-3">
                <form action="{{ route('manager.manage-page.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Halaman</h4>
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="page_type">Tipe Halaman</label>
                                <select name="page_type" id="page_type" class="form-select">
                                    <option selected disabled>Pilih Tipe Halaman</option>
                                    <option value="0">Halaman Header</option>
                                    <option value="1">Halaman Menu</option>
                                    <option value="2">Halaman Submenu</option>
                                </select>
                                @error('page_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_role">Role Halaman</label>
                                <select name="page_role" id="page_role" class="form-select">
                                    <option selected disabled>Pilih Role Halaman</option>
                                    <option value="0">Super Admin</option>
                                    <option value="1">General Admin</option>
                                    <option value="2">General Author</option>
                                </select>
                                @error('page_role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_id">Pilih Header Halaman</label>
                                <select name="page_id" id="page_id" class="form-select">
                                    <option selected disabled>Pilih Header Halaman</option>
                                    @foreach ($mpage as $item)
                                        <option value="{{ $item->id }}">{{ $item->page_name }}</option>
                                    @endforeach
                                </select>
                                @error('page_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_menu">Pilih Menu Halaman</label>
                                <select name="page_menu" id="page_menu" class="form-select">
                                    <option selected disabled>Pilih Menu Halaman</option>
                                    @foreach ($spage as $item)
                                        <option value="{{ $item->id }}">{{ $item->page_name }}</option>
                                    @endforeach
                                </select>
                                @error('page_menu')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_name">Nama Halaman</label>
                                <input type="text" name="page_name" id="page_name" class="form-control"
                                    placeholder="Inputkan nama halaman...">
                                @error('page_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_font">Font Halaman</label>
                                <input type="text" name="page_font" id="page_font" class="form-control"
                                    placeholder="Inputkan font halaman...">
                                @error('page_font')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_desc">Deskripsi Halaman</label>
                                <input type="text" name="page_desc" id="page_desc" class="form-control"
                                    placeholder="Inputkan deskripsi halaman...">
                                @error('page_desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="page_link">Link Halaman</label>
                                <input type="text" name="page_link" id="page_link" class="form-control"
                                    placeholder="Inputkan link halaman...">
                                @error('page_link')
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
                        <h4 class="card-title">Daftar Halaman</h4>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Jumlah Semua Halaman: {{ \App\Models\PageManager::all()->count() }}</span>
                            <span>Jumlah Halaman Header: {{ \App\Models\PageManager::where('page_type', 0)->count() }}</span>
                            <span>Jumlah Halaman Menu: {{ \App\Models\PageManager::where('page_type', 1)->count() }}</span>
                            <span>Jumlah Halaman Submenu: {{ \App\Models\PageManager::where('page_type', 2)->count() }}</span>
                        </div>
                        <hr>
                        <div class="table-responsive">

                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">Tanggal</th> --}}
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Halaman</th>
                                        <th class="text-center">Link Halaman</th>
                                        <th class="text-center">Type Halaman</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($page as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->page_name }}</td>
                                            <td class="text-center">{{ $item->page_link }}</td>
                                            @if($item->page_type == 0)
                                            <td class="text-center"><span class="btn btn-sm btn-success">Halaman Header</span></td>
                                            @elseif($item->page_type == 1)
                                            <td class="text-center"><span class="btn btn-sm btn-primary">Halaman Menu</span></td>
                                            @elseif($item->page_type == 2)
                                            <td class="text-center"><span class="btn btn-sm btn-warning">Halaman Submenu</span></td>
                                            @endif
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                    data-bs-target="#xUpdate{{ $item->id }}" class="btn btn-outline-primary"><i
                                                        class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('manager.manage-page.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('manager.manage-page.destroy', $item->id) }}"
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
    @foreach ($page as $item)
        <div class="modal fade text-left w-100" id="xUpdate{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                <form action="{{ route('manager.manage-page.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel16">Edit Halaman - {{ $item->page_name }}</h4>
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
                        <div class="row modal-body">
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_role">Role Halaman</label>
                                <select name="page_role" id="page_role" class="form-select">
                                    <option value="#" {{ $item->page_role == null ? 'selected' : '' }} >Pilih Role Halaman</option>
                                    <option value="0" {{ $item->page_role == 0 ? 'selected' : '' }}>Super Admin</option>
                                    <option value="1" {{ $item->page_role == 1 ? 'selected' : '' }}>General Admin</option>
                                    <option value="2" {{ $item->page_role == 2 ? 'selected' : '' }}>General Author</option>
                                </select>
                                @error('page_role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_type">Tipe Halaman</label>
                                <select name="page_type" id="page_type" class="form-select">
                                    <option selected disabled>Pilih Tipe Halaman</option>
                                    <option value="0" {{ $item->page_type == 0 ? 'selected' : '' }}>Halaman Header</option>
                                    <option value="1" {{ $item->page_type == 1 ? 'selected' : '' }}>Halaman Menu</option>
                                    <option value="2" {{ $item->page_type == 2 ? 'selected' : '' }}>Halaman Submenu</option>
                                </select>
                                @error('page_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_id">Pilih Head Halaman</label>
                                <select name="page_id" id="page_id" class="form-select">
                                    <option selected disabled>Pilih Head Halaman</option>
                                    @foreach ($mpage as $items)
                                        <option value="{{ $items->id }}" {{ $items->id == $item->page_id ? 'selected' : '' }}>{{ $items->page_name }}</option>
                                    @endforeach
                                </select>
                                @error('page_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_menu">Pilih Menu Halaman</label>
                                <select name="page_menu" id="page_menu" class="form-select">
                                    <option selected disabled>Pilih Menu Halaman</option>
                                    @foreach ($spage as $item)
                                        <option value="{{ $item->id }}" {{ $item->page_menu == $item->id ? 'selected' : '' }}>{{ $item->page_name }}</option>
                                    @endforeach
                                </select>
                                @error('page_menu')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_name">Nama Halaman</label>
                                <input type="text" name="page_name" id="page_name" class="form-control"
                                    placeholder="Inputkan nama halaman..." value="{{ $item->page_name }}">
                                @error('page_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_font">Nama Halaman</label>
                                <input type="text" name="page_font" id="page_font" class="form-control"
                                    placeholder="Inputkan font halaman..." value="{{ $item->page_font }}">
                                @error('page_font')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_desc">Deskripsi Halaman</label>
                                <input type="text" name="page_desc" id="page_desc" class="form-control"
                                    placeholder="Inputkan deskripsi halaman..." value="{{ $item->page_desc }}">
                                @error('page_desc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="page_link">Link Halaman</label>
                                <input type="text" name="page_link" id="page_link" class="form-control"
                                    placeholder="Inputkan link halaman..." value="{{ $item->page_link }}">
                                @error('page_link')
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
