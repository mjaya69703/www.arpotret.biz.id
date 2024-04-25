@extends('base.base-admin-index')
@section('content')

<section class="section">
    <form action="{{ route('manager.profile.update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="row">

        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Foto Profile</h4>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <img src="{{ asset('storage/images/profile/' . Auth::guard('admin')->user()->photo) }}" class="card-img-top" alt="">
                        <label for="photo">Upload Photo Profile</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        @error('photo') <small class="text-danger">{{ $message }}</small>  @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Edit Identitas Manager</h4>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
                <div class="row card-body">
                    <div class="form-group col-lg-12 col-12">
                        <label for="name">Isi Biografi Kamu</label>
                        <textarea name="biography" id="biography" class="form-control" cols="30" rows="10" placeholder="Jelasin tentang dirimu..." value="{{ Auth::guard('admin')->user()->biography }}">{{ Auth::guard('admin')->user()->biography }}</textarea>
                        @error('biography') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="name">Nama Lengkap Kamu</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Inputkan nama kamu..." value="{{ Auth::guard('admin')->user()->name }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="username">Nama Pengguna ( Username )</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Inputkan username kamu..." value="{{ Auth::guard('admin')->user()->username }}">
                        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="phone">Nomor HandPhone ( Whatsapp )</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Inputkan nomor handphone kamu..." value="{{ Auth::guard('admin')->user()->phone }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="email">Alamat Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Inputkan nama email kamu..." value="{{ Auth::guard('admin')->user()->email }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="birthday_city">Tempat Lahir</label>
                        <input type="text" class="form-control" name="birthday_city" id="birthday_city" placeholder="Inputkan kota kelahiran kamu..." value="{{ Auth::guard('admin')->user()->birthday_city }}">
                        @error('birthday_city') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="birthday_date">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="birthday_date" id="birthday_date" placeholder="Inputkan kota kelahiran kamu..." value="{{ Auth::guard('admin')->user()->birthday_date }}">
                        @error('birthday_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="social_fb">Facebook</label>
                        <input type="url" class="form-control" name="social_fb" id="social_fb" placeholder="Inputkan link facebook kamu..." value="{{ Auth::guard('admin')->user()->social_fb }}">
                        @error('social_fb') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="social_ig">Instagram</label>
                        <input type="url" class="form-control" name="social_ig" id="social_ig" placeholder="Inputkan link instagram kamu..." value="{{ Auth::guard('admin')->user()->social_ig }}">
                        @error('social_ig') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="social_tw">Instagram</label>
                        <input type="url" class="form-control" name="social_tw" id="social_tw" placeholder="Inputkan link twitter / x kamu..." value="{{ Auth::guard('admin')->user()->social_tw }}">
                        @error('social_tw') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="social_in">Linked In</label>
                        <input type="url" class="form-control" name="social_in" id="social_in" placeholder="Inputkan link linked in kamu..." value="{{ Auth::guard('admin')->user()->social_in }}">
                        @error('social_in') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>
        </div>

    </div>

    </form>
</section>
@endsection
@section('custom-js')
<script>
    document.getElementById("photo").onchange = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.card-img-top');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };
</script>
@endsection
