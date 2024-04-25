<!DOCTYPE html>
<html>
<head>
    <title>Tagihan Pemesanan Jasa Fotografi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('storage/images/default/site_logo.png') }}" style="width:100%; max-width:125px;">
                            </td>

                            <td>
                                Kode Booking: BK123456<br>
                                Tanggal: 22/11/2023<br>
                                Waktu: 14:00
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nama Klien: Budi<br>
                                Telepon Klien: 081234567890<br>
                                Lokasi: Jakarta
                            </td>

                            <td>
                                Nama Produk: Paket Fotografi Pernikahan<br>
                                Harga: Rp5.000.000
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Metode Pembayaran
                </td>

                <td>
                    Scan QRIS
                </td>
            </tr>
            <tr class="heading">
                <td>
                    Status Pembayaran
                </td>

                <td>
                    Proses Verifikasi Pembayaran
                </td>
            </tr>

            <tr class="details">
                <td>
                    Catatan
                </td>

                <td>
                    Mohon datang 15 menit sebelum jadwal.
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
