<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function lang(Request $request)
    {
        $lang = $request->lang;
        switch ($lang){
            case 'vi':
                $language = 'vi';
                break;
            default:
                $language = 'en';
                break;
        }
        Session::put('lang',$language);
        return redirect()->back();
    }
}
