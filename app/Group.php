<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GroupUser;

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
    public static function validGroup($group_id, $user_id)
    {
        $group = Group::where('groups.id', $group_id);
        // 存在チェック
        if (!$group->exists()) {
            return false;
        }

        $group_user = GroupUser::where('group_id', $group_id)->get();
        foreach ($group_user as $user) {
            // id配列作成
            $id_list[] = $user->user_id;
        }

        // 参加しているグループかチェック
        if (!in_array($user_id, $id_list)) {
            return false;
        }

        return true;
    }
}
