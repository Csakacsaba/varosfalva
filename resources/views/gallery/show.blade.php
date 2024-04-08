@extends('layouts.master')

@section('styles')
    @vite('resources/css/kepek.css')
@endsection

@section('content')
    <div class="content flex">
        <div>
            @include('gallery.navgallery')
        </div>
        <div class="images">

            @foreach($images as $index => $i)
                <img id="myImage{{$index}}" src="{{($i->getFullUrl())}}" alt=""
                     onclick="zoomImage(this, '{{$i->getFullUrl()}}')"
                     data-description='{{$i->custom_properties['description']}}'>
                @can('admin')
                    <form class="img-delete-button" method="POST" action='{{route('delete_img_admin',['media'=>$i->id])}}'>
                        @csrf
                        @method('DELETE')
                        <button style="cursor: pointer" type="submit"><i class="fa-solid fa-trash-can" style="color: #d30909;"></i></button>
                    </form>
                @endcan
            @endforeach
        </div>
    </div>
    <div class="mt-8">
        {{ $images->links('paginate.link') }}
    </div>
@endsection

<script>
    function zoomImage(img, imgSrc) {
        var zoomDiv = document.createElement("div");
        zoomDiv.style.position = "fixed";
        zoomDiv.style.top = "0";
        zoomDiv.style.left = "0";
        zoomDiv.style.width = "100%";
        zoomDiv.style.height = "100%";
        zoomDiv.style.background = "rgba(0, 0, 0, 0.92)";
        zoomDiv.style.zIndex = "9999";
        zoomDiv.onclick = function() {
            document.body.removeChild(this);
        };
        var zoomImg = document.createElement("img");
        zoomImg.src = imgSrc;  // A kép forrása az eredeti kép URL-je lesz
        zoomImg.style.transition = "transform 1.5s ease-out";
        zoomImg.style.transform = "translate(-50%, -50%)";
        zoomImg.style.maxWidth = "85%";
        zoomImg.style.maxHeight = "85%";
        zoomImg.style.position = "absolute";
        zoomImg.style.top = "50%";
        zoomImg.style.left = "50%";

        var zoomDescription = document.createElement("p");
        zoomDescription.innerHTML = img.dataset.description;
        zoomDescription.style.color = "white";
        zoomDescription.style.textAlign = "center";
        zoomDescription.style.marginTop = "0px";
        zoomDescription.style.fontSize = "28px"
        zoomDescription.style.zIndex = "9999"
        zoomDiv.appendChild(zoomImg);
        zoomDiv.appendChild(zoomDescription);
        document.body.appendChild(zoomDiv);
    }
</script>



