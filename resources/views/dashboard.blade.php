@extends('layouts.appl')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a class="btn btn-primary" href="/post/create">Create post</a>
                        {{--<a class="nav-link" href="/post/create">Add post <span class="sr-only">(current)</span></a>--}}

                        <h3 style="margin-top:1%">Your blog posts</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)

                                <tr>
                                    <th>{{$post->title}}</th>
                                    <th><a href="/post/{{$post->id}}/edit" class="btn btn-dark">Edit</a></th>
                                    <th>{!!Form::open(['action'=>['PostController@destroy', $post->id],'method'=>'POST','class'=>'pull-right'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('DELETE',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}</th>
                                    {{--http://new2/post/2/edit--}}
                                </tr>
                            @endforeach
                        </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
