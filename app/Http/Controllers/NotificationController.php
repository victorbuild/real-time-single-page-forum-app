<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;

class NotificationController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function index()
    {
      $read = auth()->user()->readNotifications()->get()==null ? []:NotificationResource::collection(auth()->user()->readNotifications()->get());
      $unread = auth()->user()->unreadNotifications()->get()==null ? []:NotificationResource::collection(auth()->user()->unreadNotifications()->get());
      return [
        'read' =>  $read,
        'unread' => $unread
      ];
    }

    public function markAsRead(Request $request)
    {
      auth()->user()->notifications()->where('id', $request->id)->get()->markAsRead();
    }
}
