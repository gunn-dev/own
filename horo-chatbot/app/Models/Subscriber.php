<?php

namespace App\Models;

use BotMan\Drivers\Facebook\Extensions\User;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $guarded = [];

    public static function getTimezone(User $user)
    {
        $fp = fopen('timezone.txt', 'w');
        fwrite($fp, $user->getTimezone().  $user->getFirstName() );
        fclose($fp);
        Subscriber::create([
            'fb_id' => $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'profile_pic' => $user->getProfilePic(),
            'locale' => $user->getTimezone(),
            'gender' => $user->getGender(),
        ]);
    }
}
