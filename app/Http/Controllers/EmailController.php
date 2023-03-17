<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendEmail(User $user)
    {
      $user->notify(new EmailNotification());
    }
}
