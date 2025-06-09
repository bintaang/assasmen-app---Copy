<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ isset($photo) ? 'Edit Photo' : 'Upload Photo' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <div id="backspace">
            <a href="{{ route('photos.index') }}">Back</a>
        </div>
        <h1>{{ isset($photo) ? 'Memorium' : 'Unggah Foto' }}</h1>
    </div>

    {{-- ===================== --}}
    {{--   PESAN VALIDASI     --}}
    {{-- ===================== --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CATATAN: file upload harus diulang jika validasi gagal --}}
    
    {{-- ============================== --}}
    {{--   FORM INPUT / EDIT DATA FOTO --}}
    {{-- ============================== --}}
    <form
        action="{{ isset($photo) ? route('photos.update', $photo->id) : route('photos.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
    >
        @csrf

        {{-- Jika sedang edit, pakai method PUT --}}
        @if (isset($photo))
            @method('PUT')
        @endif
        <div class="first-row">
                <div class="title">
                {{-- 1. INPUT JUDUL FOTO --}}
                {{-- ===================== --}}
            <label for="title">Title:</label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', isset($photo) ? $photo->title : '') }}" id="title"
                placeholder="Let your memories be your guide"
            >
            </div>

        
            <div class="location">
                {{-- ======================= --}}
                {{-- 2. INPUT LOKASI FOTO --}}
                {{-- ======================= --}}
                {{-- 2. INPUT LOKASI FOTO --}}
                {{-- ======================= --}}
                <label for="location">Location:</label>
                <input 
                    type="text" 
                    name="location" 
                    value="{{ old('location', isset($photo) ? $photo->location : '') }}" id="location"
                >

            </div>
        </div>
        
        



        <div class="second-row" data-mode="{{ isset($photo) ? 'edit' : 'create' }}">
             <div class="message">
                        {{-- ========================= --}}
                        {{-- 3. INPUT PESAN / CATATAN --}}
                        {{-- ========================= --}}
                        {{-- 3. INPUT PESAN / CATATAN --}}
                        {{-- ========================= --}}
                        <textarea 
                name="message" 
                id="msg" 
                style="overflow:hidden; resize:none;" 
                rows="1"
            >{{ old('message', isset($photo) ? $photo->message : '') }}</textarea>

            <script>
                const textarea = document.getElementById('msg');

                const autoResize = () => {
                    textarea.style.height = 'auto'; // Reset height
                    textarea.style.height = textarea.scrollHeight + 'px'; // Set new height
                }

                // Trigger when user types
                textarea.addEventListener('input', autoResize);

                // Trigger on load if there's pre-filled content
                window.addEventListener('DOMContentLoaded', autoResize);
            </script>

                    
                    </div>
                <div class="photo">
            {{-- ==================== --}}
            {{-- 4. UPLOAD FOTO      --}}
            {{-- ==================== --}}
            {{-- 4. UPLOAD FOTO      --}}
            {{-- ==================== --}}


            {{-- Tampilkan foto lama jika sedang edit --}}
            @if (isset($photo) && $photo->photo_path)
                <img src="{{ asset('storage/' . $photo->photo_path) }}" width="100">
            @else
                     <label for="photo">Uppload Your Memories:</label>
                     <input type="file" name="photo">
            @endif
            

            </div>
            <div class="music-upload">
                {{-- ========================= --}}
                {{-- 5. UPLOAD FILE MUSIK     --}}
                {{-- ========================= --}}
                {{-- 5. UPLOAD FILE MUSIK     --}}
                {{-- ========================= --}}
                {{-- 5. UPLOAD FILE MUSIK     --}}
                {{-- ========================= --}}
                

                    {{-- Tampilkan musik lama jika ada --}}
                    @if (isset($photo) && $photo->music_path)
                        <small>Songs:</small> 
                        <audio controls>
                            <source src="{{ asset('storage/' . $photo->music_path) }}" type="audio/mpeg">
                            Browser Anda tidak mendukung pemutar audio.
                        </audio>
                        <input type="file" name="music" placeholder="Unggah musik baru (opsional)">
                    @else
                        <label for="music">This sounds like :</label>
                        <input type="file" name="music">
                    @endif
            
            </div>
               



        </div>
    
        
        <div class="intrc-btn">
            {{-- ========================= --}}
            {{-- 7. TOMBOL SUBMIT FORM    --}}
            {{-- ========================= --}}
            <button type="submit" class="btn-submit{{ isset($photo) ? 'btn-brown' : 'btn-red' }}">
                {{-- Tampilkan teks yang sesuai dengan konteks --}}
                @if (isset($photo))
                    Update Photo
                @else
                    Upload Photo
                @endif
            </button>
        </div>
        
    </form>

</body>
</html>
