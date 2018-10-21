<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Comments;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'likes', 'likesm']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('title', 'desc')->paginate(10);
        return view('post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            ['title' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999']);

        //handle file upload
        if ($request->hasFile('cover_image')) {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image') -> getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path =$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        //Create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->countLikes = 0;
        $post->save();

        return redirect('/post')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = DB::table('comments')->where('post_id', $id)->orderBy('id', 'desc')->get();
        return view('post.show')->with('post', $post)->with('comments',$comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

//        chek user id
        if (auth()->user()->id != $post->user_id) {
            return redirect('/post')->with('error', 'Unauthorized page');
        }

        return view('post.edit')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            ['title' => 'required',
                'body' => 'required']);

        //handle file upload
        if ($request->hasFile('cover_image')) {
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image') -> getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path =$request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

        }

        //Create post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/post')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id != $post->user_id) {
            return redirect('/post')->with('error', 'Unauthorized page');
        }
        if($post->cover_image != 'noimage.jpg'){
        Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/post')->with('success', 'Post removed');
    }




    public function likes($id)
    {
        $post = Post::find($id);
            $post->countLikes = ($post->countLikes)+1;



        $post->save();
        return "<button onclick=\"getMessagem{$post->id}()\" class=\"btn btn-danger\">".$post->countLikes.' likes'."</button>";
    }
    public function likesm($id)
    {
        $post = Post::find($id);
        $post->countLikes = ($post->countLikes)-1;



        $post->save();
        return "<button onclick=\"getMessage{$post->id}()\" class=\"btn btn-danger\">".$post->countLikes.' likes'."</button>";
    }
}
