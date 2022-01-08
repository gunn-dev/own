<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return string[]
     */
    public function index(Request $request): array
    {
        $arr = ['one', 'two', 'three', 'four', 'five'];

        $one = $arr[0];
        $two = $arr[1];
        $three = $arr[2];
        $four = $arr[3];
        $five = $arr[4];


        $arr = ['one', 'two', 'three'];

        $first = $arr[0];
        $second = $arr[1];
        $third = $arr[2];

        return $arr;
    }
}
