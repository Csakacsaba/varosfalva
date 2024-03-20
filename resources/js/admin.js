document.getElementById('image-input').addEventListener('change', function (event) {
    var imagePreview = document.getElementById('image-preview');
    imagePreview.innerHTML = '';

    for (var i = 0; i < event.target.files.length; i++) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '65px';
            img.style.maxHeight = '65px';
            img.style.margin = '5px';
            img.style.border = '1px solid white';
            imagePreview.appendChild(img);
        }
        reader.readAsDataURL(event.target.files[i]);
    }
});





