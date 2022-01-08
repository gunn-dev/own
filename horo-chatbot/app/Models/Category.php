<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class);
    }

    public function grandchildren()
    {
        return $this->childs()->with('grandchildren');
    }

    public function content(){
        return $this->hasMany('App\Models\Content');
    }

    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }
}
