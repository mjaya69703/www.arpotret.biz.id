@extends('base.base-admin-index')
@section('content')
<div class="row">
    {{-- JUMLAH INDIKATOR --}}
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-balance.bal-pending') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-clock" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Balance Pending <br>{{ number_format($balPending, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-balance.bal-sekarang') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-money-bill-trend-up" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Balance Sekarang <br>{{ number_format($balSekarang, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-booking.book-onprocess') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-spinner" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Book OnProcess <br>{{ App\Models\Booking::whereIn('book_stat', [0, 1, 2, 3, 4])->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-booking.book-finished') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-cart-shopping" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Book Finished <br>{{ App\Models\Booking::where('book_stat', 5)->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-member.index') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-user-group" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Members <br>{{ App\Models\User::all()->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-admin.index') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-user-tie" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Staff Members <br>{{ App\Models\Admin::all()->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-product.rating-index') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-star" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Member Ratings <br>{{ App\Models\Rating::all()->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12 mb-2">
                <a href="{{ route('manager.manage-product.index') }}">
                    <div class="card btn btn-outline-success">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-box" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Product Publish <br>{{ App\Models\Product::all()->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-header">
                <h4>News Release</h4>
            </div>
            <div class="card-body row">
                @if($news)
                <div class="col-lg-12 col-12 mb-3">
                    <div class="d-flex justify-content-start">
                        <img src="{{ asset('storage/images/posts/cover/'.$news->post_cover) }}" width="64" height="64" style="object-fit: cover; border-radius: 20px;" alt="">
                        {{-- <p style="font-size: 20px; margin-left: 20px;">Jaya Kusuma <br> General Admin</p> --}}
                        <span style="margin-left: 20px; font-size: 20px;">{{ $news->author->name }} <br> <a href="{{ route('root.root-main-blog-details', $news->post_slug) }}">{{ $news->post_title }}</a></span>

                    </div>
                    <p style="text-align: right">{{ $news->created_at->diffForHumans() }}</p>
                </div>
                @elseif($news == null)
                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <p>Belum ada berita...</p>
                </div>
                @endif
                <div class="col-lg-12 col-12 d-flex justify-content-center">
                    <a href="{{ route('manager.manage-blog.posts-index') }}" class="btn btn-primary">Check more for news...</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chart Penjualan</h4>
            </div>
            <div class="card-body">
                <div id="chart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Recent Connect</h4>
                    </div>
                    <div class="card-body row">
                        @forelse ($rconnect as $key => $item)
                        @if($item->users_id == null)
                        @elseif($item->admin_id == null)
                        <div class="col-lg-12 col-12 mb-3">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('storage/images/profile/'.$item->users->photo ) }}" width="64" height="64" style="border-radius: 20px;" alt="">
                                {{-- <p style="font-size: 20px; margin-left: 20px;">Jaya Kusuma <br> General Admin</p> --}}
                                <span style="margin-left: 20px; font-size: 20px;">{{ $item->users->name }} <br> <a href="{{ route('manager.manage-connect.view', $item->connect_codr) }}">Reply #<span style="text-transform: uppercase">{{ $item->connect_codr }}</span></a></span>

                            </div>
                            <p style="text-align: right">{{ $item->created_at->diffForHumans() }}</p>
                        </div>
                        @endif
                        @empty

                        <div class="col-lg-12 col-12 d-flex justify-content-center">
                            <p>Data belum tersedia...</p>
                        </div>
                        @endforelse
                        <div class="col-lg-12 col-12 d-flex justify-content-center">
                            <a href="{{ route('manager.manage-connect.index') }}" class="btn btn-primary">Check more connect...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
    <!-- Need: Apexcharts -->
<script src="{{ asset('dist') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="{{ asset('dist') }}/assets/static/js/pages/dashboard.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> <!-- Jangan lupa untuk memasukkan library ApexCharts --> --}}

<script>
// Nama bulan dalam Bahasa Inggris
var MONTH_NAMES = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

// Fungsi untuk menghasilkan warna acak
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Data penjualan dari controller
var salesData = @json($salesData);

// Ubah data penjualan menjadi format yang dibutuhkan oleh ApexCharts
var seriesData = [];
var colors = [];
var productNames = [...new Set(salesData.map(data => data.product_name))]; // Dapatkan semua nama produk

productNames.forEach(productName => {
  var productSalesData = salesData.filter(data => data.product_name === productName)
    .reduce((acc, curr) => {
      acc[curr.month - 1] = curr.sales; // Bulan diindeks mulai dari 0
      return acc;
    }, Array(12).fill(0)); // Buat array dengan 12 elemen, semua diisi dengan 0

  seriesData.push({
    name: productName,
    data: productSalesData
  });

  colors.push(getRandomColor()); // Tambahkan warna acak untuk setiap produk
});

// Opsi untuk grafik
var optionsProfileVisit = {
  annotations: {
    position: "back",
  },
  dataLabels: {
    enabled: false,
  },
  chart: {
    type: "bar",
    height: 300,
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {},
  series: seriesData,
  colors: colors, // Gunakan array warna yang telah dibuat
  xaxis: {
    categories: MONTH_NAMES,
  },
}

// Buat grafik
var chart = new ApexCharts(document.querySelector("#chart"), optionsProfileVisit);
chart.render();
</script>

@endsection
