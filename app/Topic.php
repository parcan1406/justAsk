<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $fillable = ['name', 'description'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
