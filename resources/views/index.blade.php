<!DOCTYPE html>
<html>
<head>
    <title>Photo Gallery</title>
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
</head>
<body>
        <div class="header">
                    <h1>Memorium</h1>
        <div id="backspace">
            <a href="{{ route('photos.create') }}">Make A New Memories</a>
        </div>
    </div>

    <div class="gallery">
        @foreach ($photos as $photo)
            <a href="{{ route('photos.show', $photo->id) }}" class="gallery-item" title="{{ $photo->title }}">
                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $photo->title }}">
            </a>
        @endforeach
    </div>
</body>
</html>
