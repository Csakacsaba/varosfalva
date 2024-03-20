<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link id="favicon" rel="icon" type="image/png" href="storage/icons/fav.png">

    <title>Reset Password</title>
    @vite('resources/css/register.css')
</head>
<body>
<div class="content contact">
    <div class="buttons">
        <a href="{{route('contact')}}"> Vissza a főoldalra</a>
    </div>
    <h2>Jelszó megváltoztatása</h2>
    <form method="POST" action="{{route('password.reset.confirmation')}}">
        <div class="container">
            <div class="errors">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>
                <div class="form-group">
                    <label>New password:</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label>Password confirmation:</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>
                @error('password')
                <p>{{$message}}</p>
                @enderror
                @error('token')
                <p>{{$message}}</p>
                @enderror
                @error('email')
                <p>{{$message}}</p>
                @enderror

            </div>

            <input type="hidden" name="token" value="{{$token}}">
            <button type="submit" class="button-33" role="button">Jelszó megváltoztatása</button>

        </div>
    </form>
</div>
</body>
</html>
