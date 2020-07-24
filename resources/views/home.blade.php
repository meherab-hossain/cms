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
                                    <div class="grid-items-row">
                                        @foreach($combineSection1Items as $combineItem)
                                            @php
                                                if($combineItem->image){
                                                $route='post.show';
                                                }else{
                                                $route='video.show';
                                                }
                                            @endphp

                                            <div class="wrapper" style="width: 100%">
                                                <div>
                                                    @if($combineItem->image)
                                                        <img class="img-responsive thumbnail"
                                                        src="{{$combineItem->imageUrl}}"
                                                        >
                                                                <!-- src="{{ asset('storage/post/'.$combineItem->image) }}"/> -->
                                                    @else
                                                        <div>
                                                            <img
                                                                    src="{{$combineItem->video}}"
                                                            />


                                                            <span class="material-icons icon mySpan border text-center "
                                                                  onclick="playVideo({{$combineItem}})"
                                                                  style="cursor: pointer">
                                                                            video_library
                                                            </span>
                                                        </div>

                                                    @endif
                                                    <div class="text-length">
                                                        <a href="{{route($route,$combineItem->id)}}">
                                                            {{$combineItem->title}}
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <div class="text-length">
                                                            <a href="{{route($route,$combineItem->id)}}">
                                                                {{$combineItem->body}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>


                                <div class="col-md-6">
                                    <div class="grid-items">
                                        @foreach($combineSection2Items as $combineItem)
                                            @php
                                                if($combineItem->image){
                                                $route='post.show';
                                                }else{
                                                $route='video.show';
                                                }
                                            @endphp
                                            <div>
                                                <div class="wrapper p-2" style="width: 100%">
                                                    @if($combineItem->image)
                                                        <img
                                                                class="img-responsive thumbnail"
                                                                src="{{$combineItem->imageUrl}}"
                                                                {{-- src="{{ asset('storage/post/'.$combineItem->image) }}" --}}
                                                        />
                                                    @else
                                                        <div>
                                                            <img class="pb-2" src="{{$combineItem->video}}"/>

                                                            <span class="material-icons icon mySpan border text-center "
                                                                  onclick="playVideo({{$combineItem}})"
                                                                  style="cursor: pointer">
                                                                            video_library
                                                               </span>
                                                        </div>
                                                    @endif

                                                    <div class="text-length">
                                                        <a href="{{route($route,$combineItem->id)}}">
                                                            {{$combineItem->title}}
                                                        </a>

                                                    </div>

                                                    <div>
                                                        <div class="text-length">
                                                            <a href="{{route($route,$combineItem->id)}}">
                                                                {{$combineItem->body}}
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
