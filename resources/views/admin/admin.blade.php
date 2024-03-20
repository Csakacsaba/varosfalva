

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="favicon" rel="icon" type="image/png" href="storage/icons/fav.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    @vite('resources/css/admin.css')
    @vite('resources/js/admin.js')

    <title>{{ $title ?? 'Admin' }}</title>
</head>

<body>
<div class="container">
    <div class="sidebar">
        <div class="menu">
            <hr>
            <a class="home" href="#">Vissza</a>
            <hr>
            <a href="{{route('home')}}"><i class='fas fa-house-user'></i> Főoldal</a>
            <a href="{{route('helytortenet')}}"><i class="fa-sharp fa-solid fa-book"></i> Helytörténet</a>
            <a href="{{route('kepek', ['szuretibalok'])}}"><i class="fa-regular fa-images"></i> Képek</a>
            <a href="{{route('egyhaz')}}"><i class="fa-sharp fa-solid fa-place-of-worship"></i> Egyház</a>
            <a href="{{route('news')}}" class="nav-link"><i class="fas fa-newspaper"></i> Hírek</a>
            <a href="{{route('contact')}}"><i class="fa-regular fa-handshake"></i> Kapcsolatfelvétel</a>
            <hr>
            <a class="home" href="#">Admin menü</a>
            <hr>
            <a href="{{route('admin')}}"><i class="fas fa-newspaper"></i> Képek és kommentek</a>
            <a href="{{route('news.admin')}}"><i class="fas fa-newspaper"></i> Hírek</a>

        </div>
    </div>

    <div class="content">
        <h1 class="cim">KÉPEK ÉS KOMMENTEK KEZELÉSE</h1>

        <div class="flex">
            <div class="pictures">
                <h1 class="tittle" >Pictures</h1>
                <div class="form">
                    <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group file">
                            <label for="image">Image File:</label>
                            <div id="image-preview"></div>
                            <input type="file" name="image[]" multiple class="form-control" id="image-input">
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Image Category:</label>
                            <select name="type" id="type" class="form-control">
                                <option value="szuretibalok">Szureti Bálok</option>
                                <option value="eletkepek">Életképek</option>
                                <option value="falunapok">Falunapok</option>
                                <option value="regikepek">Régi Képek</option>
                                <option value="egyesulet">Egyesület</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="image">Image description:</label>
                            <input type="text" placeholder="Max 10 szó!" name="description" class="form-control text">
                            @error('text')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror

                        </div>
                        <div style="display: flex; justify-content: center">
                            <button style="width: 180px" type="submit" class="upload-button" onclick="showLoadingIcon()">Upload Image</button>
                            <img style="width: 50px" class="loading-icon" src="{{asset('storage/icons/loading.gif')}}">
                        </div>
                    </form>
                </div>
                <div>
                    <hr>
                    <h1 class="tittle">Users</h1>
                    @foreach($users as $user)
                        <div class="user">
                            <p class="username">{{$user->name}}</p>
                            <div>
                                @if(!$user->banned)
                                    <form method="POST" action='{{route('bann_user_admin',$user)}}'>
                                        @csrf
                                        <button class="bann-button">
                                            Felhasználó Letiltása

                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action='{{route('unlock_user_admin',$user)}}'>
                                        @csrf
                                        <button class="unlock-button">
                                            Felhasználó feloldása
                                            <p class="banned">Letiltva</p>
                                            <span>&#10060;</span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
            <div class="comments">
                <h1 class="tittle" >Comments</h1>
                @foreach($comments as $comment)
                    <div class="comment">
                        <div class="media-comment">

                            <div class="content">
                                <div>
                                    <h4 class="admin-h4">{{$comment->user->name}}</h4>
                                    <span class="time">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                </div>

                                <p>{{$comment->text}}</p>

                                <div class="comment-icons">
                                    <form method="POST" action='{{route('delete_comment_admin',['comment'=>$comment->id])}}'>
                                        @csrf
                                        <button class="delete-button">
                                            Törlés
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                    @if($comment->accepted == 0)
                                        <form method="POST" action='{{ route('accept.comment', ['comment' => $comment->id]) }}'>
                                            @csrf
                                            <button class="accept-button" type="submit">
                                                Elfogadás

                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function showLoadingIcon() {
        var loadingIcon = document.querySelector('.loading-icon');
        loadingIcon.style.display = 'inline-block';
    }
</script>
</body>



</html>







