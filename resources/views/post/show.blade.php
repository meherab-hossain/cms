@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">create post</div>

                    <div class="card-body text-center">

                        <div class="form-group row">
                            <div class="col-md-12">
                                {{$post->title}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <img height="150px" width="150px" class="img-responsive thumbnail"
                                     src="{{ asset('storage/post/'.$post->image) }}"/>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-md-12">
                                {{$post->body}}
                            </div>
                        </div>
                        @can('isUser')
                            <div class="form-group row">
                                <div class="col-md-12">
                                    @if($post->is_approved == false)
                                        <span>pending</span>
                                    @else
                                        <span class="text-success">approved</span>
                                    @endif
                                </div>

                            </div>
                        @endcan
                        @can('isAdmin')
                            @if($post->is_approved == false)

                                <form method="post" action="{{route('post.approve',$post->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success waves-effect pull-right">
                                        <span>Approve</span>
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-success pull-right" disabled>
                                    <span>Approved</span>
                                </button>
                            @endif
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

