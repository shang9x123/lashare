<?php

namespace App\Http\Controllers;

use App\Jobs\DemoJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DemoController extends Controller
{
    public function index()
    {
        for ($i= 0 ;$i<500;$i++)
        {
            $job = (new DemoJob($i))->delay(Carbon::now()->addSecond(30));
            $this->dispatch($job);
        }
    }
}
