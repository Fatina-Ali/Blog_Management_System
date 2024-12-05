<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $url = $request->getHttpHost();
        return [
            'id'=>$this->id,
            'userName' =>$this->user_name,
            'firstName'=>$this->first_name,
            'lastName'=>$this->last_name,
            'email'=>$this->email,
            'password'=>$this->password,
            'profilePhoto'=>"$url/api/image/download?file_name=" . $this->profile_photo,
            'accessToken'=>$this->accessToken,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
