<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadImg(Request $request){
        //return($request);
        $file = $request->file('img');
        $destination = 'public/imgs';
        $path = $file->store($destination);  
        
        return ['url'=>'http://'.$request->getHttpHost().Storage::url($path),
                'link'=>'http://'.$request->getHttpHost().Storage::url($path)];
    }
}
