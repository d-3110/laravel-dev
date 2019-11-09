<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // テーブル名
    protected $table = 'users';

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
    protected $fillable = ['email', 'password', 'dept_id', 'job_id', 'is_admin'];

    // deptモデルが親
    public function dept()
    {
        return $this->belongsTo('App\Dept');
    }
    // jobモデルが親
    public function job()
    {
        return $this->belongsTo('App\Job');
    }

    // 1対1
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // セレクトボックス作成用(depts jobs)
    public static function getArraySelectBox()
    {
        $depts = Dept::get(['id','name'])->toArray();
        // formファザード用に配列を整形
        foreach ($depts as $key => $dept) {
            $depst_list[$dept['id']] = $dept['name'];
        }

        $jobs = Job::get(['id','name'])->toArray();
        // formファザード用に配列を整形
        foreach ($jobs as $key => $job) {
            $job_list[$job['id']] = $job['name'];
        }
        return [$depst_list, $job_list];
    }

    // 一覧での検索
    public static function indexSearch($keyword)
    {
        // クエリ生成
        $query = User::query();
        // キーワードがあったら
        if(!empty($keyword)) {
          $query->join('profiles', 'users.id', '=', 'profiles.user_id')->where('email','like','%'.$keyword.'%')->orWhere('profiles.name','like','%'.$keyword.'%');
        }
        $users = $query->orderBy('users.id','asc')->paginate(10);
        return $users;
    }
}
