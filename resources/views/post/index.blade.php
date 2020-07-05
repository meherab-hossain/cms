@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="block-header">
                        <a href="{{route('post.create')}}" class="btn btn-primary waves-effect">
                            <span>Add New Post</span>
                        </a>
                        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">user id</th>
                            <th scope="col">title</th>
                            <th scope="col">name</th>
                            <th scope="col">image</th>
                            <th scope="col">body</th>
                            <th scope="col">publish</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post->user->id}}</th>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->image}}</td>
                                <td>{{$post->body}}</td>
                                <td>
                                    @if($post->is_approved==true)
                                        <span class="badge bg-blue">approved</span>
                                    @else
                                        <span class="badge bg-pink">pending</span>
                                    @endif</td>
                                <td>
                                    <a href="{{route('post.show',$post->id)}}"
                                       class="btn btn-info waves-effect">
                                        <i class="material-icons">visibility</i>
                                    </a>
                                    <a href="{{route('post.edit',$post->id)}}"
                                       class="btn btn-info waves-effect">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <form method="post" action="{{ route('post.destroy' ,$post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger waves-effect">
                                            <i class="material-icons">delete</i>
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
