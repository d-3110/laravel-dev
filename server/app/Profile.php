<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // テーブル名
    protected $table = 'Profiles';

    // IDが自動増分されない場合
    // public $incrementing = false;

    // 主キーが整数でない場合
    // protected $keyType = 'string';

    // 複数代入させない属性　主キー
    protected $guarded = array('id');

    // 自動でタイムスタンプ付与
    public $timestamps = true;

    // 複数代入する属性
    // Factoryでinsertを許可するカラム
    protected $fillable = [];

    Public function user()
    {
      return $this->belongsTo('App\User');
    }
}
