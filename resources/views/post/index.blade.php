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
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">User Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Body</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Section</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{$post->user->id}}</th>
                                <td>{{$post->title}}</td>
                                <td>{{$post->user->name}}</td>
                                <td><img height="150px" width="150px" class="img-responsive thumbnail" src="{{$post->imageUrl}}"/>
                                </td>
                                <td>{{$post->body}}</td>
                                <td>
                                    @if($post->is_approved==true)
                                        <span class="badge bg-blue">approved</span>
                                    @else
                                        <span class="badge bg-pink">pending</span>
                                    @endif
                                </td>
                                <td>
                                    {{$post->type}}
                                </td>
                                <td class="d-inline-flex">
                                    <a href="{{route('post.show',$post->id)}}"
                                       class="btn btn-info waves-effect small">
                                        <span>Details</span>
                                    </a>
                                    <a href="{{route('post.edit',$post->id)}}"
                                       class="btn btn-info waves-effect small ml-2">
                                        <span>Edit</span>
                                    </a>
                                    <form method="post" action="{{ route('post.destroy' ,$post->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger waves-effect ml-2 small">
                                            <span>Delete</span>
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
