<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Http\Requests\CheckPostIdRequest;
use App\Http\Requests\DeletePostRequest;
use App\Http\Requests\GetPostsRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;
use App\Enums\ResponseCodeEnum;

class PostController extends Controller
{
    public function add(AddPostRequest $request){

        try{
            $user_id= auth()->user()->id;
            $res = PostService::addPost($user_id,$request->title, $request->content,$request->if_publish);
            return $this->successResponse(new PostResource($res));
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }


    }

    public function update_by_id(UpdatePostRequest $request, $id){
        $res= PostService::UpdateById($id, $request->title, $request->content);

        return $this->successResponse(new PostResource($res));
    }

    public function delete_by_id($id, CheckPostIdRequest $request){

        try{
            $res= PostService::deleteById($id);
            return $this->successResponse([],'Deleted Successfully');
        }
        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }


    public function published_by_id($id, CheckPostIdRequest $request){
        try{
            $res= PostService::publishedById($id);
            return $this->successResponse(new PostResource($res), 'Published Successfully');
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }



    public function unpublished_by_id($id, CheckPostIdRequest $request){
        try{
            $res= PostService::unpublishedById($id);
            return $this->successResponse(new PostResource($res), 'UnPublished Successfully');
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }

    

    public function get_all(GetPostsRequest $request){

        try{
            $res= PostService::getAll($request->title);
            return $this->successResponse(PostResource::collection($res));
        }

        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }


    public function get_all_by_user_id(GetPostsRequest $request){

        try{
            $user_id = auth()->user()->id;
            $res= PostService::get_all_by_user_id($user_id, $request->title);
            return $this->successResponse(PostResource::collection($res));
        }
        catch(\Exception $e){
            return $this->errorResponse('An unexpected error occurred' , ResponseCodeEnum::Internal_Server_Error);
        }
    }
}



