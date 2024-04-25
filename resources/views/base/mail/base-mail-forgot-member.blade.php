<!DOCTYPE html>
<html>
<head>
    <title>Reset Password Anda</title>
</head>
<body>
    <div style="width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 15px; text-align: center; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 20px; border-bottom: 1px solid #ddd;">
            <img alt="Icon Header" style="width: 100%; max-width: 75px; max-height: 75px;" src="https://i.imgur.com/CcLPmoG.png" >
            <div style="font-size: 24px; font-weight: bold;">ARPotRet</div>
        </div>
        <h2>Halo, {{ $user['name'] }}</h2>
        <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
        <p>Token ini akan Expired pada {{ $user->token_created_at->addHour()->format('H:i'); }}</p>
        <a href="{{ url('member/forgot', $user->verify_token)}}">Reset Password</a>
    </div>
</body>
</html>
