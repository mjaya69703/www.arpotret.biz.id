@extends('base.base-admin-index')
@section('content')
<div class="row">
    {{-- JUMLAH INDIKATOR --}}
    <div class="col-lg-4">
        <div class="row">
            <div class="col-lg-6 col-12 mb-2">
                <a href="{{ route('fotografer.jobs.onprocess') }}">
                    <div class="card btn btn-outline-primary">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-list-ul" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Jobs OnProcess <br>{{ App\Models\Booking::where('book_assign_to', Auth::guard()->user()->id)->whereIn('book_stat', [0, 1, 2, 3, 4])->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-12 mb-2">
                <a href="{{ route('fotografer.jobs.completed') }}">
                    <div class="card btn btn-outline-primary">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-list-check" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Jobs Finished <br>{{ App\Models\Booking::where('book_assign_to', Auth::guard()->user()->id)->where('book_stat', 5)->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-12 mb-2">
                <a href="{{ route('fotografer.manage-product.portofolio-index') }}">
                    <div class="card btn btn-outline-primary">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <span class="icon" style="margin-right: 25px;"><i class="fa-solid fa-image" style="font-size: 42px"></i></span>
                            <span class="text-white" style="margin-left: 25px; font-size: 16px;">Your Gallery <br>{{ App\Models\Gallery::where('author_id', Auth::guard()->user()->id)->count() }}</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Chart Grafik Jobs Kamu</h4>
            </div>
            <div class="card-body">
                <div id="chart"></div>
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
