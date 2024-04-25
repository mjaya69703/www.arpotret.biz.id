@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-12 mb-3">
                <form action="{{ route('admin.manage-member.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Member</h4>
                            <button type="submit" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="type">Tipe Member</label>
                                <select name="type" id="type" class="form-select">
                                    <option selected disabled>Pilih Tipe Member</option>
                                    <option value="0">Member</option>
                                    <option value="1">Member Plus</option>
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nama Member</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Inputkan nama member...">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="username">Nama Pengguna Member</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Inputkan username member...">
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor HandPhone ( Whatsapp ) </label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Inputkan nomor handphone...">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Inputkan alamat email...">
                                @error('email')
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
                        <h4 class="card-title">Daftar Member</h4>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Jumlah Semua Member: {{ \App\Models\User::whereIn('type', [0,1])->count() }}</span>
                            <span>Jumlah Member Biasa: {{ \App\Models\User::where('type', 0)->count() }}</span>
                            <span>Jumlah Member Plus: {{ \App\Models\User::where('type', 1)->count() }}</span>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">Tanggal</th> --}}
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nama Member</th>
                                        <th class="text-center">HandPhone Member</th>
                                        <th class="text-center">Email Member</th>
                                        <th class="text-center">Type Member</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($member as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->phone }}</td>
                                            <td class="text-center">{{ $item->email }}</td>
                                            @if($item->type === 'Member Biasa')
                                            <td class="text-center"><span class="btn btn-sm btn-success">Member</span></td>
                                            @elseif($item->type === 'Member Plus')
                                            <td class="text-center"><span class="btn btn-sm btn-primary">Member Plus</span></td>
                                            @endif
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                    data-bs-target="#updateMember{{ $item->id }}" class="btn btn-outline-primary"><i
                                                        class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.manage-member.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('admin.manage-member.destroy', $item->id) }}"
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

        <!--Extra Large Modal --> 
        @foreach ($member as $item)
        <form action="{{ route('admin.manage-member.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="modal fade text-left w-100" id="updateMember{{$item->id}}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Edit Pengguna - {{ $item->name }}</h4>
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
                        <div class="row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="type">Tipe Member</label>
                                <select name="type" id="type" class="form-select">
                                    <option selected disabled>Pilih Tipe Member</option>
                                    <option value="0" {{ $item->type == 'Member Biasa' ? 'selected' : '' }} >Member</option>
                                    <option value="1" {{ $item->type == 'Member Plus' ? 'selected' : '' }} >Member Plus</option>
                                </select>
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="name">Nama Member</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Inputkan nama member..." value="{{ $item->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="username">Nama Pengguna Member</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Inputkan username member..." value="{{ $item->username }}">
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="phone">Nomor HandPhone ( Whatsapp ) </label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    placeholder="Inputkan nomor handphone..." value="{{ $item->phone }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="email">Alamat Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Inputkan alamat email..." value="{{ $item->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="is_verified">Verifikasi Akun</label>
                                <select name="is_verified" id="is_verified" class="form-select">
                                    <option selected disabled>Pilih Verifikasi Akun</option>
                                    <option value="0" {{ $item->is_verified == 0 ? 'selected' : ''}}>Tidak Aktif</option>
                                    <option value="1" {{ $item->is_verified == 1 ? 'selected' : ''}}>Sudah Aktif</option>
                                </select>
                                @error('is_verified')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @endforeach
    </div>
@endsection
