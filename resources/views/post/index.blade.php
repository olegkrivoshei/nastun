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
                            <img ondblclick="getLike('{{$post->id}}')" class="card-img-top"
                                 src="/storage/cover_images/{{$post->cover_image}}">
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
                                    <small class="text-muted">
                                        <?php $in = $in + 1;?>
                                        <div id="msg{{$post->id}}">
                                            <button onclick="getLike('{{$post->id}}')"
                                                    class="btn btn-danger">{{$post->countLikes.' likes'}}</button>
                                        </div>
                                    </small>
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

    <script>
        function getLike(id) {
            if (getCookie("usern"+id+"") != "0") {

                var str = "#msg" + id + "";
                $.ajax({
                    type: 'GET',
                    cash: 'false',
                    url: "/post/likes/" + id + "",
                    success: function (html) {
                        $(str).html(html);
                    }
                });
                document.cookie = "usern"+id+"=0";
                return;
            }
            if (getCookie("usern"+id+"") == "0") {

                var str = "#msg" + id + "";
                $.ajax({
                    type: 'GET',
                    cash: 'false',
                    url: "/post/likesm/" + id + "",
                    success: function (html) {
                        $(str).html(html);
                    }
                });
                document.cookie = "usern"+id+"={{$_SERVER['REMOTE_ADDR']}}";

                return;
            }
        }


        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
    </script>


