<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;

class Photosaver
{

    /**
     * @param Request $request
     * @param string $key
     * @param string $path
     * @param string $disk
     * @return array|\Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|null
     */
    public static function savePhoto(Request $request, string $key, string $path = 'images', string $disk = 'public')
    {

        if ($request->has($key)) {
            $photo = $request->file($key);
            $photo = Storage::disk($disk)->putFile($path, $photo);
            return $photo;
        }
        return null;
    }

    public static function hello($greeting){
        return $greeting;
    }
}

class PhotosaverFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
       return 'photosave';
    }
}