<?php

namespace App\Livewire;

use App\Models\chat_mesage;
use Livewire\Component;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSend;

class Chat extends Component
{
    public $users;
    public $messageText;
    public $messages;
    public $selectedUser;
    public $loginID;
    public function mount()
    {
        $this->users = User::whereNot("id", Auth::id())->latest()->get();
        $this->selectedUser = $this->users->first();
        $this->loginID = Auth::id();
       
        $this->loadMessages();
    }
    public function selectUser($id)
    {
        $this->selectedUser = User::find($id);
        $this->loadMessages();
    }
    public function loadMessages()
    {
        $this->messages = chat_mesage::where(function ($q) {
            $q->where('sender_id', Auth::id())
                  ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($q) {
            $q->where('sender_id', $this->selectedUser->id)
                  ->where('receiver_id', Auth::id());
        })->get();
    }
    public function submit()
    {
        if (!$this->messageText) return;
        $messages = chat_mesage::create([
            "sender_id" => Auth::id(),
            "receiver_id" => $this->selectedUser->id,
            "message" => $this->messageText,
        ]);
        $this->messages->push($messages);

        $this->messageText = '';
        
        broadcast(new MessageSend($messages));
    }
    public function updatedMessageText($value)
    {
        $this->dispatch("userTyping", userID: $this->loginID, userName: Auth::user()->name, selectedUserID: $this->selectedUser->id);
    }   

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->loginID},MessageSend" => "newChatMessageNotification"
        ];
    }
    public function newChatMessageNotification($message)
    {
        if ($message['sender_id'] == $this->selectedUser->id) {
           $messageObj = chat_mesage::find($message['id']);
           $this->messages->push($messageObj);
        }
    }
    public function render()
    {
        return view('livewire.chat');
    }
}
