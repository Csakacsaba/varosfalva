@extends('layouts.master')


@section('styles')
    @vite('resources/css/fooldal.css')
    @vite('resources/css/nav.css')
    @vite('resources/css/footer.css')
@endsection

@section('content')
    <div class="background-picture"><img class="presentation-img" src="{{asset('storage/fooldal/borus-kep-varosfalva2.jpg')}}" alt="Kep"></div>
    <div class="background-picture-mobile"><img class="presentation-img" src="{{asset('storage/fooldal/templom.jpg')}}" alt="Kep"></div>
    <div class="content">

        <div  class="short-presentation">
            <div class="text-left">
                <div>
                    <h1 style="margin: 230px 0">{{__('fooldal.greeting')}}</h1>
{{--                    <p>{{__('fooldal.short_presentation_1')}}</p>--}}
{{--                    <p>{{__('fooldal.short_presentation_2')}}</p>--}}
{{--                    <p>{{__('fooldal.short_presentation_3')}}</p>--}}
                </div>
                <div class="bottom-short-presentation">
{{--                    <div>--}}
{{--                        <p class="bottom-short-presentation-p">Lorem ipsum dolor sit amasi. Animi corporis cum expedita impedit itaque iusto maxime mollitia nam nobis nulla placeat unde voluptates?  impedit itaque iusto maxime mollitia nam nobis nulla placeat unde voluptates?</p>--}}
{{--                        <p class="bottom-short-presentation-p">mi corporis cum, cupiditate doloremque dolorum eaque expedita impedit itaque iusto maxime mollitia nam nobis nulla placeat unde voluptates?  impedit itaque iusto maxime mollitia nam nobis nulla placeat unde voluptates?</p>--}}
{{--                    </div>--}}
{{--                    <div style="margin: 0 auto" class="card">--}}
{{--                        <div class="weather-info">--}}
{{--                            <div class="city"></div>--}}
{{--                            <div class="temp"></div>--}}
{{--                            <div style="margin: 8px 0" class="humidity"></div>--}}
{{--                            <div style="margin: 8px 0" class="wind">--}}
{{--                                <img class="wind-img" src="" alt="WIND">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="weather-icon-container">--}}
{{--                            <img class="weather-icon" src="{{asset('storage/fooldal/cloudy.png')}}" alt="Weather Icon">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
{{--            <div class="picture-left">--}}
{{--                <img class="presentation-img" src="{{asset('storage/fooldal/borus-kep-varosfalva.jpg')}}" alt="Kep">--}}
{{--            </div>--}}
        </div>

        <div class="background">
            <div class="elhelyezkedes">
                <h2 class="short-presentation-h2">{{__('fooldal.short_presentation_title')}}</h2>
                <p>{{__('fooldal.short_presentation_1')}}</p>
                <p>{{__('fooldal.short_presentation_2')}}</p>
                <p>{{__('fooldal.short_presentation_3')}}</p>
            </div>
            <div class="videos">

                <div class="video-description">
                    <p class="video_name">{{__('fooldal.video_tittle_1')}}</p>
                    <video class="video" id="myVideo" width="680" height="380" controls>
                        <source src="{{ asset('storage/videos/v.mp4') }}" type="video/mp4">
                    </video>
                </div >

                <div class="video-description">
                    <p class="video_name">{{__('fooldal.video_tittle_2')}}</p>
                    <iframe class="video" width="680" height="380" src="https://www.youtube.com/embed/znO7mzeTZW4"
                            allowfullscreen></iframe>
                </div>

            </div>
            <div>
                <h2><p>{{__('fooldal.map_title')}}</p></h2>
            </div>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111037.05690196277!2d24.27637441778915!3d44.44188094913426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47339d26a91911d7%3A0x17c7edab60a34f99!2sOr%C4%83%C8%99eni%20874050%2C%20Romania!5e0!3m2!1sen!2sus!4v1651660363242!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="elhelyezkedes">
                <h2>{{__('fooldal.location_title')}}</h2>
                <p>{{__('fooldal.location_description_1')}}</p>
                <p>{{__('fooldal.location_description_2')}}</p>
                <p>{{__('fooldal.location_description_3')}}</p>
                <p>{{__('fooldal.location_description_4')}}</p>
            </div>
            <div class="elhelyezkedes">
                <h2>{{__('fooldal.climate_title')}}</h2>
                <p>{{__('fooldal.climate_description_1')}}</p>
                <p>{{__('fooldal.climate_description_2')}}</p>
                <p>{{__('fooldal.climate_description_3')}}</p>
                <p>{{__('fooldal.climate_description_4')}}</p>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    <script>
        const video = document.getElementById('myVideo');

        video.addEventListener('ended', () => {
            video.currentTime = 0;
            video.play();
        });

        window.addEventListener('DOMContentLoaded', () => {
            video.play();
        });

    </script>
@endsection
