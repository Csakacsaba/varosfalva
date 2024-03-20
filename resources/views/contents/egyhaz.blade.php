@extends('layouts.master')

@section('styles')
{{--    @vite('resources/css/fooldal.css')--}}
    @vite('resources/css/egyhaz.css')
@endsection
<div style="margin: 0 auto; max-width: 80%">
    @section('content')
        <div  class="cim">
            <h1 class="egyhaz">Városfalvi egyházközség</h1>
            <iframe src="http://varosfalviegyhazkozseg.blogspot.com" style="height: 1200px; width: 92%; margin: 0 auto; z-index: 10"></iframe>
        </div>
    @endsection
</div>



