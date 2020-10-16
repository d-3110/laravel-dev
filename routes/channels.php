<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{groupId}', function ($user, $groupId) {
    $group_user = App\GroupUser::where('group_id', $groupId)->get();
    foreach ($group_user as $val) {
        // id配列作成
        $id_list[] = $val->user_id;
    }
    return in_array($user->id, $id_list);
});