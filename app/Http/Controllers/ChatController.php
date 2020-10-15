<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Message;
use App\Group;

class ChatController extends Controller
{
    public function show($group_id) {
        $user_id = Auth::id();
        
        // 入れるグループかどうか
        if (!Group::validGroup($group_id, $user_id)) {
            return redirect('groups');
        }

        return view('chat/chat', compact('group_id', 'user_id'));
    }
}
