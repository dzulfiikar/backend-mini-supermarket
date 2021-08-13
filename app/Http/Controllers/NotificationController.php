<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationReadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        return response()->json([
            'status'=> 'success',
            'data' => $user->notifications
        ], 200);
    }

    public function showUnreadNotifications(){
        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'data' => $user->unreadNotifications
        ], 200);
    }

    public function setNotificationRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json([
            'status' => 'success',
            'data' => []
        ], 200);
    }
}
