<!DOCTYPE html>
<html>
<head>
    @php
    $monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    $title = 'Laporan Data Booking ';

    if ($month === 'all') {
        $title .= 'Tahun ' . $year;
    } else {
        $title .= 'Bulan ' . $monthNames[$month - 1] . ' Tahun ' . $year;
    }
    @endphp
    <title>{{ $title }}</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <div style="width: 700px; margin: auto;">
        <div style="text-align: center; padding: 20px;">
            <img src="https://i.imgur.com/CcLPmoG.png" alt="Logo" style="width: 125px; height: 100px;">
            <h2>{{ $title }}</h2>
        </div>

        <div class="">
            {{-- <span style="font-size: 20px;">Nomor Invoice <span style="text-transform: uppercase">#{{ $bookings->book_code }}</span></span> --}}
            <br>
            <span style="font-size: 20px;">Dear Bapak / Ibu Manager</span>
            <br>

            <p style="font-size: 16px;">Berikut kami sampaikan laporan transaksi dan pendapatan untuk periode yang telah ditentukan. Laporan ini mencakup semua transaksi dan pendapatan yang telah diterima dari sistem informasi jasa penyedia fotografi. Kami berharap laporan ini dapat membantu Anda dalam membuat keputusan bisnis yang lebih baik dan memberikan gambaran umum tentang kinerja perusahaan.</p>
        </div>
        <div style="margin-top: 30px;">
            <div class="">
                <span style="font-size: 16px">Data Laporan: {{ $month === 'all' ? 'Semua Bulan' : $monthNames[$month - 1] }}, {{ $year }}</span>
                <br>
                {{-- <span style="font-size: 16px">Tanggal Pembayaran Tagihan: </span> --}}
            </div>

            <table style="width: 100%; border-collapse: collapse; margin-top: 5px;">
                <tr>
                    <th style="border: 1px solid #ddd; padding: 15px; text-align: center; background-color: #f2f2f2;">ID Transaksi</th>
                    <th style="border: 1px solid #ddd; padding: 15px; text-align: center; background-color: #f2f2f2;">Tanggal Transaksi</th>
                    <th style="border: 1px solid #ddd; padding: 15px; text-align: center; background-color: #f2f2f2;">Nama Package</th>
                    <th style="border: 1px solid #ddd; padding: 15px; text-align: center; background-color: #f2f2f2;">Harga</th>
                    <th style="border: 1px solid #ddd; padding: 15px; text-align: center; background-color: #f2f2f2;">Ket</th>
                </tr>
                @php
                $totalBeforeTax = 0;
                @endphp
                @forelse ($bookings as $item)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center; text-transform: uppercase;">#{{ $item->book_code }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;">{{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;">{{ $item->book_product->product_name }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: left;">{{ $item->book_product->product_price }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;"><b style="color: lime">PAID</b></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="border: 1px solid #ddd; padding: 15px; text-align: center;">Tidak ada data transaksi</td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">Sub Total Income</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">Rp. {{ number_format($income, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">11.00 % PPN</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">Rp. {{ number_format($income * 0.11, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">Total</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">Rp. {{ number_format($income * 1.11, 0, ',', '.') }}</td>
                </tr>



            </table>
        </div>
        <div class="">
            <p style="font-size: 16px;">Demikian laporan ini kami sampaikan, agar kiranya dapat dipergunakan sebaik baiknya. Sekian dan terima kasih..</p>
        </div>
        <div class="" style="margin-top: 2cm;">
            <p style="font-size: 16px;">Hormat Kami</p>
            <p style="font-size: 16px; margin-top: 75px;">{{ $web->site_name }}</p>
        </div>
    </div>
</body>
</html>
