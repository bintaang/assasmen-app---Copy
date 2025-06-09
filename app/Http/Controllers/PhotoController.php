<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('index', compact('photos'));
    }

    public function create()
    {
        return view('Input');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',   
            'message' => 'required',
            'photo' => 'required|image',
            'music' => 'nullable|file|mimes:mp3,wav,m4a|max:10000', 
            'music_url' => 'nullable|url',
        ]);

        $photoPath = $request->file('photo')->store('photos', 'public');
        $musicPath = $request->hasFile('music') ? $request->file('music')->store('music', 'public') : null;

        Photo::create([
            'title' => $request->title,
            'location' => $request->location,
            'message' => $request->message,
            'photo_path' => $photoPath,
            'music_path' => $musicPath,
            'music_url' => $request->music_url,
        ]);

        return redirect()->route('photos.index')->with('success', 'Photo berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
          return view('detail', compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('Input', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
        'title' => 'required',
        'location' => 'required',
        'message' => 'required',
        'photo' => 'nullable|image|max:2048',
        'music' => 'nullable|mimes:mp3,wav|max:5120',
        'music_url' => 'nullable|url',
    ]);

    // Pastikan setidaknya ada file musik atau link musik
    if (!$request->music && !$request->music_url && !$photo->music_path && !$photo->music_url) {
        return back()->withErrors(['music' => 'Harus mengisi file musik atau link musik'])->withInput();
    }

    // Update image jika ada upload baru
    if ($request->hasFile('photo')) {
                // Hapus file lama jika ada
            if ($photo->photo_path) {
            Storage::disk('public')->delete($photo->photo_path);
        }
        $photoPath = $request->file('photo')->store('photos', 'public');
        $photo->photo_path = $photoPath;

    }

    // Update musik
    if ($request->hasFile('music')) {
        // Hapus file musik lama jika ada
        if ($photo->music_path) {
            Storage::disk('public')->delete($photo->music_path);
        }
        // Set file musik baru, dan kosongkan link musik karena prioritas file
        $photo->music_path = $request->file('music')->store('music', 'public');
        $photo->music_url = null;
    } elseif ($request->music_url) {
        // Kalau input link musik, hapus file musik lama jika ada
        if ($photo->music_path) {
            Storage::disk('public')->delete($photo->music_path);
            $photo->music_path = null;
        }
        $photo->music_url = $request->music_url;
    } 
    // Kalau tidak upload file baru dan tidak input url baru,
    // biarkan data musik yang lama tetap

    // Update field lain
    $photo->title = $request->title;
    $photo->location = $request->location;
    $photo->message = $request->message;

    $photo->save();

    return redirect()->route('photos.index')->with('success', 'Foto berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        // Hapus file foto jika ada
        if ($photo->photo_path) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        // Hapus file musik jika ada
        if ($photo->music_path) {
            Storage::disk('public')->delete($photo->music_path);
        }

        // Hapus data dari database
        $photo->delete();

        return redirect()->route('photos.index')->with('success', 'Foto berhasil dihapus');
    }
}
