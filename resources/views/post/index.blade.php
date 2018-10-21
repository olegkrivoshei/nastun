@extends('layouts.appl')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) >0)
        <main role="main">
            <div class="row">
                <?php $in = 0;?>
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}">
                            <small style="margin-left:2%">{{$post->created_at}} by {{$post->user->name}}</small>
                            <h3 style="margin-left:5%">{!!  $post->title !!}</h3>
                            <div class="card-body">

                                <p class="card-text">{!!  $post->title !!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/post/{{$post->id}}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </a>
                                    </div>
                                    {{--<a href="/post/{{$post->id}}">--}}
                                        <small class="text-muted">
                                            <?php $in = $in + 1;?>
                                            {{--{!!Form::open(['action'=>['PostController@likes', $post->id],'method'=>'POST','id'=>'contactform','class'=>'pull-right'])!!}--}}
                                            {{--{{Form::hidden('_method','GET')}}--}}
                                            {{--{{Form::submit($post->countLikes.' likes',['class'=>'btn btn-danger'])}}--}}
                                            {{--{!!Form::close()!!}--}}

                                            {{--{!!Form::open(['action'=>['PostController@likes', $post->id],'method'=>'POST','id'=>'contactform','class'=>'pull-right'])!!}--}}
                                            {{--{{Form::hidden('_method','GET')}}--}}
                                            {{--{{Form::submit($post->countLikes.' likes',['class'=>'btn btn-danger'])}}--}}
                                            {{--{!!Form::close()!!}--}}
                                           {{--<a href='/post/likes/{{$post->id}}'>--}}
                                            {{--<div id="msg{{$post->id}}">--}}
                                                <div id="msg{{$post->id}}">
                                                <button  onclick="getMessage{{$post->id}}()"
                                                        class="btn btn-danger">{{$post->countLikes.' likes'}}</button>
                                                </div>
                                            {{--</div>--}}
                                           {{--</a>--}}
                                        </small>
                                    {{--</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection



<?php $int = 1;?>
@foreach($posts as $post)
<script>
    function getMessage{{$post->id}}(){
        $.ajax({
            type:'GET',
            cash: 'false',
            url:'/post/likes/{{$post->id}}',
            success: function(html) {
                $('#msg{{$post->id}}').html(html);
            }
        });
    }
</script>
    <?php $int=$int+1; ?>
@endforeach

<?php $intm = 1;?>
@foreach($posts as $post)
    <script>
        function getMessagem{{$post->id}}(){
            $.ajax({
                type:'GET',
                cash: 'false',
                url:'/post/likesm/{{$post->id}}',
                success: function(html) {
                    $('#msg{{$post->id}}').html(html);
                }
            });
        }
    </script>
    <?php $intm=$intm+1; ?>
@endforeach
