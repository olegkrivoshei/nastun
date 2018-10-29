@extends('layouts.appl')


@section('content')
    <h1>Posts</h1>
    @if(count($posts) >0)
        <main role="main">
            <div class="row">
                <?php $in = 0;?>
                @foreach($posts as $post)
                    <div class="col-md-4" style="max-height: 90%">
                        <div class="card mb-4 shadow-sm">
                            {{--<a href="/post/{{$post->id}}" >--}}
                            <img   ondblclick="getLike('{{$post->id}}')" onclick="href('{{$post->id}}')" class="card-img-top"
                                 src="/storage/cover_images/{{$post->cover_image}}"
                                 style="max-width: 100%; max-height: 50%;">
                            <hr>
                            <center><h3 style="margin-left:5%">{!!  $post->title !!}</h3></center>
                            <div class="card-body" style="padding: 3%">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/post/{{$post->id}}">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        </a>
                                    </div>
                                    <small class="text-muted">
                                        <?php $in = $in + 1;?>
                                        <div id="msg{{$post->id}}" style="cursor: pointer;">

                                            <div onclick="getLike('{{$post->id}}')"><h4 class="d-flex justify-content-between align-items-center mb-3">
                                                    @if(!isset($_COOKIE["usern" . $post->id . ""]) or $_COOKIE["usern" . $post->id . ""]==0)

                                                        <span class="badge badge-secondary badge-pill " id="pop{{$post->id}}"
                                                              style=" margin-top:30%; background-color: rgba(216,191,216,0.7)!important;">&#x1f497 {{$post->countLikes}}
                                                           </span>

                                                    @else
                                                        <span class="badge badge-secondary badge-pill" id="pil{{$post->id}}"
                                                              style=" margin-top:30%; background-color: rgba(216,191,216,0.7)!important;">{{$post->countLikes}}
                                                            &#x1f497</span>
                                                    @endif
                                                    </h4>
                                            </div>

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
    var timeoutId;
    var date = new Date();
    var minutes = 360;
    date.setTime(date.getTime() + (minutes * 60 * 1000));

    function href(id) {

            timeoutId = setTimeout('clearTimeout(timeoutId);location.href = \'/post/'+id+'\'', 300);

//        window.location.href = "/post/"+id;

    }


    function getLike(id) {


        clearTimeout(timeoutId);
        clearTimeout(timeoutId - 1);

        if (getCookie("usern" + id + "") != "0") {

            var str = "#msg" + id + "";
            $.ajax({
                type: 'GET',
                cash: 'false',
                url: "/post/likes/" + id + "",
                success: function (html) {
                    $(str).html(html);
                }
            });
            document.cookie = "usern" + id + "=0", { expires: date } ;
            return;
        }
        if (getCookie("usern" + id + "") == "0") {

            var str = "#msg" + id + "";
            $.ajax({
                type: 'GET',
                cash: 'false',
                url: "/post/likesm/" + id + "",
                success: function (html) {
                    $(str).html(html);
                }
            });
            document.cookie = "usern" + id + "={{$_SERVER['REMOTE_ADDR']}}", { expires: date };

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


