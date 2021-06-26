<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Auth;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:post-list|post-create|post-edit|post-delete|product-list', ['only' => ['index','show']]);

        // yang memiliki izin post-create hanya boleh melakukan create & store
        $this->middleware('permission:post-create', ['only' => ['create','store']]);

        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index(){
        $Posts = Post::all();
        return view('posts.index', compact('Posts'));
    }

    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        request()->validate([
            'post_title' => 'required',
        ]);

        Post::create([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'post_content' => $request->post_content,
        ]);

        return redirect()->route('posts.index')->with('success','Post created.');

    }

    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post){
        request()->validate([
            'post_title' => 'required',
        ]);

        $post->update([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'post_content' => $request->post_content
        ]);

        return redirect()->route('posts.index')->with('success','Post updated');
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('posts.index')->with('success','Post deleted');
    }

    public function postsAPI(){
        $posts = Post::select(['id', 'post_title', 'created_at'])->latest();

        $results = Datatables::of($posts)
                    ->addColumn('action', function ($post) {
                        $user = Auth::user();
                        $html = '';
                        $html .= '<a href="'.route('posts.show', $post->id).'" class="btn btn-xs btn-dark">
                                View
                            </a>
                        ';
                        if ( $user->can('post-edit') ) {
                            $html .= '
                                <a href="'.route('posts.edit', $post->id).'" class="btn btn-xs btn-success">
                                    Edit
                                </a>
                            ';
                        }
                        if ($user->can('post-delete')) {
                            $html .= '
                            <form action="'.route('posts.destroy', $post->id).'" method="POST"
                                class="d-inline" onsubmit="return confirm(\'Delete it ?\')">
                                '. csrf_field() .'
                                '. method_field("DELETE") .'
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                            ';
                        }
                        return $html;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->toJson();
        return $results;
    }

}
