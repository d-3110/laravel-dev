<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Message;

class ChatController extends Controller
{
    // public function index() {
    //     return view('chat/chat');
    // }
    public function show($group_id) {
        $user_id = Auth::id();
        return view('chat/chat', compact('group_id', 'user_id'));
    }
}
