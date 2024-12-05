<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Enums\ResponseCodeEnum;
class ImageController extends Controller
{
    public function download_image(Request $request){

        try{
            return ImageService::download_image($request->file_name);

        }

        catch(\Exception $e){
            return $this->errorResponse('There is not a picture with this Name' , ResponseCodeEnum::Internal_Server_Error);
        }
    }
}
