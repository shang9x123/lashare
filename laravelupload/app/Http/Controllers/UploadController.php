<?php

namespace App\Http\Controllers;

use App\Help\Image;
use App\Http\Requests\StoreUploadRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StoreUploadRequest $request)
    {
            $image = $request->image;
            $anh = Image::UploadImage($image);
            $data['status'] = true;
            $data['url'] = $anh;
        return response()->json($data);
    }
}
