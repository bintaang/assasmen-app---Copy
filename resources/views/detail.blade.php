<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">

</head>
<body>
    <div class="header">
        <div id="backspace">
            <a href="{{route('photos.index')}}">Go Back</a>
        </div>
        <h1>Memorium</h1>
    </div>
    <script>
    window.addEventListener('DOMContentLoaded', function () {
        document.getElementById('autoplay-audio')?.play();
    });
</script>
@if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif
    <div>
        
    </div>

   <div class="container">
        <!-- --PHOTOS-- -->
        <div class="photos">
           
            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $photo->title }}">
        </div>


        <!-- --Details-- -->
         <div class="details">
                 <h2>{{ $photo->title }}</h2>
                 <!-- --Message and Location-- -->
                <div class="message-location">
                    <p><span> <strong>Location:</strong></span> {{ $photo->location }}</p>
                    <p id="msg">{{ $photo->message }}</p>
                </div>


                <!-- --Music-- -->
                <div class="music">
                    @if ($photo->music_path)
                        <audio controls id="autoplay-audio">
                            <source src="{{ asset('storage/' . $photo->music_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @elseif ($photo->music_url)
                        <audio controls id="autoplay-audio">
                            <source src="{{ $photo->music_url }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        <p><i>Tidak ada musik</i></p>
                    @endif
                <div>


                <!-- --Action-btn-- -->
                <div class="action-btn">
                    <a href="{{ route('photos.edit', $photo->id) }}" >Edit</a>

                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" >
                            Delete
                        </button>s
                    </form>
                </div>
         </div>
       
        
    </div>

        
       



   

    
    </div>
    
    
</div>

</body>
</html>