<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $guarded = ['id'];

    // グループ
    public function group()
    {
        return $this->belongsTo('App\group');
    }
}
