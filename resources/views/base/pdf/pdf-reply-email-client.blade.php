<!DOCTYPE html>
<html>
<head>
    <title>Balasan Email Dari Kami</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f6f6f6;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #cccccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            text-align: center;
            color: #888888;
            font-size: 12px;
            margin-top: 20px;
        }
        .warning {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo">
            <img src="https://i.imgur.com/CcLPmoG.png" alt="Logo" style="width: 125px; height: 100px;">
        </div>
        <p class="warning">— TIDAK AKAN ADA BALASAN JIKA ANDA MEMBALAS EMAIL INI —</p>
        <p class="warning">— NO REPLY FROM OUR STAFF WHEN YOU REPLY TO THIS EMAIL —</p>
        {{-- <p>Mohon untuk tidak membalas email notifikasi ini, Anda dapat melihat dan mengupdate tiket ini kapan saja di: <a href="ticket-url">ticket-url</a></p> --}}
        {{-- <p>Please do not reply this notification email, you can view and update the ticket anytime at: <a href="ticket-url">ticket-url</a></p> --}}
        <h1>Halo, {{ $email->contact_name }}</h1>
        <p>Terima kasih telah menghubungi kami. Berikut adalah balasan untuk pertanyaan Anda:</p>
        <p>{!! $email->contact_message !!}</p>
        <br>
        <p>Silakan hubungi kami lagi jika Anda memiliki pertanyaan lain.</p>
        <br>
        <p>Harap dicatat bahwa email ini dikirimkan secara otomatis dan tidak menerima balasan email.</p>
        <div class="footer">
            <p>Terima kasih,</p>
            <br>
            @php
                $web = App\Models\WebSetting::all()->first();
            @endphp
            <p>{{ $web->site_name }}</p>
        </div>
    </div>
</body>
</html>
