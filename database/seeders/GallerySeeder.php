<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryAlbum;
use App\Models\GalleryMedia;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the "License and Certificates" album
        $album = GalleryAlbum::updateOrCreate(
            ['title' => 'License and Certificates'],
            [
                'type' => 'image',
                'client_id' => null, // no client
            ]
        );

        // Gallery items for this album
        $items = [
            'Company-Registration.jpg',
            'Authorized-Certificate-From-Government.jpg',
            'License.jpg',
            'Pan-Certificate.jpg',
            'Authorized-Certificate-From-Japan.jpg',
            'Rba-Participation.jpg',
        ];

        foreach ($items as $path) {
            GalleryMedia::updateOrCreate(
                ['gallery_album_id' => $album->id, 'media_path' => "assets/images/gallery/{$path}"],
                [
                    'gallery_album_id' => $album->id,
                    'media_path' => "assets/images/gallery/{$path}",
                ]
            );
        }
    }
}
