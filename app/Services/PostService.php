<?php

namespace App\Services ;
use App\Models\Post;
use App\Models\User;


class PostService{

    public static function addPost($user_id,$title, $content, $if_publish){

        $user= User::findOrFail($user_id);
        if($if_publish){
            $published_at = now();
        }
        else{
            $published_at= null;
        }
        $post= $user->posts()->create([
            'title'=>$title,
            'content'=>$content,
            'if_publish'=>$if_publish,
            'published_at'=>$published_at
        ]);

        return $post;

    }


    public static function UpdateById($id,$title, $content){

        $post = Post::findOrFail($id);
        $post->update([
            'title'=>$title,
            'content'=>$content,
        ]);
        return $post;

    }


    public static function deleteById($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return true;


    }

    public static function publishedById($id){
        $post = Post::findOrFail($id);
        $post->update([
            'if_publish'=>true,
            'published_at'=> now()
        ]);
        return $post;

    }
    public static function unpublishedById($id){
        $post = Post::findOrFail($id);
        $post->update([
            'if_publish'=>false,
            'published_at'=> null
        ]);
        return $post;

    }


    public static function getAll($title){
        $query= Post::query();
        $query->where('if_publish',true);
        $query->when($title !=null, function ($q)use($title) {
            $q->where('title','like','%'. $title . '%');
        });

        $posts = $query->orderBy('created_at','DESC')->get();
        return $posts;

    }

    public static function get_all_by_user_id($user_id, $title){

        $query= Post::query();
        $query->where(['if_publish'=>true, 'user_id'=>$user_id]);
        $query->when($title !=null, function ($q)use($title) {
            $q->where('title','like','%'. $title . '%');
        });

        $posts = $query->orderBy('created_at','DESC')->get();
        return $posts;


    }

//     $toys = Toy::orderBy('created_at','DESC')->get();
// }
// else{
//     $query = Toy::query();



}
