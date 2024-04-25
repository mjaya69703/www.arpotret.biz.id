@extends('base.base-admin-index')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Daftar Sesi Connect</h4>
                    <div class="">

                        {{-- <a href="{{ route('manager.manage-booking.create') }}" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></a> --}}
                        <a href="#" data-bs-toggle="modal" data-bs-target="#xPrintButton" class="btn btn-outline-primary"><i class="fa-solid fa-plus"></i></a>
                        <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center">Tanggal</th> --}}
                                    <th class="text-center">#</th>
                                    <th class="text-center">Package</th>
                                    <th class="text-center">Subject Pesan</th>
                                    <th class="text-center">Sender By</th>
                                    <th class="text-center">Sender To</th>
                                    <th class="text-center">Status Connect</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($connect as $key => $item)
                                <tr>
                                    <td class="text-center">{{ ++$key }}</td>
                                    <td class="text-center">Package {{ $item->book->book_product->product_name }}</td>
                                    <td><span style="text-transform: uppercase;">#{{ $item->connect_code }}</span> - {{ Illuminate\Support\Facades\Crypt::decryptString($item->connect_subject) }}</td>
                                    {{-- <td><span style="text-transform: uppercase">#{{ $item->connect_code }}</span> - {{ $item->connect_subject }}</td> --}}
                                    @if($item->admin_id == null)

                                    <td class="text-center">{{ $item->users->name }}</td>
                                    @elseif($item->users_id == null)

                                    <td class="text-center">{{ $item->admin->name }}</td>
                                    @endif
                                    <td class="text-center">{{ $item->send->name }}</td>
                                    @if($item->raw_connect_stat == 0)
                                    <td class="text-center"><span class="btn btn-primary">{{ $item->connect_stat }}</span></td>
                                    @elseif($item->raw_connect_stat == 1)
                                    <td class="text-center"><span class="btn btn-success">{{ $item->connect_stat }}</span></td>
                                    @elseif($item->raw_connect_stat == 2)
                                    <td class="text-center"><span class="btn btn-danger">{{ $item->connect_stat }}</span></td>
                                    @endif
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ route('manager.manage-connect.view', $item->connect_code) }}" style="margin-right: 10px" class="btn btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        {{-- <a href="#" style="margin-right: 10px" data-bs-toggle="modal"
                                            data-bs-target="#xUpdateStatus{{ $item->id }}" class="btn btn-outline-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('manager.manage-booking.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a type="button" class="bs-tooltip btn btn-rounded btn-outline-danger"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                data-original-title="Delete"
                                                data-url="{{ route('manager.manage-booking.destroy', $item->id) }}"
                                                data-name="{{ $item->name }}"
                                                onclick="deleteData('{{ $item->id }}')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form> --}}
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada sesi diskusi </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="me-1 mb-1 d-inline-block">
        <!--large size Modal -->
        <form action="{{ route('manager.manage-connect.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left" id="xPrintButton" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel17" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel16">New Connect</h4>
                        <div class="">

                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-body row">

                        <div class="form-group col-6">
                            <label for="book_id">Pilih Kode Transaksi</label>
                            <select name="book_id" id="book_id" class="form-select">
                                <option value="" selected>Pilih Kode Transaksi</option>
                                @foreach ($booking as $item)
                                    <option value="{{ $item->id}}" data-client="{{ $item->book_author->name }}" data-code="{{ $item->book_code }}" data-user="{{ $item->book_author_id }}"><span style="text-transform: uppercase;">#{{ strtoupper($item->book_code) }}</span> - Package {{ $item->book_product->product_name }}</option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="client_name">Nama Client</label>
                            <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Inputkan nama client...">
                            @error('client_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6" style="display: none">
                            <label for="connect_code">Kode Connect</label>
                            <input type="text" name="connect_code" id="connect_code" class="form-control" placeholder="Inputkan kode connect...">
                            @error('connect_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6" style="display: none">
                            <label for="send_to">Send to</label>
                            <input type="text" name="send_to" id="send_to" class="form-control" placeholder="Inputkan ID Client...">
                            @error('send_to')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="connect_subject">Subject Connect</label>
                            <input type="text" name="connect_subject" id="connect_subject" class="form-control" placeholder="Inputkan subject pesan...">
                            @error('connect_subject')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <label for="connect_message">Isi Pesan</label>
                            <textarea name="connect_message" id="dark" class="form-control" cols="30" rows="10" placeholder="Isi pesan anda?"></textarea>

                            @error('connect_message')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="connect_attach_1">Tambahkan Attachment</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <input type="file" name="connect_attach_1" id="connect_attach_1" class="form-control">
                                <button type="button" style="margin-left: 5px" id="add_more" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></button>
                                <button type="button" style="margin-left: 5px" id="remove" class="btn btn-outline-danger"><i class="fa-solid fa-minus"></i></button>
                                <div class="">

                                </div>
                            </div>
                            @error('connect_attach_1')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Attachments 2-5 -->
                        @for ($i = 2; $i <= 5; $i++)
                            <div class="form-group col-12" id="connect_attach_{{ $i }}_div" style="display: none;">
                                <label for="connect_attach_{{ $i }}">Tambahkan Attachment</label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="file" name="connect_attach_{{ $i }}" id="connect_attach_{{ $i }}" class="form-control">

                                </div>
                                @error('connect_attach_{{ $i }}')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        @endfor
                        <div id="warning" class="text-danger" style="display: none;">Maksimal 5 lampiran.</div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
@endsection
@section('custom-js')
<script src="{{ asset('dist') }}/assets/extensions/tinymce/tinymce.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/tinymce.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#book_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var bookCode = selectedOption.data('code');
        $('#connect_code').val(bookCode);
    });
});
$(document).ready(function() {
    $('#book_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var bookUser = selectedOption.data('user');
        $('#send_to').val(bookUser);
    });
});
$(document).ready(function() {
    $('#book_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var bookClient = selectedOption.data('client');
        $('#client_name').val(bookClient);
    });
});

$(document).ready(function() {
    var currentAttachment = 2;
    $('#add_more').click(function() {
        if (currentAttachment <= 5) {
            $('#connect_attach_' + currentAttachment + '_div').show();
            currentAttachment++;
        }
        if (currentAttachment > 5) {
            $('#warning').show();
        }
    });
    $('#remove').click(function() {
        if (currentAttachment > 2) {
            currentAttachment--;
            $('#connect_attach_' + currentAttachment + '_div').hide();
            if (currentAttachment <= 5) {
                $('#warning').hide();
            }
        }
    });
});




</script>
@endsection
