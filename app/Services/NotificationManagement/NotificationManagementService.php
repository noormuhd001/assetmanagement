<?php

namespace App\Services\NotificationManagement;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

Class NotificationManagementService{
public function markAsRead($id){
    $notification = Notification::findOrFail($id);
    $notification->update(['read_at' => now()]);

    return $notification;
}
public function notificationCount(){
    $user = Auth::user();
    return $user;
}
}