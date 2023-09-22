<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class UpdateNotificationsController extends Controller
{
    public function updateNotifications()
    {
       

        Notification::where([
            ['etat', '=', 'unread'],
            ['id_user', '=', Session::get('loginID')]
          ])->update(['etat' => 'read']);
          

    }
}
