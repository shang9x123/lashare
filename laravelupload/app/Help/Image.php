<?php

namespace App\Help;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Image
{
    public static function UploadImage($image, $random = 0, $disk = 'public')
    {
        if ($image != '') {
            $input = $image->getClientOriginalName();
            $day = Carbon::now()->day;
            $year = Carbon::now()->year;
            $month = Carbon::now()->month;
            $hours = Carbon::now()->hour; //giờ
            $minute = Carbon::now()->minute; //phút
            $second = Carbon::now()->second; //giây
            $filename = $input;
            $path = $year . '/' . $month . '/' . $day . '/' . $filename;
            $exists = Storage::disk($disk)->exists($path);
            if ($exists) {
                if ($random > 0) {
                    $filename = rand(0, $random) . '_' . $input;
                }
                $path = $year . '/' . $month . '/' . $day . '/' . $hours . $minute . $second  . $filename;
            }
            $store = Storage::disk($disk)->put($path, file_get_contents($image));
            if ($store) {
                $link_save = Storage::disk('public')->url($path);
            } else {
                $link_save = '';
            }
            return $link_save;
        } else {
            return '';
        }

    }
}
