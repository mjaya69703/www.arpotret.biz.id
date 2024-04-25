<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 2px solid black;
        }
        .header img {
            width: 300px;
            height: 125px;
        }
        .company-info {
            text-align: left;
        }
        .company-info h1 {
            margin-bottom: 15px;
        }
        .company-info p {
            margin-bottom: 10px;
        }
        .content {
            margin: 40px 20px;
        }
    </style>
    @php $web = App\Models\WebSetting::all()->first()@endphp
</head>
<body>
    <div class="header">
        <div class="company-info">
            <h1>{{ $web->site_name }} Studio</h1>
            <p>{{ $web->site_name }}</p>
            <p>{{ $web->site_phone }}</p>
        </div>
        <img src="{{ asset('storage/images/default/site_logo.png') }}" alt="Logo Perusahaan">
    </div>
    <div class="content">
        <p>Tanggal: <span id="date"></span></p>
        <h2 style="margin-top: 20px;">Judul Surat</h2>
        <p style="margin-top: 20px;">Isi surat Anda di sini.</p>
    </div>
</body>
<script>
    document.getElementById('date').innerHTML = new Date().toLocaleDateString();
</script>
</html>
