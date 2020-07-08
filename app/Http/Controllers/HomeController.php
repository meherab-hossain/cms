<?php

namespace App\Http\Controllers;

use App\Post;
use App\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos=Video::where('is_approved' ,'=', true)->get();
        $posts=Post::where('is_approved' ,'=', true)->get();

        //section-one
        $section1Videos=$videos->collect()->map(function ($item){
            if($item->type=='section1'){
                //img.youtube.com/vi/" + vid + "/0.jpg
                $item['url']=$item->video;
                $item->video='//img.youtube.com/vi/'.$this->YoutubeID($item->video).'/0.jpg';
                return $item;
            }
        });
        $section1Posts=$posts->collect()->map(function ($item){
           if($item->type=='section1'){
               return $item;
           }
        });

        //section-two
        $section2Videos=$videos->collect()->map(function ($item){
            if($item->type=='section2'){
                $var=$item->video;
                $item->video='//img.youtube.com/vi/'.$this->YoutubeID($item->video).'/0.jpg';
                $item['url']=$var;
                return $item;
            }
        });
        $section2Posts=$posts->collect()->map(function ($item){
            if($item->type=='section2'){
                return $item;
            }
        });

        $commonItems=collect($section1Posts);
        $combineSection1Items=$commonItems->concat($section1Videos)->filter();

        //store into an array
        $commonItems2=collect($section2Posts);

        //combine two arrays into one array
        $combineSection2Items=$commonItems2->concat($section2Videos)->filter();

        return view('home',compact('combineSection1Items','combineSection2Items'));
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
}
