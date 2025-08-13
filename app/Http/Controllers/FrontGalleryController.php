<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\Client;
use App\Models\PageBanner;
use Illuminate\Http\Request;

class FrontGalleryController extends Controller
{
public function index()
{
    $albums = GalleryAlbum::with('galleryMedia')->paginate(9);
    $pageBanner = PageBanner::where('page', 'gallery')->first();

    return view('frontend.gallery-album', compact('albums', 'pageBanner'));
}





    public function showClient($id)
    {
        $albums = GalleryAlbum::with(['galleryMedia', 'client'])->where('client_id', $id)->get();



        if (!$albums) {
            return response()->json(['message' => 'Album not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => $albums
        ]);
    }

    public function getAllData()
    {

        $galleryAlbums = GalleryAlbum::with(['galleryMedia', 'client'])->get();
        if ($galleryAlbums->isEmpty()) {
            return response()->json(['message' => 'No albums found'], 404);
        }
        $albums = $galleryAlbums;
        return response()->json([
            'success' => true,
            'message' => $albums
        ]);
    }

   public function show($id)
{
    $galleryAlbum = GalleryAlbum::with('galleryMedia')->find($id);

    $pageBanner = PageBanner::where('page', 'gallery')->first();
    if (!$pageBanner || $pageBanner->image == null) {
        $pageBanner = PageBanner::where('page', 'all')->first();
    }

    if (!$galleryAlbum) {
        return response()->json(['message' => 'Album not found'], 404);
    }

    return view('frontend.gallery-media', compact('galleryAlbum', 'pageBanner'));
}

public function showBySlug($slug)
{
    $galleryAlbum = GalleryAlbum::where('slug', $slug)->with('galleryMedia')->first();

    $pageBanner = PageBanner::where('page', 'gallery')->first();
    if (!$pageBanner || $pageBanner->image == null) {
        $pageBanner = PageBanner::where('page', 'all')->first();
    }

    if (!$galleryAlbum) {
        return response()->json(['message' => 'Album not found'], 404);
    }

    return view('frontend.gallery-media', compact('galleryAlbum', 'pageBanner'));
}



}
