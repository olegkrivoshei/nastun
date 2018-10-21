@extends('layouts.appl')

@section('content')

    <div>
        <a href="/post" class="btn btn-dark" style="margin-left: 1% ; margin-top: 1%">Go back</a>
        <h1>{{$post->title}}</h1>

        <center><img style="width:50%; height: 50%;" src="/storage/cover_images/{{$post->cover_image}}" alt="lol">
        </center>
        {{--<small>Written on {{$post->created_at}} by {{$post->user->name}} </small>--}}
        <hr>
        <p>{!! $post->body !!}</p>
        <hr>

        @if(!Auth::guest())
            @if(Auth::user()->id ==$post->user_id)
                <a href="/post/{{$post->id}}/edit" class="btn btn-dark" style="margin-left: 1%">Edit post</a>
                {!!Form::open(['action'=>['PostController@destroy', $post->id],'method'=>'POST','class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            @endif
        @endif
    </div>
    {{--//comment create--}}

    {!! Form::open(['action' => 'CommentsController@store','method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', '', ['class' => 'form-control', 'style'=>'width:20%','placeholder' => 'Name', 'id'=>'firstName'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    {{Form::hidden('post_id',$post->id)}}
    {{--'id'=>'article-ckeditor',--}}

    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}


    {{--//commets viwe--}}


    @foreach($comments as $comment)

       <hr>
            <div>
                <strong class="d-block text-gray-dark">@.{{$comment->name}}</strong></div>
            <div>
                <p style="font-size: 11pt;">

                    {!!$comment->body!!}
                </p>
            </div>

        <hr>
    @endforeach

@endsection

