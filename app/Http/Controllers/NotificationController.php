<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        try {
            Auth::user()->unreadNotifications->markAsRead();
            return redirect()->back()->with('success', 'All notifications have been marked as read.');
        } catch (\Exception $e) {
            // Handle the exception, e.g., log the error or provide an error message
            return redirect()->back()->with('error', 'An error occurred while marking notifications as read.');
        }
    }
    
    public function index()
    {
        try {
            $unreadNotifications = auth()->user()->unreadNotifications;
            $readNotifications = auth()->user()->readNotifications;

            return view('notifications', compact('unreadNotifications', 'readNotifications'));
        } catch (\Exception $e) {
            // Handle the exception, such as logging or returning an error response
            return view('error')->with('message', 'An error occurred while fetching notifications.');
        }
    }

    public function markAsRead($notification)
    {
        try {
            // Find the notification by its ID and mark it as read.
            $notification = Auth::user()->notifications()->find($notification);

            if ($notification) {
                $notification->markAsRead();
            } else {
                // Handle the case where the notification is not found
                return redirect()->back()->with('error', 'Notification not found');
            }

            // Redirect back to the URL specified in the notification data.
            return redirect($notification->data['action_url']);
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database errors) here
            return redirect()->back()->with('error', 'An error occurred while marking the notification as read');
        }
    }
}
