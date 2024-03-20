<!doctype html>
<html lang="en">
@vite('resources/css/app.css')
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="background-image: linear-gradient(to bottom right, #34D399, #047857); border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); padding: 2rem;">
    <h1 style="font-size: 2.5rem; font-weight: bold; color: #fff; margin-bottom: 1.5rem;">Hozzászólás érkezett</h1>
    <p style="font-size: 1.125rem; color: #fff; margin-bottom: 1rem;">Lépjen az admin felületre az elfogadáshoz vagy törléshez</p>
    <div style="border: 1px solid #fff; border-radius: 1rem; padding: 1.5rem; background-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">
        <p style="font-size: 1.125rem; color: #fff; opacity: 0.8; margin-bottom: 1rem;">Az új hozzászólás szövege:</p>
        <p style="font-size: 1.5rem; color: #fff; margin-bottom: 2rem;"><b>{{ $text }}</b></p>
        <p style="font-size: 1.125rem; color: #fff; opacity: 0.8; margin-bottom: 0.5rem;">Felhasználó neve:</p>
        <p style="font-size: 1.5rem; color: #fff; margin-bottom: 1rem;"><b>{{ $user_name }}</b></p>
    </div>
    <div style="margin-top: 2rem; text-align: center;">
        <a href="{{route('login')}}" style="background-color: #fff; color: #4F46E5; padding: 0.5rem 1.5rem; border-radius: 9999px; font-weight: bold; text-decoration: none; display: inline-block; transition: background-color 0.3s ease-in-out;">
            Admin felület
        </a>
    </div>
</div>

</body>
</html>
