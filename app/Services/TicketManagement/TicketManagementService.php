<?php

namespace App\Services\TicketManagement;
use App\Models\Asset;
use App\Models\Message;
use App\Models\Notification;
use App\Models\ticket;
use App\Models\User;
 class TicketManagementService{
    public function raise(){
        $user = auth()->user();
        $asset = Asset::where('status', 1)
        ->where('employeeid', $user->id)
        ->get();

        return[
         'user'=> $user->id,
         'asset'=> $asset,

        ];
    }
    public function submitticket($data){
        $loggeduser= Auth()->user();
        $ticket = new ticket();
        $ticket->name = $data->name;
        $ticket->email = $data->email;
        $ticket->message = $data->message;
        $ticket->sender = $loggeduser->id;
        $ticket->subject = $data->product;
        $ticket->save();

        $message = new Message();
        $message->message = $data->message;
        $message->ticket_id = $ticket->id;
        $message->sender = $ticket->name;
        $message->save();
        
        $user= User::where('role',1)->first();
        $loggeduser= Auth()->user();       
 
        $Notification = new Notification;
        $Notification->user_id = $user->id;
        $Notification->senderid = $loggeduser->id;
        $Notification->ticket_id = $ticket->id;
        $Notification->data = $message->message;
        $Notification->type = 'user request a token';
        $Notification->role = $user->role;
        $Notification->save();

        return $user;
    }
    public function displayticket(){
        $ticket = ticket::latest()->get();
        $message = Message::all();
    
        return  [
          'ticket' => $ticket,
          'message'=> $message,
        ];
    }
    public function showticket($id){
        $ticket = ticket::findorfail($id);
        $messages = Message::where('ticket_id', $ticket->id)->get();

        return [
      'ticket'=> $ticket,
      'messages'=> $messages,
        ];
    }
    public function replyticket($data,$id){
        $ticket = Ticket::findOrFail($id);
        $message = new Message();
        $message->ticket_id = $ticket->id;
        $message->sender = $ticket->name;
        $message->message = $data->message;
        $message->save();

        $user = User::where('role', 1)->first();
        $loggeduser = Auth()->user();

        $Notification = new Notification;
        $Notification->user_id = $user->id;
        $Notification->senderid = $loggeduser->id;
        $Notification->ticket_id = $ticket->id;
        $Notification->data = $message->message;
        $Notification->type = 'user replied';
        $Notification->role = $user->role;
        $Notification->save();

        return $user;
    }
public function admindisplayticket(){
    $ticket = ticket::latest()->get();
    $message = Message::all();

    return [
     'ticket'=> $ticket,
     'message'=> $message,
    ];
}
public function adminshowticket($id){

    $ticket = ticket::findorfail($id);
    $messages = Message::where('ticket_id', $ticket->id)->get();

    return  [
        'ticket'=> $ticket,
        'messages'=> $messages
    ];
}
public function ticketcloseticket($id){
    $ticket = ticket::findorfail($id);
    $ticket->status = 2;
    $ticket->save();
     return $ticket;

}
public function adminreplyticket($data,$id){
    $ticket = Ticket::findOrFail($id);
    $email = $ticket->email;
    $admin = User::where('role', 1)->first();

    $ticket->status = 1;
    $ticket->save();

    $message = new Message();
    $message->ticket_id = $ticket->id;

    $message->sender = $admin->name;
    $message->message = $data->message;
    $message->save();

    $user = User::where('email', $email)->first();
    $loggeduser = Auth()->user();

    $Notification = new Notification;
    $Notification->user_id = $user->id;
    $Notification->senderid = $loggeduser->id;
    $Notification->ticket_id = $ticket->id;
    $Notification->data = $message->message;
    $Notification->type = 'Admin replied';
    $Notification->role = $user->role;
    $Notification->save();

    return $user;
}
    
 }