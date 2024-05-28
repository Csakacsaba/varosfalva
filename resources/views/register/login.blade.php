<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link id="favicon" rel="icon" type="image/png" href="storage/icons/fav.png">

    <title>Login</title>
    @vite('resources/css/register.css')
    @vite('resources/css/app.css')
</head>
<body>
<div class="content contact">

    <div class="buttons">
        <a href="{{route('contact')}}"> {{__('login.back_to_home')}}</a>
    </div>


    <h2 class="text-3xl">{{__('login.title')}}</h2>

    <form method="POST" action="{{route('inlogin')}}">
        <div class="container max-w-xs">
            <div class="errors">
                @csrf
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 text-sm font-medium text-gray-900 dark:text-white" name="email" id="email">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="password" id="phone">
                </div>
                @error('email')
                <p>{{__('flash.login_error_email')}}</p>
                @enderror
                @error('password')
                <p>{{__('flash.login_error_password')}}</p>
                @enderror

                <button type="submit" class="button-33 bg-emerald-300" role="button">{{__('login.button')}}</button>
                <div class="google-button">
                    <a href="{{ route('google.login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        <svg class="fill-current w-4 h-4 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
                            <path d="M533.5 278.4c0-18.5-1.5-37.1-4.7-55.3H272.1v104.8h147c-6.1 33.8-25.7 63.7-54.4 82.7v68h87.7c51.5-47.4 81.1-117.4 81.1-200.2z" fill="#4285f4"/>
                            <path d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-87.7-68c-24.4 16.6-55.9 26-92.6 26-71 0-131.2-47.9-152.8-112.3H28.9v70.1c46.2 91.9 140.3 149.9 243.2 149.9z" fill="#34a853"/>                        <path d="M119.3 324.3c-11.4-33.8-11.4-70.4 0-104.2V150H28.9c-38.6 76.9-38.6 167.5 0 244.4l90.4-70.1z" fill="#fbbc04"/>                        <path d="M272.1 107.7c38.8-.6 76.3 14 104.4 40.8l77.7-77.7C405 24.6 339.7-.8 272.1 0 169.2 0 75.1 58 28.9 150l90.4 70.1c21.5-64.5 81.8-112.4 152.8-112.4z" fill="#ea4335"/>
                        </svg>
                        <span>Login with Google</span>
                    </a>
                </div>
                <div class="bottom-buttons" style="display: flex; flex-direction: row; justify-content: space-between;">
                    <button class="px-4 whitespace-nowrap py-2 rounded-l-3xl rounded-r-3xl text-white m-0 bg-red-500 hover:bg-red-600 transition"><a href="{{route('password.req')}}" class="login-red-a-tag">{{__('login.button_1')}}</a></button>
                    <button class="px-4 hover:underline text-red-500 py-2 rounded-r-3xl rounded-l-3xl bg-neutral-50 hover:bg-neutral-100 transition"><a href="{{route('register')}}">{{__('login.button_2')}}</a></button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
