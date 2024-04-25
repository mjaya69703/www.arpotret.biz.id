
<div class="modal fade" id="loginMember" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('auth-member.auth-signin-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="font-size: 20px">
                    <h5 class="modal-title" id="tabsModalLabel">Login Member</h5>
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
                    <div class="form-group col-12 mb-3">
                        <label for="email">Username atau Email Address</label>
                        <input autocomplete="off" type="text" name="login" id="login" class="form-control"
                            placeholder="Input your username atau email...">
                        @error('login')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-12 mb-3">
                        <label for="password">Password</label>
                        <input autocomplete="off" type="password" name="password" id="password" class="form-control"
                            placeholder="Input your password...">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="" class="btn btn-outline-danger" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#forgotMember">Lupa Password</a>
                    <a href="" class="btn btn-outline-success" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#registMember">Register Member</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="registMember" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('auth-member.auth-signup-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="font-size: 20px">
                    <h5 class="modal-title" id="tabsModalLabel">Daftar Member</h5>
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
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" placeholder="inputkan nama lengkap kamu...">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="inputkan nama pengguna / username kamu...">
                        @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" name="email" placeholder="inputkan email kamu...">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="phone">Nomor HandPhone ( Whatsapp )</label>
                        <input type="text" class="form-control" name="phone" placeholder="inputkan nomor handphone kamu...">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Kata Sandi</label>
                        <input type="password" class="form-control" name="password" placeholder="inputkan nomor password kamu...">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="konfirmasi password kamu...">
                        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="" class="btn btn-outline-danger" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#forgotMember">Lupa Password</a>
                    <a href="" class="btn btn-outline-success" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#loginMember">Login Member</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="forgotMember" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('auth-member.auth-forgot-request') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header" style="font-size: 20px">
                    <h5 class="modal-title" id="tabsModalLabel">Lupa Password Member</h5>
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
                        <label for="email">Email Address</label>
                        <input type="text" class="form-control" name="email" placeholder="inputkan email kamu...">
                        <small> Masukan email yang terdaftar </small>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <a href="" class="btn btn-outline-danger" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#forgotMember">Lupa Password</a>
                    <a href="" class="btn btn-outline-success" style="border-radius: 25px" data-bs-toggle="modal" data-bs-target="#loginMember">Login Member</a>
                </div>
            </div>
        </form>
    </div>
</div>
@if(Route::is('root.root-main-product-checkout', request()->path()))
<div class="modal fade" id="scanQRIS" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="font-size: 20px">
                <h5 class="modal-title" id="tabsModalLabel">Scan QRIS Disini</h5>
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
                <div class="form-group text-center mb-2">
                    <img src="{{ asset('storage/images/default/'. $web->site_qris) }}" alt="">
                </div>
                <div class="form-group">
                    <label for="product_price">Nominal Transfer + PPN 11 %</label>
                    <input type="text" name="product_price" id="product_price" class="form-control" value="{{ $product->raw_product_price + ($product->raw_product_price * 0.11) }}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="transferBank" tabindex="-1" role="dialog" aria-labelledby="tabsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="font-size: 20px">
                <h5 class="modal-title" id="tabsModalLabel">Transfer Bank</h5>
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
                    <label for="product_price">Nomor Rekening Atas Nama <b>Aria Pratama</b></label>
                    <input type="text" name="product_price" id="product_price" class="form-control" value="321214213232323" disabled>
                </div>
                <div class="form-group mb-2">
                    <label for="product_price">Nominal Transfer + PPN 11 %</label>
                    <input type="text" name="product_price" id="product_price" class="form-control" value="{{ $product->raw_product_price + ($product->raw_product_price * 0.11) }}" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
