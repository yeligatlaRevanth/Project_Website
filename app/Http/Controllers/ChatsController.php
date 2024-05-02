<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class ChatsController extends Controller
{
    //Below functions are for chat
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function displayMessages()
    {

        $users = User::where('id', '!=', auth()->id())->get();

        return view('a8_userMessages', [ 'users' => $users]);
    }

    public function fetchMessages($userId)
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $user = User::findOrFail($userId); // Find the specified user
        $messages = $user->messages; // Fetch messages related to the specified user
        error_log($messages);
        return view('a8_userMessages', ['messages' => $messages, 'users' => $users]);
    }



    public function sendMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'message' => 'required|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create a new message
        $message = new Message();
        $message->user_id = $user->id;
        $message->message = $request->input('message');
        $message->save();

        // Broadcast the message using Pusher
        broadcast(new MessageSent($user, $message))->toOthers();

        // Return a response
        return response()->json(['message' => $message]);
    }
}
