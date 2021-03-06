@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="block-header">
                        <a href="{{route('video.create')}}" class="btn btn-primary waves-effect">
                            <span>Add New video</span>
                        </a>
                        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">User Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Video</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Section</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($videos as $video)
                            {{--<pre>{{$video}}</pre>--}}
                            <tr>
                                <th scope="row">{{$video->id}}</th>
                                <td>{{$video->title}}</td>
                                <td>
                                    <iframe width="360" height="315"
                                            src="http://www.youtube.com/embed/{{$video->video}}"
                                            frameborder="0"
                                            allowfullscreen>
                                    </iframe>
                                </td>
                                <td>
                                    @if($video->is_approved==true)
                                        <span class="badge bg-blue">approved</span>
                                    @else
                                        <span class="badge bg-pink">pending</span>
                                    @endif
                                </td>
                                <td>
                                    {{$video->type}}
                                </td>
                                <td>
                                    <a href="{{route('video.show',$video->id)}}"
                                       class="btn btn-info waves-effect small">
                                        <span>details</span>
                                    </a>
                                    {{--<a href="{{route('video.edit',$video->id)}}"
                                       class="btn btn-info waves-effect small ml-2">
                                        <span>edit</span>
                                    </a>
                                    <form method="post" action="{{ route('video.destroy' ,$video->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger waves-effect ml-2 small">
                                            <span>delete</span>
                                        </button>
                                    </form>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
