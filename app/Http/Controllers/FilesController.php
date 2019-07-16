<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class FilesController extends Controller
{
    //
    public function getDownload($file_name){
        $pathToFile=storage_path()."/app/public/cover_images/".$file_name;
        //Lab 6_1557083274.pdf
        return Response::download($pathToFile);
    }
}
