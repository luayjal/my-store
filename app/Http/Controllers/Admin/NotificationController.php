<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markRead(Request $request){

     
         
        $user = Auth::user();
        
        //$notifications = Notification::latest()->take(5)->get();
        $notification = $user->notifications->where('id',$request->id)->first();
      // return $request;
        $notification->markAsRead();
        return redirect()->back();
    }
}
