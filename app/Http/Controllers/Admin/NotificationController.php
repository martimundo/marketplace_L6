<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.nofitications', compact('unreadNotifications'));
    }

    public function readAll()
    {

        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadNotifications->each(function ($notifications) {
            $notifications->markAsRead();
        });

        flash("Notificações Lidas Com sucesso")->success();
        return redirect()->back();
    }

    public function read($notification){

        $notification = auth()->user()->notifications()->find($notification);

        $notification->markAsRead();
       
       flash("Mensagem Lida Com sucesso")->success();
       return redirect()->back();
    }
}
