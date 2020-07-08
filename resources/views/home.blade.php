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
                                            <div class="wrapper">
                                                <div>
                                                    @if($combineItem->image)
                                                        <img
                                                                class="img-responsive thumbnail"
                                                                src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                    @else
                                                        <div>
                                                            <img
                                                                    src="{{$combineItem->video}}"
                                                            />


                                                            <span class="material-icons icon mySpan border text-center "
                                                                  onclick="playVideo({{$combineItem}})">
                                                                            video_library
                                                            </span>
                                                        </div>

                                                    @endif
                                                    <div class="b">
                                                        {{$combineItem->title}}
                                                    </div>
                                                    <div>
                                                        <div class="b">
                                                            {{$combineItem->body}}
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
                                            <div>
                                                <div class="wrapper">
                                                    @if($combineItem->image)
                                                        <img
                                                                class="img-responsive thumbnail"
                                                                src="{{ asset('storage/post/'.$combineItem->image) }}"/>
                                                    @else
                                                        <div>
                                                            <img
                                                                    src="{{$combineItem->video}}"
                                                            />


                                                            <span class="material-icons icon mySpan border text-center "
                                                                  onclick="playVideo({{$combineItem}})">
                                                                            video_library
                                                            </span>
                                                        </div>

                                                    @endif
                                                    <div class="b">
                                                        {{$combineItem->title}}
                                                    </div>
                                                    <div>
                                                        <div class="b">
                                                            {{$combineItem->body}}
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