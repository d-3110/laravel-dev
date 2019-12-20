<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaidHoliday extends Model
{
    // テーブル名
    protected $table = 'paid_holidays';

    // カスタムフィールド
    protected $appends = ['status_name'];

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

    public function getStatusNameAttribute()
    {
        return config('holidaystatus.'.$this->status);
    }
}
