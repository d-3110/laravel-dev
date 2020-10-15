<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\Group;
use App\Events\MessageCreated;

class ChatController extends Controller
{
    public function show($id) {
        $messages = Message::join('profiles', 'messages.user_id', '=', 'profiles.user_id')
                           ->where('group_id', $id)
                           ->orderBy('messages.id', 'asc')->get();
        return $messages;
    }
    
    public function create(Request $request) {
        $message = \App\Message::create([
            'body' => $request->message,
            'group_id' => $request->group_id,
            'user_id' => $request->user_id
        ]);
        // 登録されたらイベントが実行
        // app/Events/MessageCreated.php
        event(new MessageCreated($message));
    }
}
