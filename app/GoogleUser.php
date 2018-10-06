<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleUser extends Model
{
    protected $fillable = ['user_id', 'google_id', 'image_url'];

    public function user()
    {
        return User::all()->where('id', $this->user_id)->first();
    }
}
