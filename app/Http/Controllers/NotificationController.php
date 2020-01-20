<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function nbNotification() {
        return view('ajaxView.users.nbNotification');
    }

    public function recupNotification() {
        return view('ajaxView.users.notifications');
    }
}
