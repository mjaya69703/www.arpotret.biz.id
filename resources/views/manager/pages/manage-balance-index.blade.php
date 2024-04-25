@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-12 mb-3">
                <form action="{{ route('manager.manage-balance.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Tambah Data Balance</h4>
                            <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bal_type">Tipe Balance</label>
                                <select name="bal_type" id="bal_type" class="form-select">
                                    <option selected disabled>Pilih Tipe Balance</option>
                                    <option value="0">Balance Pending</option>
                                    <option value="1">Balance Income</option>
                                    <option value="2">Balance Expense</option>
                                </select>
                                @error('bal_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bal_value">Balance Value</label>
                                <input type="text" name="bal_value" id="bal_value" class="form-control" placeholder="Inputkan Balance Value...">
                                @error('bal_value')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="bal_desc">Balance Description</label>
                                <textarea name="bal_desc" id="bal_desc" class="form-control" cols="30" rows="10" placeholder="Inputkan deskripsi sumber dana..."></textarea>
                                @error('bal_desc')
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
                        <h4 class="card-title">Daftar Income / Expense Balance</h4>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Balance Sekarang: Rp. {{ number_format($balSekarang, 0, ',', '.') }}</span>
                            <span>Balance Pending: Rp. {{ number_format($balPending, 0, ',', '.') }}</span>
                            <span>Balance Income: Rp. {{ number_format($balIncome, 0, ',', '.') }}</span>
                            <span>Balance Expense: Rp. {{ number_format($balOutcome, 0, ',', '.') }}</span>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">Tanggal</th> --}}
                                        <th class="text-center">#</th>
                                        <th class="text-center">Balance Value</th>
                                        <th class="text-center">Balance Status</th>
                                        <th class="text-center">Balance Description</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($balance as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            {{-- <td class="text-center">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td> --}}
                                            <td class="">{{ $item->bal_value }}</td>
                                            @if($item->raw_bal_type == 0)
                                            <td class="text-center"><span class="btn btn-warning">{{ $item->bal_type }}</span></td>
                                            @elseif($item->raw_bal_type == 1)
                                            <td class="text-center"><span class="btn btn-success">{{ $item->bal_type }}</span></td>
                                            @elseif($item->raw_bal_type == 2)
                                            <td class="text-center"><span class="btn btn-danger">{{ $item->bal_type }}</span></td>
                                            @endif
                                            <td class="">{{ $item->bal_desc }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                                    data-bs-target="#updateMember{{ $item->id }}" class="btn btn-outline-primary"><i
                                                        class="fas fa-edit"></i></a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('manager.manage-balance.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('manager.manage-balance.destroy', $item->id) }}"
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
        @foreach ($balance as $item)
        <form action="{{ route('manager.manage-balance.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="modal fade text-left w-100" id="updateMember{{$item->id}}" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">Edit Balance - <span style="text-transform: uppercase">#{{ $item->bal_ucode }}</span></h4>
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
                                <label for="bal_type">Tipe Balance</label>
                                <select name="bal_type" id="bal_type" class="form-select">
                                    <option selected disabled>Pilih Tipe Balance</option>
                                    <option value="0" {{ $item->raw_bal_type == 0 ? 'selected' : '' }} >Balance Pending</option>
                                    <option value="1" {{ $item->raw_bal_type == 1 ? 'selected' : '' }} >Balance Income</option>
                                    <option value="2" {{ $item->raw_bal_type == 2 ? 'selected' : '' }} >Balance Expense</option>
                                </select>
                                @error('bal_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="bal_value">Balance Value</label>
                                <input type="text" name="bal_value" id="bal_value" class="form-control" placeholder="Inputkan Balance Value..." value="{{ $item->bal_value }}">
                                @error('bal_value')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="bal_desc">Balance Description</label>
                                <textarea name="bal_desc" id="bal_desc" class="form-control" cols="30" rows="10" placeholder="Inputkan deskripsi sumber dana..." value="{{ $item->bal_desc }}">{{ $item->bal_desc }}</textarea>
                                @error('bal_desc')
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
