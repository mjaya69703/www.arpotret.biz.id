@extends('base.base-admin-index')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-12 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Daftar Email</h4>
                        <div class="">

                            <a href="{{ route('admin.manage-email.create') }}" class="btn btn-outline-primary"><i
                                    class="fa-solid fa-plus"></i></a>
                            <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Jumlah Semua Pesan: {{ \App\Models\ContactMe::where('contact_type', 0)->count() }}</span>
                                <span>Jumlah Pesan Masuk: {{ \App\Models\ContactMe::where('contact_type', 0)->count() }}</span>
                                <span>Jumlah Pesan Keluar: {{ \App\Models\ContactMe::all()->count() }}</span>
                            </div>
                            <hr>
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-center">Tanggal</th> --}}
                                        <th class="text-center">#</th>
                                        <th class="text-center">Type Pesan</th>
                                        <th class="text-center">Tujuan Pesan</th>
                                        <th class="text-center">Subject Pesan</th>
                                        <th class="text-center">Nama Pengirim</th>
                                        <th class="text-center">Email Pengirim</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($email as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            @if ($item->raw_contact_type == '0')
                                                <td class="text-center"><span class="btn btn-sm btn-danger">{{ $item->contact_type }}</span></td>
                                            @elseif ($item->raw_contact_type == '1')
                                                <td class="text-center"><span class="btn btn-sm btn-primary">{{ $item->contact_type }}</span></td>
                                            @elseif ($item->raw_contact_type == '2')
                                                <td class="text-center"><span class="btn btn-sm btn-info">{{ $item->contact_type }}</span></td>

                                            @endif
                                            @if ($item->contact_sendto == '0')
                                                <td class="text-center"><span class="btn btn-sm btn-danger">System</span></td>
                                            @elseif($item->contact_sendto > 0)
                                                <td class="text-center">
                                                    <span class="btn btn-sm btn-primary">{{ $item->sendto->name }}</span>
                                                </td>
                                            @endif
                                            <td class="">{{ $item->contact_subject }}</td>
                                            <td class="text-center">{{ $item->contact_name }}</td>
                                            <td class="text-center">{{ $item->contact_mail }}</td>
                                            <td class="text-center">{{ $item->created_at->diffForHumans() }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                <a href="{{ route('admin.manage-email.view', $item->contact_code) }}" style="margin-right: 10px" class="btn btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('admin.manage-email.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                        data-original-title="Delete"
                                                        data-url="{{ route('admin.manage-email.destroy', $item->id) }}"
                                                        data-name="{{ $item->name }}"
                                                        onclick="deleteData('{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data.</td>
                                        </tr>
                                    @endforelse
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
