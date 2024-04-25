<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email Anda</title>
</head>
<body>
    <div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 15px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid #ddd;">
            <img alt="Icon Header" style="width: 100%; max-width: 75px; max-height: 75px;" src="https://i.imgur.com/mQVE0RN.png" >
            <div style="font-size: 24px; font-weight: bold;">ARPotRet</div>
        </div>
        <h2>Selamat datang {{ Auth::guard('admin')->name }}</h2>
        <p style="color: red">Akun Anda belum diverifikasi, mohon check email anda untuk melakukan verifikasi terlebih dahulu</p>
    </div>
</body>
</html>
