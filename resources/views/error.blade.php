


@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="block-header">
                        <a href="{{route('post.index')}}" class="btn btn-primary waves-effect">
                            <span>Back</span>
                        </a>
                        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
