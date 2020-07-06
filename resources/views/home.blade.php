@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="row justify-content-center">

                                <div class="col-md-6">
                                    @foreach($combineSection1Items as $combineItem)
                                        <div class="card">
                                            <div class="card-header">create post</div>

                                            <div class="card-body text-center">

                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        {{$combineItem->title}}
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-md-12">
                                                        @if($combineItem->image)
                                                            <img height="150px" width="150px"
                                                                 class="img-responsive thumbnail"
                                                                 src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                        @else
                                                            <iframe width="360" height="315"
                                                                    src="http://www.youtube.com/embed/{{$combineItem->video}}"
                                                                    frameborder="0"
                                                                    allowfullscreen>
                                                            </iframe>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class=" form-group row">
                                                    <div class="col-md-12">
                                                        {{$combineItem->body}}
                                                    </div>
                                                </div>
                                                <div class=" form-group row">
                                                    <div class="col-md-12">
                                                        {{$combineItem->type}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="col-md-6">
                                    @foreach($combineSection2Items as $combineItem)
                                        @empty($combineItem)
                                            <div class="col-md-6">
                                                <div>hello there</div>
                                            </div>
                                        @else
                                            <div class="card">
                                                <div class="card-header">create post</div>

                                                <div class="card-body text-center">

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            {{$combineItem->title}}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            @if($combineItem->image)
                                                                <img height="150px" width="150px"
                                                                     class="img-responsive thumbnail"
                                                                     src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                            @else
                                                                <div>
                                                                    <img class="imgPosition bg-danger" width="150px"
                                                                         height="150px"
                                                                         src="{{$combineItem->video}}"
                                                                    />
                                                                </div>
                                                                <button class="close imgButton"
                                                                        onclick="playVideo({{$combineItem}})"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class=" form-group row">
                                                        <div class="col-md-12">
                                                            {{$combineItem->body}}
                                                        </div>
                                                    </div>
                                                    <div class=" form-group row">
                                                        <div class="col-md-12">
                                                            {{$combineItem->type}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endempty
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    function playVideo(item) {
        window.open(item.url, '_blank');
        console.log(item.url)
    }
</script>