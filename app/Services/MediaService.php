<?php

namespace App\Services;

use App\DTO\MediaDto;
use App\Models\Image;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaService
{

    public function all()
    {
        return Media::all()->sortByDesc('id');
    }

    public function findById($id)
    {
        return Media::findOrfail($id);
    }

    public function create(MediaDto $dto)
    {
        //dd($dto);

        $media = Media::create($dto->toArray());

        // save image if exist
        if ($dto->image != null) {

            $file_name = $dto->image->hashName();

            $path = $dto->image->storeAs('public/medias',$file_name);

            Image::create([
                'url' => $file_name,
                'imageable_id' => $media->id,
                'imageable_type' => 'App\\Models\\Media',
            ]);
        }

        return $media;
    }

    public function update(Media $media, MediaDto $dto)
    {
        // image updated?
        if ($dto->image != null) {

             // delete its records
            Storage::delete('public/medias/'.$media->image->url);
            Image::destroy($media->image->id);

            //save another image
            $file_name = $dto->image->hashName();

            $path = $dto->image->storeAs('public/medias',$file_name);

            Image::create([
                'url' => $file_name,
                'imageable_id' => $media->id,
                'imageable_type' => 'App\\Models\\Media',
            ]);
        }

        return $media->update($dto->toArray());
    }

    public function destroy($id)
    {
        $media = Media::findOrfail($id);

        if($media->image != null)
        {
            Storage::delete('public/medias/'.$media->image->url);

            // delete its records

            Image::destroy($media->image->id);
        }
        return Media::destroy($id);
    }
}
