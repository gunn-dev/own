<?php


namespace App\Helpers;


class Stringsplit
{
    public static function mm_split($string, $limit)
    {


        $exploded_strings = explode("။", $string);
        foreach ($exploded_strings as $exploded_string) {
//            dd($exploded_string);
            $tmp_arrays [] = [
                "body" => $exploded_string,
                "count" => strlen($exploded_string) + 1,
            ];
        }
        $block_words = 0;

        $array = [];
        $block = "";

        $i = 0;
        foreach ($tmp_arrays as $tmp_array) {
            if ($tmp_array['count'] <= $limit) {
                $block_words += $tmp_array['count'];
                if ($block_words <= $limit) {
                    $block .= $tmp_array['body'] . "။";
                } else {
                    array_push($array, $block);
                    $block = null;
                    $block_words = 0;
                }
            } else {
                array_push($array, $block);
                $block = null;
                $block_words = 0;
            }
            $i++;
        }

        if ($block != null) {
            array_push($array, $block);
            $block = null;
            $block_words = 0;
        }

        return $array;


//        print_r($arr2[0] . "။");
    }

    public static function combine($array)
    {
        $block = "";
        foreach ($array as $item) {
            $block .= $item;
        }
        return $block;

    }



}