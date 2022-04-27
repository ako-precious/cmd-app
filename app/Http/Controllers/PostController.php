<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $name =  auth()->user()->name;
        $posts = Post::where("user", "=", $name)->get();
        return $posts;
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'status' => 'required',
            'user' => 'required'
        ]);
        return Post::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $name =  auth()->user()->name;
       $post = Post::where([
            ['id','=', $id],
            ["user", "=", $name]])
            ->get();
            
            if ($post->isEmpty()) {
                 return response([
                'message' => 'You can not view another user post',
            ],401);
            }
        return $post;
        // return Post::find($id);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name =  auth()->user()->name;
        $post = Post::where([
            ['id','=', $id],
            ["user", "=", $name]])
            ->update($request->all());
            
            if($post){
                return $post;
                
            }else{
                return response([
                'message' => 'You can not edit another user post or the post does not exist',
            ],401);
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name =  auth()->user()->name;
        $post = Post::where([
            ['id','=', $id],
            ["user", "=", $name]])
            ->delete();
            
            if ($post) {
                return response([
                'message' => 'Your post has been deleted',
            ],201);
            }
            else{
                return response([
                'message' => 'You can not delete another user post or the post does not exist',
            ],401);
            }
        return $post;
        
    }
}
