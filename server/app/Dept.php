<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    // テーブル名
    protected $table = 'Depts';

    // 複数代入させない属性　主キー
    protected $guarded = array('id');

    // 自動でタイムスタンプ付与
    public $timestamps = true;

    // Userモデルが子テーブル
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
