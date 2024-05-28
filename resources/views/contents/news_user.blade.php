@extends('layouts.master')

@section('styles')
    @vite('resources/css/news_user.css')
    @vite('resources/css/footer.css')
@endsection

@section('content')
    <h1 class="news_title">Hírek</h1>
    <div class="container">

        @if($news->isEmpty())
            <p class="no_news">Nincsenek hírek.</p>
        @else
            @foreach($news as $new)
                <div class="news">
                    <h2  class="news_heading">{{$new->title}}</h2>
                    <p class="news_content">{{$new->content}}</p>
                    <img class="news-img" src="{{asset($new->image)}}" alt="Kép">
                    <div class="news_meta">
                        <p class="author">Szerző: {{$new->author}}</p>
                        <p style="color: #1a202c" class="date">{{ \Carbon\Carbon::parse($new->created_at)->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div style="margin-top: 26rem ">
        @include('layouts.footer')
    </div>
@endsection
