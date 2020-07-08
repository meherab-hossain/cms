@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <div>
                <div class="card">
                    <div class="card-header">Blog</div>

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
                                            <div class="card-body text-center">

                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        {{$combineItem->title}}
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <div class="col-md-12">
                                                        @if($combineItem->image)
                                                            <img style="width:100%"
                                                                 class="img-responsive thumbnail"
                                                                 src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                        @else
                                                            <div class="wrapper">
                                                                <img style="width:100%"
                                                                     src="{{$combineItem->video}}"
                                                                />
                                                                <button onclick="playVideo({{$combineItem}})"
                                                                        class="btn"
                                                                        aria-label="Close">
                                                                        <span class="material-icons icon">
                                                                            video_library
                                                                        </span>
                                                                </button>
                                                            </div>

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
                                                <div>NO Posts</div>
                                            </div>
                                        @else
                                            <div class="card">
                                                <div class="card-body text-center">

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            {{$combineItem->title}}
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">

                                                        <div class="col-md-12">
                                                            @if($combineItem->image)
                                                                <img style="width:100%"
                                                                     class="img-responsive thumbnail"
                                                                     src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                            @else
                                                                <div class="wrapper">
                                                                    <img style="width:100%"
                                                                         src="{{$combineItem->video}}"
                                                                    />
                                                                    <button onclick="playVideo({{$combineItem}})"
                                                                            class="btn"
                                                                            aria-label="Close">
                                                                        <span class="material-icons icon">
                                                                            video_library
                                                                        </span>
                                                                    </button>
                                                                </div>

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