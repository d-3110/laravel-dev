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
    /**
     * 選択された相手とすでにチャットしているかを判定する
     * @param  $user_id  [自分のuser_id]
     * @param  $partner_user_id  [相手のuser_id]
     * @return チャットをすでにしている相手の場合: 該当するgroup_idを返却
     *         チャットをしたことがない相手の場合: 0を返却
     */
    public static function haveChatted($user_id, $partner_user_id) {
        // すでにチャットしている相手かチェック
        $user = User::find($user_id);
        foreach ($user->group as $group) {
            $group_ids[] = ['group_id' => $group->pivot->group_id]; // 参加しているgroup_idリスト
        }
        foreach ($group_ids as $id) {
            foreach (Group::find($id['group_id'])->user as $user) {
                $current = $user->pivot;
                if ($current->user_id != $user_id &&       // 自分でない かつ
                    $current->user_id == $partner_user_id  // 選択した相手である
                ) {
                    return $id['group_id'];
                }
            }
        }
        return 0;
    }
}
