<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link id="favicon" rel="icon" type="image/png" href="storage/icons/fav.png">

    <title>Password Request</title>
    @vite('resources/css/register.css')
</head>
<body>
<div class="content contact">
    <div class="buttons">
        <a href="{{route('contact')}}"> Vissza a főoldalra</a>
    </div>
    <h2>Új jelszó kérelem</h2>

    <form method="POST" action="{{route('password.request')}}">
        <div class="container">
            <div class="errors">
                @csrf
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                @error('email')
                <p>{{$message}}</p>
                @enderror
                <p class="password_request_p">A kérelem gomra kattintva kiküldünk önnek egy emailt ahol meg tudja változtatni a jelszavát.</p>
                <button type="submit" class="button-33" role="button">Kérelem</button>
            </div>
        </div>

    </form>
</div>
</body>
</html>
