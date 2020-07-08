@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Video Post Details</div>

                    <div class="card-body text-center">

                        <div class="form-group row">
                            <div class="col-md-12">
                                {{$video->title}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <iframe width="360" height="315"
                                        src="http://www.youtube.com/embed/{{$video->video}}"
                                        frameborder="0"
                                        allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-md-12">
                                {{$video->type}}
                            </div>
                        </div>
                        @can('isUser')
                            <div class="form-group row">
                                <div class="col-md-12">
                                    @if($video->is_approved == false)
                                        <span class="text-danger">pending</span>
                                    @else
                                        <span class="text-success">approved</span>
                                    @endif
                                </div>

                            </div>
                        @endcan
                        @can('isAdmin')
                            @if($video->is_approved == false)

                                <form method="post" action="{{route('video.approve',$video->id)}}">
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

