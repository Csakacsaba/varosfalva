@extends('layouts.master')

@section('styles')
    @vite('resources/css/helytortenet.css')
    @vite('resources/css/footer.css')
@endsection

@section('content')
    <h1 class="tittle_h">{{__('helytortenet.origin_title')}}</h1>
    <div class="content-helytortenet">
        <div class="neve">
            <h2>{{__('helytortenet.origin_name_title')}}</h2>
            <img src="{{asset('storage/helytortenet/felulnezet.jpg')}}" alt="Kep">
            <div>
                <p>{{__('helytortenet.origin_name')}}</p>
                <p>{{__('helytortenet.origin_name_1')}}</p>
                <p>{{__('helytortenet.origin_name_2')}}</p>
                <p>{{__('helytortenet.origin_name_3')}}</p>
                <p>{{__('helytortenet.origin_name_4')}}</p>
                <p>{{__('helytortenet.origin_name_5')}}</p>
                <p>{{__('helytortenet.origin_name_6')}}</p>
                <p>{{__('helytortenet.origin_name_7')}}</p>
            </div>
        </div>
        <div class="regeszet" onclick="showModal('origin_description')">
            <h2>{{__('helytortenet.archeology_title')}}</h2>
            <img src="{{asset('storage/helytortenet/regeszeti leletek.jpg')}}" alt="Kep">
            <p>{{__('helytortenet.archeology')}}</p>
            <p>{{__('helytortenet.archeology_1')}}</p>
        </div>
        <div class="kozepkor ujkor" onclick="showModal('origin_description')">
            <h2>{{__('helytortenet.middle_ages_title')}}</h2>
            <p>{{__('helytortenet.middle_ages_1')}}</p>
            <p>{{__('helytortenet.middle_ages_2')}}</p>
            <p>{{__('helytortenet.middle_ages_3')}}</p>
            <p>{{__('helytortenet.middle_ages_4')}}</p>
            <p>{{__('helytortenet.middle_ages_5')}}</p>
            <p>{{__('helytortenet.middle_ages_6')}}</p>
            <p>{{__('helytortenet.middle_ages_7')}}</p>
            <p>{{__('helytortenet.middle_ages_8')}}</p>
        </div>
        <div class="templom" onclick="showModal('origin_description')">
            <h2>{{__('helytortenet.church_title')}}</h2>
            <img src="{{asset('storage/helytortenet/templom.jpg')}}" alt="Kep">
            <p>{{__('helytortenet.church')}}</p>
            <p>{{__('helytortenet.church_1')}}</p>
            <p>{{__('helytortenet.church_2')}}</p>
            <p>{{__('helytortenet.church_3')}}</p>
            <p>{{__('helytortenet.church_4')}}</p>
        </div>
        <div class="iskola" onclick="showModal('origin_description')">
            <h2>{{__('helytortenet.school_title')}}</h2>
            <img src="{{asset('storage/helytortenet/iskola.jpg')}}" alt="Kep">
            <p>{{__('helytortenet.school_0')}}</p>
            <p>{{__('helytortenet.school_1')}}</p>
            <p>{{__('helytortenet.school_2')}}</p>
            <img src="{{asset('storage/helytortenet/kultur.jpg')}}" alt="Kep">
            <p>{{__('helytortenet.school_3')}}</p>
            <p>{{__('helytortenet.school_4')}}</p>
            <p>{{__('helytortenet.school_5')}}</p>
            <p>{{__('helytortenet.school_6')}}</p>
        </div>
        <div class="hiresemberek" onclick="showModal('origin_description')">
            <h2>{{__('helytortenet.famous_people_title')}}</h2>
            <p>{{__('helytortenet.famous_people')}}</p>
            <ul class="link-list">
                <li class="list-item">
                    <a href="https://hu.wikipedia.org/wiki/Szent%C3%A1brah%C3%A1mi_Lombard_Mih%C3%A1ly">
                        Szentábrahámi Lombard Mihály
                        <img style="width: 270px" class="thumbnail" src="{{asset('storage/helytortenet/Szentabrahami.jpg')}}" alt="Kep">
                    </a>
                </li>
                <li class="list-item">
                    <a href="http://mek.niif.hu/04700/04756/html/43.html#id245497">
                        Dersi Simó István
{{--                        <img style="width: 270px" class="thumbnail" src="{{asset('storage/helytortenet/Szentabrahami.jpg')}}" alt="Kep">--}}
                    </a>
                </li>
                <li class="list-item">
                    <a href="https://hu.wikipedia.org/wiki/Szab%C3%B3_%C3%81rp%C3%A1d_(unit%C3%A1rius_p%C3%BCsp%C3%B6k)">
                        Dr. Szabó Árpád
{{--                        <img style="width: 270px" class="thumbnail" src="{{asset('storage/helytortenet/Szentabrahami.jpg')}}" alt="Kep">--}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @include('layouts.footer')
    <script>
        document.querySelector('.neve').addEventListener('click', function() {
            var descriptionDiv = document.getElementById('origin_description_neve');
            descriptionDiv.style.display = (descriptionDiv.style.display === 'none' || descriptionDiv.style.display === '') ? 'block' : 'none';
        });



    </script>

@endsection

