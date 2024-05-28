<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link id="favicon" rel="icon" type="image/png" href="storage/icons/fav.png">

    <title>Register</title>
    @vite('resources/css/register.css')
    @vite('resources/css/app.css')

</head>
<body>
<div class="content contact">
    <div class="buttons">
        <a href="{{route('contact')}}">{{__('login.back_to_home')}}</a>
    </div>
    <h2 class="text-3xl">{{__('login.button_2')}}</h2>
    <form method="POST" action="{{route('inregister')}}">
        @csrf
        <div class="container mx-auto md:w-80 lg:w-375">
            <div class="errors">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 text-sm font-medium text-gray-900 dark:text-white" name="name" id="name">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 text-sm font-medium text-gray-900 dark:text-white" name="email" id="email">
                </div>
                @error('email')
                <p>Ez az email cím már foglalt</p>
                @enderror

                <div class="form-group">
                    <label>Password:</label>
                    <div class="password-container">
                        <input type="password" class="password-input form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 text-sm font-medium text-gray-900 dark:text-white" name="password">
                        <button type="button" class="toggle-password-btn">SHOW</button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Password confirmation:</label>
                    <div class="password-container">
                        <input type="password" class="password-input form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 text-sm font-medium text-gray-900 dark:text-white" name="password">
                        <button type="button" class="toggle-password-btn">SHOW</button>
                    </div>
                </div>
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{__('flash.registration_error')}}</p>
                @enderror
            </div>
            <button type="submit" class="button-33 bg-emerald-300" role="button">{{__('login.button_2')}}</button>
            <button class="text-red-500 bg-white rounded-3xl w-1/2 mx-auto mb-4 hover:underline rounded-r-3xl rounded-l-3xl  hover:bg-neutral-100 transition"><a href="{{route('login')}}">{{__('login.button')}}</a></button>

        </div>
    </form>
</div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const togglePasswordBtn = document.querySelector(".toggle-password-btn");
        const passwordInput = document.querySelector(".password-input");

        togglePasswordBtn.addEventListener("click", function() {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePasswordBtn.textContent = "HIDE";
            } else {
                passwordInput.type = "password";
                togglePasswordBtn.textContent = "SHOW";
            }
        });
    });
</script>
