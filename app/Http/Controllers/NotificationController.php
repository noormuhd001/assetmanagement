<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationManagement\NotificationManagementService;

class NotificationController extends Controller
{
    private $notificationManagementService;

    public function __construct(NotificationManagementService $notificationManagementService)
    {

        $this->notificationManagementService = $notificationManagementService;
    }
    public function markAsRead($id)
    {
        try {
            $notification = $this->notificationManagementService->markAsRead($id);

            if ($notification) {
                return response()->json(['message' => 'Notification marked as read.']);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function notificationCount()
    {
        try {
            $user = $this->notificationManagementService->notificationCount();

            if ($user->role == 1) {
                $messageCount = Notification::where('role', 1)
                    ->whereNull('read_at')
                    ->count();
            } else {
                $messageCount = Notification::where('user_id', $user->id)
                    ->whereNull('read_at')
                    ->count();
            }
            return response()->json(['messageCount' => $messageCount]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
    public function notifications()
    {
        try {
            $user = auth()->user();
            if ($user->role == 0) {
                //geting messages from role  = 1
                $notification = Notification::where('role', 0)->where('user_id', $user->id)->latest()->get();
            } else {
                //getting messages from role =0
                $notification = Notification::where('role', 1)->latest()->get();
            }

            return view('notification.show', ['notification' => $notification, 'user' => $user]);
        } catch (\Exception $e) {
            report($e);
            return abort(500);
        }
    }
}
