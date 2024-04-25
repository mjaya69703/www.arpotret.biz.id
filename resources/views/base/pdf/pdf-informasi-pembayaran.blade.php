<!DOCTYPE html>
<html>
<head>
    <title>Tagihan Pembayaran</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <div style="width: 700px; margin: auto;">
        <div style="text-align: center; padding: 20px;">
            <img src="https://i.imgur.com/CcLPmoG.png" alt="Logo" style="width: 125px; height: 100px;">
            <h2>Informasi Pembayaran Jasa Fotografi</h2>
        </div>
        <div class="">
            <span style="font-size: 20px;">Nomor Invoice <span style="text-transform: uppercase">#{{ $booking->book_code }}</span></span>
            <br>
            <span style="font-size: 20px;">Dear Bapak / Ibu {{ $booking->book_author->name }}</span>
            <br>
            <p style="font-size: 16px;">Terima kasih Anda telah melakukan pembayaran layanan di {{ $web->site_name }}. Berikut ini informasi transaksi yang telah Anda lakukan</p>
        </div>
        <div style="margin-top: 30px;">
            <div class="">
                <span style="font-size: 16px">Tanggal Tagihan: {{ Carbon\Carbon::parse($booking->created_at)->isoFormat('dddd, D MMMM YYYY ( HH:mm )') }}</span>
                <br>
                <span style="font-size: 16px">Tanggal Pembayaran Tagihan: {{ Carbon\Carbon::parse($booking->created_at)->isoFormat('dddd, D MMMM YYYY ( HH:mm )') }}</span>
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

                <tr>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center; text-transform: uppercase;">#{{ $booking->book_code }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;">{{ Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;">{{ $booking->book_product->product_name }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: left;">{{ $booking->book_product->product_price }}</td>
                    <td style="border: 1px solid #ddd; padding: 15px; text-align: center;"><b style="color: lime">PAID</b></td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">Sub Total</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">{{ $booking->book_product->product_price }}</td>
                </tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">11.00 % PPN</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">Rp. {{ number_format((int) $booking->book_product->raw_product_price * 0.11, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 15px; text-align: right;">Total</td>
                    <td colspan="2" style="border: 1px solid #ddd; padding: 15px; text-align: left;">Rp. {{ number_format((int) $booking->book_product->raw_product_price * 1.11, 0, ',', '.') }}</td>
                </tr>



            </table>
        </div>
        <div class="">
            <p style="font-size: 16px;">Terima kasih telah menggunakan layanan kami.</p>
        </div>
        <div class="" style="margin-top: 2cm;">
            <p style="font-size: 16px;">Hormat Kami</p>
            <p style="font-size: 16px; margin-top: 75px;">{{ $web->site_name }}</p>
        </div>
    </div>
</body>
</html>
