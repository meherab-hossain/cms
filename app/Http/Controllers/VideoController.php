<?php

namespace App\Http\Controllers;

use App\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Collection;
use function PHPSTORM_META\map;

class VideoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index()
    {
        $videos=Video::all();
        $videos=$videos->collect()->map(function ($item) {
            $item->video=$this->YoutubeID($item->video);
            return $item;
        });
        return view('video.index',compact('videos'));
    }


    public function create()
    {
        return view('video.create');
    }


    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request,[
           'title'=>'required',
           'video'=>'required',
           'type'=>'required'
        ]);
        $video=new Video();
        $video->title=$request->title;
        $video->user_id=Auth::id();
        $video->video=$request->video;
        $video->type=$request->type;
        if($video->user->type=='admin'){
            $video->is_approved = true;
        }else{
            $video->is_approved = false;
        }
        $video->save();
        return redirect()->route('video.index');

    }

    function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }


    public function show(Video $video)
    {
        $video->video=$this->YoutubeID($video->video);
        return view('video.show',compact('video'));
    }
    public function approval($id)
    {
        $video = Video::find($id);

        if ($video->is_approved == false) {
            $video->is_approved = true;
            $video->save();
            return redirect()->route('video.index');
        }
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
