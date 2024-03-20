@extends('layouts.master')


@section('styles')
    @vite('resources/css/contact.css')
    @vite('resources/css/nav.css')
    @vite('resources/js/comments.js')
    @vite('resources/css/footer.css')
@endsection


@section('content')
    @auth()
        <div class="comment-section">
            <div class="from-user">
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="logout-button">
                        {{__('comments.logout')}}
                    </button>
                </form>
                @can('admin')
                    <a class="admin-felulet" href="{{route('admin')}}">Admin felületre</a>
                @endcan
            </div>
            <h1 class="greeting">{{__('comments.greeting')}}</h1>
            @if(!auth()->user()->banned)
            <div class="container">
                <form action="{{route('comment.save')}}" method="POST">
                    @csrf
                    <textarea name="text" rows="10" placeholder="{{__('comments.add_comment_placeholder')}}"></textarea>
                    <button class="add-comment-button" type="submit" onclick="showLoadingIcon()">{{__('comments.add_comment')}}</button>
                    <img class="loading-icon" src="{{asset('storage/icons/loading.gif')}}">
                    @error('text')
                        <p class="text-error"> <span>&#33;</span> {{$message}} <span>&#33;</span></p>
                    @enderror
                </form>
            </div>
            @else
                <p class="banned-text">{{__('comments.bann')}}</p>
            @endif
        </div>
    @endauth


    @guest()
        <div class="buttons">
            <a class="register" href="{{route('register')}}">{{__('comments.register')}}</a>
            <a href="{{route('login')}}">{{__('comments.login')}}</a>
        </div>
        <h1 class="intittle" style="text-align: center; color: whitesmoke">{{__('comments.greeting')}}</h1>
    @endguest


    <div class="col-md-8">
        <div class="media g-mb-30 media-comment">

            <div class="content">
                <div>
                    <h4 style="text-shadow: #bdbdbd 1px 1px 5px; font-size: 20px;">{{__('comments.admin_comment_name')}}</h4>
                </div>
                <p >{{__('comments.admin_comment')}}</p>
            </div>
        </div>
    </div>

    <h2 class="comment-tittle-yellow">{{__('comments.comments_title')}} </h2>

    <form method="POST" action="{{route('search_contact')}}">
        @csrf
        <input class="comment" style="" type="text" name="search" placeholder="{{__('comments.search')}}">
        <button class="search button"><i class="fa fa-search" ></i></button>
    </form>

    @foreach($comments as $comment)
        @auth()
            @if($comment->accepted == 0)
                @if($comment->user_id == auth()->user()->id)
                    <p class="non-accepted-message">{{__('comments.comment_accept')}} "{{$comment->text}}"</p>
                @endif
            @endif
        @endauth
        @if($comment->accepted == 1)
            <div class="col-md-8">
                <div class="media g-mb-30 media-comment">
                    <div class="content">
                        <div>
                            <h4 style="text-shadow: #bdbdbd 1px 1px 5px; font-size: 20px;">{{$comment->user->name}}</h4>
                            <span class="time">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                        </div>
                        <p>{{$comment->text}}</p>
                        <div class="comment-icons">
                            <ul class="review">
                                <li>
                                    @auth()
                                        <button class="like-btn" id="like-{{ $comment->id }}" >
                                            <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                            <span class="refresh">{{$comment->likeNr}}</span>
                                        </button>
                                    @endauth
                                    @guest()
                                        <div style="background-color: lightgreen; border-radius: 5px; box-shadow: 3px 3px 7px #0006; padding: 5px">
                                            <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                            {{$comment->likeNr}}
                                        </div>
                                    @endguest
                                </li>
                                <li class="">
                                    @auth()
                                        <button class="dislike-btn" id="dislike-{{ $comment->id }}">
                                            <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
                                            <span class="refresh">
                                        {{$comment->dislikeNr}}
                                    </span>
                                        </button>
                                    @endauth
                                    @guest()
                                        <div style="background-color: indianred; border-radius: 5px; box-shadow: 3px 3px 7px #0006; padding: 5px">
                                            <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3"></i>
                                            {{$comment->dislikeNr}}
                                        </div>
                                    @endguest
                                </li>
                            </ul>
                            @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->id == $comment->user_id)
                                <form method="POST" action='{{route('delete_comment')}}'>
                                    @csrf
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <button class="delete-button" type="submit" style="padding: 8px; font-size: 15px; background-color: red; border-radius: 8px; color: white; cursor: pointer; box-shadow: 5px 5px 5px black">
                                        {{__('comments.delete')}}
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        @guest()
                            <p style="color: red; font-weight: 500; font-size: 13px">{{__('comments.login_to_comment')}}<a style="cursor: pointer ;text-decoration: none; font-size: 16px" href="{{route('login')}}">{{__('comments.login_to_comment_a')}}</a></p>
                        @endguest
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    @if(session()->has('success'))
        <div id="my-success" class="alert-success">
            {{session()->get("success")}}
        </div>
    @endif
    @if(session('message'))
        <div id="my-success" class="alert-error">
            {{ session('message') }}
        </div>
    @endif
    @include('layouts.footer')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function showLoadingIcon() {
        var loadingIcon = document.querySelector('.loading-icon');
        loadingIcon.style.display = 'inline-block';
    }
</script>
<script>
    const message = document.getElementById('my-success');
    console.log(message)
    if (message) {
        setTimeout(function () {
            message.style.display = 'none';
        }, 401212300)
    }
    document.addEventListener('LikesToTable', function () {
    })
</script>
@auth()
    <script>

        $(document).ready(function () {
            $('.like-btn').on('click', function () {
                var button = $(this);
                var commentId = $(this).attr('id').split('-')[1];
                var userId = {{auth()->user()->id}};
                var csrfToken = '{{ csrf_token() }}';

                $.ajax({
                    url: '{{route('comment.like')}}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        comment_id: commentId,
                        user_id: userId
                    },
                    success: function (response) {

                        console.log(button)
                        button.find('.refresh').html(response.like);

                        $('#dislike-' + commentId).find('.refresh').html(response.dislike);


                    },
                    error: function (xhr, status, error) {
                        // Hiba esetén itt kezelni le a hibát
                        console.log(error);
                    }
                })
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('.dislike-btn').on('click', function () {
                var button = $(this);
                var commentId = $(this).attr('id').split('-')[1];
                var userId = {{auth()->user()->id}};
                var csrfToken = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{route('comment.dislike')}}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        comment_id: commentId,
                        user_id: userId
                    },
                    success: function (response) {
                        // var newLikeCount = response.like_count;
                        // $('#like-' + commentId).text(newLikeCount);

                        console.log(button)
                        button.find('.refresh').html(response.dislike);

                        $('#like-' + commentId).find('.refresh').html(response.like);

                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })

    </script>
@endauth



