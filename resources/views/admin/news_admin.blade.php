

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
    @vite('resources/css/news_admin.css')

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
        <h1 class="cim">HÍREK KEZELÉSE</h1>
        <div>
            <div class="news_upload">
                <form action="{{ route('new.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="title" placeholder="Cím: ">
                    <input type="text" name="content" placeholder="Szöveg: ">
                    <input type="text" name="author" value="{{auth()->user()->name}}">
                    <div class="image-uploader">
                        <div id="image-preview"></div>
                        <input style="border: 0" type="file" name="image" multiple class="form-control" id="image-input" required>
                    </div>
                        <div style="display: flex; justify-content: center">
                        <button style="width: 180px" type="submit" class="upload-button" onclick="showLoadingIcon()">Upload Image</button>
                        <img style="width: 50px" class="loading-icon" src="{{asset('storage/icons/loading.gif')}}">
                    </div>
                </form>

            </div>
            <div class="news">
                @foreach($news as $new)
                    <div class="news_item">
                        <h2>{{$new->title}}</h2>
                        <p>{{$new->content}}</p>
                        <img style="max-width: 100%" class="news-img" src="{{asset($new->image)}}" alt="Kép">
                        <p>Szerző: {{$new->author}}</p>
                        <p>{{$new->created_at}}</p>
                        <form action="{{ route('new.delete', $new->id) }}" method="DELETE">
                            <button class="delete-button">Törlés</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function showLoadingIcon() {
        var loadingIcon = document.querySelector('.loading-icon');
        loadingIcon.style.display = 'inline-block';
    }
</script>
</html>







