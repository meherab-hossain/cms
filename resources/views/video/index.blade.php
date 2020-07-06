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
                            <th scope="col">user id</th>
                            <th scope="col">title</th>
                            <th scope="col">video</th>
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
                                <td class="d-inline-flex">
                                    <a href="{{route('video.show',$video->id)}}"
                                       class="btn btn-info waves-effect small">
                                        <span>details</span>
                                    </a>
                                    <a href="{{route('video.edit',$video->id)}}"
                                       class="btn btn-info waves-effect small ml-2">
                                        <span>edit</span>
                                    </a>
                                    <form method="post" action="{{ route('video.destroy' ,$video->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger waves-effect ml-2 small">
                                            <span>delete</span>
                                        </button>
                                    </form>
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
