<?php

namespace App\Services ;
use Illuminate\Support\Facades\Storage;


class ImageService{


    public  static function upload_image($image){
        $name= $image->hashname();
        $image->storeAs('images',$name);
        return $name;

    }


    ///// download image
    public static function download_image($name){

        return Storage::download("//images//" .$name);

    }
}
