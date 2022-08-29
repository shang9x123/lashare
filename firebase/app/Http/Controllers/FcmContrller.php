<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class FcmContrller extends Controller
{
    public function index()
    {
        return view('fcm');
    }
    public function runfcm(Request $request)
    {
        $fac = (new Factory())->withServiceAccount(resource_path('fir-lashare-firebase-adminsdk.json'));
        $mess = $fac->createMessaging();
        $message = CloudMessage::fromArray([
            'token'=>$request->token,
            'data' =>[
                'url'=>$request->link,
                'title'=>$request->title,
                'body'=>$request->body,
                'image'=>$request->image,
            ]
        ]);
        $mess->send($message);
        return back();
    }
}
