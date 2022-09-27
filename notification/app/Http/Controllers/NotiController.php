<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

class NotiController extends Controller
{

    public function index()
    {
        $user = User::find(1);
        foreach ($user->unreadNotifications as $notification) {
            echo ( $notification->id);
        }
        $user->notify((new InvoicePaid())->delay(2));
       // Notification::send($user,new InvoicePaid());
    }
}
