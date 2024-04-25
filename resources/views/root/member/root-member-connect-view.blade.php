
@extends('base.base-root-index')
@section('content')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center"
        style="background-image: url('{{ asset('root') }}/assets/img/breadcrumbs-bg.jpg');">
        <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">
            <h2>{{ $submenu }}</h2>
            <ol>
                <li><a href="/">{{ $menu }}</a></li>
                <li>{{ $submenu }}</li>
            </ol>
        </div>
    </div><!-- End Breadcrumbs -->

    <section id="testimonials" class="testimonials section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>{{ $submenu }}</h2>
                <p>{{ $subdesc }}</p>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h4 style="font-size: 20px">Sesi Konsultasi #{{ strtoupper($connect->connect_code) }} - {{ Illuminate\Support\Facades\Crypt::decryptString($connect->connect_subject) }}</h4>
                            <div class="">
                                <a href="{{ route('auth-member.history-checkout') }}" class="btn btn-outline-warning"><i class="fa-solid fa-backward"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">

                                @foreach ($connectr as $item )
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $item->connect_core }}" aria-expanded="false" aria-controls="flush-collapseOne{{ $item->connect_core }}">
                                            @if($item->admin_id == null)
                                            <img src="{{ asset('storage/images/profile/'. $item->users->photo ) }}" alt="Logo" class="avatar avatar-md" style="width: 50px; max-width: 100%; height: 50px;">
                                            <span style="margin-left: 10px">{{ $item->users->name }} - {{ $item->created_at->diffForHumans() }} <br><b>{{ $item->users->type }}</b></span>
                                            @elseif($item->users_id == null)
                                            <img src="{{ asset('storage/images/profile/'. $item->admin->photo ) }}" alt="Logo" class="avatar avatar-md" style="width: 50px; max-width: 100%; height: 50px;">
                                            <span style="margin-left: 10px">{{ $item->admin->name }} - {{ $item->created_at->diffForHumans() }} <br><b>{{ $item->admin->type }}</b></span>
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne{{ $item->connect_core }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {!! Illuminate\Support\Facades\Crypt::decryptString($item->connect_message) !!}
                                            {{-- {!! $item->connect_message !!} --}}
                                        </div>
                                        <div class="accordion-footer d-flex justify-content-between align-items-center">
                                            <div>
                                                @if(!empty($item->connect_attach_1) || !empty($item->connect_attach_2) || !empty($item->connect_attach_3) || !empty($item->connect_attach_4) || !empty($item->connect_attach_5))
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if(!empty($item->{'connect_attach_'.$i}))
                                                            <a href="{{ asset('storage/attach/connect/'. $item->{'connect_attach_'.$i})  }}">Lampiran {{ $i }}</a><br>
                                                        @endif
                                                    @endfor
                                                @else
                                                    <p>Tidak ada lampiran</p>
                                                @endif
                                            </div>
                                            <div class="">
                                                <p>{{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM YYYY ( HH:mm )') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $connect->connect_core }}" aria-expanded="false" aria-controls="flush-collapseOne{{ $connect->connect_core }}">
                                            @if($connect->admin_id == null)
                                            <img src="{{ asset('storage/images/profile/'. $connect->users->photo ) }}" alt="Logo" class="avatar avatar-md" style="width: 50px; max-width: 100%; height: 50px;">
                                            <span style="margin-left: 10px">{{ $connect->users->name }} - {{ $connect->created_at->diffForHumans() }} <br><b>{{ $connect->users->type }}</b></span>
                                            @elseif($connect->users_id == null)
                                            <img src="{{ asset('storage/images/profile/'. $connect->admin->photo ) }}" alt="Logo" class="avatar avatar-md" style="width: 50px; max-width: 100%; height: 50px;">
                                            <span style="margin-left: 10px">{{ $connect->admin->name }} - {{ $connect->created_at->diffForHumans() }} <br><b>{{ $connect->admin->type }}</b></span>
                                            @endif
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne{{ $connect->connect_core }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            {!! Illuminate\Support\Facades\Crypt::decryptString($connect->connect_message) !!}
                                        </div>
                                        <div class="accordion-footer d-flex justify-content-between align-items-center">
                                            <p>Tidak ada lampiran</p>
                                            <div class="">

                                                <p>{{ Carbon\Carbon::parse($connect->created_at)->isoFormat('dddd, D MMMM YYYY ( HH:mm )') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="{{ route('auth-member.connect-replyMember') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 style="font-size: 20px">Balas Pesan #{{ strtoupper($connect->connect_code) }} - {{ Illuminate\Support\Facades\Crypt::decryptString($connect->connect_subject) }}</h4>
                            <div class="">
                                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                                <a href="" class="btn btn-outline-warning"><i class="fa-solid fa-sync"></i></a>
                            </div>
                        </div>
                        <div class="row card-body">
                            <div class="form-group col-lg-6 col-12">
                                <label for="book_id">Pilih Kode Transaksi</label>
                                <select name="book_id" id="book_id" class="form-select">
                                    <option value="" selected>Pilih Kode Transaksi</option>
                                    @foreach ($booking as $item)
                                        <option value="{{ $item->id}}" {{ $connect->book_id == $item->id ? 'selected' : ''  }} data-client="{{ $item->book_author->name }}" data-code="{{ $item->book_code }}" data-user="{{ $item->book_author_id }}"><span style="text-transform: uppercase;">#{{ strtoupper($item->book_code) }}</span> - Package {{ $item->book_product->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12" style="display: none">
                                <label for="connect_codr">Kode Pesan</label>
                                <input type="text" name="connect_codr" id="connect_codr" class="form-control" value="{{ $connect->connect_code }}" placeholder="Inputkan kode koneksi...">
                                @error('connect_codr')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="send">Send to</label>
                                @if($connect->admin_id == null)
                                <input type="text" name="send" id="send" class="form-control" value="{{ $connect->users->name }}" placeholder="">
                                @elseif($connect->users_id == null)
                                <input type="text" name="send" id="send" class="form-control" value="{{ $connect->admin->name }}" placeholder="">
                                @endif
                                @error('send')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 col-12" style="display: none">
                                <label for="send_to">Kode Send to</label>
                                <input type="text" name="send_to" id="send_to" class="form-control" value="{{ $connect->send_to }}" placeholder="">
                                @error('send_to')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="connect_subject">Subject Pesan</label>
                                <input type="text" name="connect_subject" id="connect_subject" class="form-control" value="{{ Illuminate\Support\Facades\Crypt::decryptString($connect->connect_subject) }}" placeholder="Inputkan Subject Pesan...">
                                @error('connect_subject')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 col-12">
                                <label for="connect_message">Isi Pesan</label>
                                <textarea name="connect_message" id="dark" class="form-control" cols="30" rows="10" placeholder="Isi pesan anda?"></textarea>

                                @error('connect_message')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group col-lg-12 col-12">
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
                                <div class="form-group col-lg-12 col-12" id="connect_attach_{{ $i }}_div" style="display: none;">
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
                    </form>
                </div>
            </div>


        </div>
    </section><!-- End Testimonials Section -->

</main><!-- End #main -->
@endsection
@section('custom-css')

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
<script>
    setTimeout(function(){
        location.reload();
    }, 60000);
</script>
@endsection
