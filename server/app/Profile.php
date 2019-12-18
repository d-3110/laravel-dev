<?php

namespace App;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // テーブル名
    protected $table = 'profiles';

    // カスタムフィールド
    protected $appends = ['is_mine'];

    public function getIsMineAttribute()
    {
        // ログインユーザ取得
        $user = Auth::user();
        // APIからの場合は空であるため、その場合はfalse
        if(!empty($user)) {
            if ($this->user_id === $user->id) {
                // ログインユーザどうか
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

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
