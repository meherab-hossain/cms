<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:posts',
            'image' => 'required',
            'body' => 'required',
        ]);

        $slugValue = $request->title;
        //get image
        $image = $request->file('image');
        $slug = str_slug($slugValue);

        //checking and creating the  image directory
        if (!Storage::disk('public')->exists('post')) {
            Storage::disk('public')->makeDirectory('post');
        }
        if (isset($image)) {
            //unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $postImage = Image::make($image)->resize(1600, 1046)->stream();

            Storage::disk('public')->put('post/' . $imageName, $postImage);


        } else {
            $imageName = "default.png";
        }

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;
        if($post->user->type=='admin'){
            $post->is_approved = true;
        }else{
            $post->is_approved = false;
        }


        $post->save();
        return redirect('post');
    }
    public function approval($id)
    {
        $post = Post::find($id);

        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();
            return redirect('post');
        }
    }
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }


    public function edit(Post $post)
    {
        if($post->user_id==Auth::id()|| auth()->user()->type == 'admin'){
            return view('post.edit', compact('post'));
        }else{
            //return view('error')->with('message','you dont have access to edit this file');
            return redirect('post')->with('message','you dont have access to edit this file');
        }

    }


    public function update(Request $request, Post $post)
    {
        /*$this->validate($request, [
            'title' => ['required','unique:posts'],
            'image' => 'required',
            'body' => 'required',
        ]);*/
        $validatedData = $request->validate([
            'title' => ['required','unique:posts'],
            'image' => 'required',
            'body' => 'required',
        ]);
        if($post->user_id==Auth::id()|| auth()->user()->type == 'admin') {
            if ($validatedData) {

                //get image
                $image = $request->file('image');
                $slug = str_slug($request->title);


                if (isset($image)) {
                    //unique name for image
                    $currentDate = Carbon::now()->toDateString();
                    $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                    //checking and creating the  image directory
                    if (!Storage::disk('public')->exists('post')) {
                        Storage::disk('public')->makeDirectory('post');
                    }
                    if (Storage::disk('public')->exists('post/' . $post->image)) {
                        Storage::disk('public')->delete('post/' . $post->image);
                    }
                    //post image resize and saved in the directory
                    $postImage = Image::make($image)->resize(1600, 1046)->stream();
                    Storage::disk('public')->put('post/' . $imageName, $postImage);


                } else {
                    $imageName = "default.png";
                }

                $post->title = $request->title;
                $post->user_id = Auth::id();
                $post->slug = $slug;
                $post->image = $imageName;
                $post->body = $request->body;
                if ($post->user->type == 'admin') {

                    $post->is_approved = true;
                }

                $post->save();
                return redirect('post');
            }
        }else{
            return redirect('post')->with('message','you dont have access to update this file');
        }
    }


    public function destroy(Post $post)
    {
        //|| auth()->user()->type == 'admin'
        if($post->user_id==Auth::id()){
            if (Storage::disk('public')->exists('post/'.$post->image)) {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            $post->delete();
            return redirect()->back();
        }else{
            return redirect('post')->with('message','you dont have access to delete this file');
        }


    }
}
