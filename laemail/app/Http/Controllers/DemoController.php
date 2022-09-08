<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    public function index()
    {
        return view('email');
    }
    public function sendmail(Request $request)
    {
        $data['title'] ='Demo Email';
        $data['content'] = 'Đây là test';
        //Mail::to($request->email)->send(new DemoEmail($data));
        \App\Jobs\DemoEmail::dispatch($data,$request->email)->delay(now()->addSeconds(5));
        return redirect(route('email'))->with(['msg'=>'Đã gửi email thành công']);
    }
}
