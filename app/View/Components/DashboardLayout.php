<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class DashboardLayout extends Component
{
   public $title;

   
 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
       
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
         
        $user = Auth::user();
        
        //$notifications = Notification::latest()->take(5)->get();
        $notifications = $user->notifications->take(10);
        $unreadnotifications = $notifications->where('read_at',null)->count();

       // dd($unreadnotifications);
        
      //  dd($notifications);
       
        return view('layouts.dashboard',[
                'notifications'=> $notifications,
                'unreadnotifications'=>$unreadnotifications
        ]);
    }
}
