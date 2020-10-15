<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded = ['id'];

    // 多対多
    public function User()
    {
        return $this->belongsToMany('App\User');
    }
    // メッセージ
    public function Message()
    {
        return $this->hasMany('App\Message');
    }
}
