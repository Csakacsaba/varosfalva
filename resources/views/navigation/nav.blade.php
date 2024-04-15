<div class="info-bar">
    <div class="card">
        <div class="weather-info">
            <div class="city"></div>
            <div class="temp"></div>
            <div class="humidity"></div>
        </div>
    </div>
    <div class="lang">
{{--        @if(\Illuminate\Support\Facades\App::getLocale() == 'ro')--}}
            <form style="margin: 0" action="{{ route('cahange_l', ['locale'=>'hu']) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <button style="cursor: pointer; border: 1px solid rgba(0,0,0,0); padding: 5px; margin-right: 5px; background-color: rgba(255,255,255,0);" type="submit">
                    <img class="lang-img" src="{{asset("storage/icons/hu.jpg")}}" alt="">
                </button>
            </form>
{{--        @else--}}
            <form style="margin: 0" action="{{ route('cahange_l', ['locale'=>'ro']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button style="cursor: pointer; border: 1px solid rgba(0,0,0,0);  padding: 5px; margin-right: 5px; background-color: rgba(255,255,255,0);" type="submit">
                    <img class="lang-img" src="{{asset("storage/icons/ro.jpg")}}" alt="">
                </button>
            </form>
{{--        @endif--}}
    </div>
    <div class="date-clock">
        <div class="date"></div>
        <div class="clock"></div>
        <div class="clock"></div>
    </div>
</div>
<nav class="navbar">

    <div class="valami">
        <a class="main-title" href="{{route("home")}}"><h1> {{__('nav.name')}}</h1></a>
        @auth()
                @csrf
                <a style="padding: 10px; margin-top: 10px" href="{{route('user.edit')}}" type="submit"><i style="margin-right: 8px" class='fas fa-user-circle' ></i>{{auth()->user()->name}}</a>
        @endauth
    </div>
    @vite('resources/css/nav.css')
    <ul class="nav-menu">
        <li class="nav-item"><a href="{{route('home')}}" class="nav-link"><i class='fas fa-house-user'></i> {{__('nav.home')}}</a></li>
        <li class="nav-item"><a href="{{route('helytortenet')}}" class="nav-link"><i class="fa-sharp fa-solid fa-book"></i>{{__('nav.story')}}</a></li>
        <li class="nav-item"><a href="{{route('kepek', ['szuretibalok'])}}" class="nav-link"><i class="fa-regular fa-images"></i>{{__('nav.gallery')}}</a></li>
        <li class="nav-item"><a href="{{route('egyhaz')}}" class="nav-link"><i class="fa-sharp fa-solid fa-place-of-worship"></i>{{__('nav.church')}}</a></li>
        <li class="nav-item"><a href="{{route('news')}}" class="nav-link"><i class="fas fa-newspaper"></i> {{__('nav.news')}}</a></li>
        <li class="nav-item"><a href="{{route('contact')}}" class="nav-link"><i class="fa-regular fa-handshake"></i>{{__('nav.contact')}}</a></li>
    </ul>


    <div class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

</nav>

<script>
    function formatNumber(number) {
        return number < 10 ? "0" + number : number;
    }

    function updateDateTime() {
        var datum = new Date();

        var ev = datum.getFullYear();
        var honap = formatNumber(datum.getMonth() + 1);
        var nap = formatNumber(datum.getDate());

        var ora = formatNumber(datum.getHours());
        var perc = formatNumber(datum.getMinutes());
        var masodperc = formatNumber(datum.getSeconds());

        document.querySelector(".date").innerHTML = ev + "-" + honap + "-" + nap;
        document.querySelector(".clock").innerHTML = "&nbsp &nbsp" + ora + ":" + perc + ":" + masodperc;
    }

    setInterval(updateDateTime, 100);



    // 55759d054f28b4bdd7c4fd23f3e70e8f      api key
    const apiKey = "55759d054f28b4bdd7c4fd23f3e70e8f"
    const apiUrl = "https://api.openweathermap.org/data/2.5/weather?q=martinis&appid=55759d054f28b4bdd7c4fd23f3e70e8f&units=metric"

    async function checkWeather() {
        const response = await fetch(apiUrl);
        var data = await response.json();

        console.log(data);
        const roundedTemp = Math.round(data.main.temp);
        const roundedwind = Math.round(data.wind.speed)
        const sky = data.weather[0].main;
        // console.log(sky);

        document.querySelector(".city").innerHTML = data.name;
        document.querySelector(".temp").innerHTML = roundedTemp + " °c";
        document.querySelector(".humidity").innerHTML = "Pára: " + data.main.humidity + "%";
        document.querySelector(".wind").innerHTML = "Szél: " + roundedwind +  " km/h" + "";
        document.querySelector(".wind-img").src = "{{asset('storage/fooldal/wind.png')}}"

        if (sky === 'Rain') {
            document.querySelector(".weather-icon").src = "{{asset('storage/fooldal/rainy.png')}}";
        } else if (sky === 'Clouds') {
            document.querySelector(".weather-icon").src = "{{asset('storage/fooldal/cloudy.png')}}";
        } else if (sky === 'Sun') {
            document.querySelector(".weather-icon").src = "{{asset('storage/fooldal/default.png')}}";
        }
        //     ide meg a tobbit is meg kell csinalni
    }

    checkWeather();
    // https://www.youtube.com/watch?v=MIYQR-Ybrn4&ab_channel=GreatStack
</script>

@vite('resources/js/nav.js')

