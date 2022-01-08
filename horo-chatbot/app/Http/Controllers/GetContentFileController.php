<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class GetContentFileController extends Controller
{
    public function getContentFile(Request $request)
    {

        $path = public_path() . '/uploads/files/' . $request->name;

        return response()->file($path);
    }
}
