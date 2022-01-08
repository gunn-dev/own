<?php
/**
 * Created by PhpStorm.
 * User: bp
 * Date: 11/30/19
 * Time: 4:44 PM
 */

if (!function_exists('uni_zaw')) {
    function uni_zaw($message, $bot)
    {
        $id = $bot->getUser()->getId();
        $type = $bot->userStorage()->find($id);
        if ($type['font_type'] == 'unicode') {
            return $message;
        } elseif ($type['font_type'] == 'zawgyi') {
            return Rabbit::uni2zg($message);
        }else{
            return $message;
        }
    }
}



if (!function_exists('getLang')) {
    function getLang($lang, $text)
    {
       if( $lang == 'unicode'){
           return $text;
       }elseif ( $lang == 'zawgyi' ){
           return Rabbit::uni2zg($text);
       }
    }
}

if (!function_exists('getName')) {
    function getName($id)
    {
        $user = \App\Models\Subscription::where('user_id', $id)->first();
        return isset($user->name) ? $user->name.'('.$id.')' : '__'.'('.$id.')';
    }
}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);
            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

