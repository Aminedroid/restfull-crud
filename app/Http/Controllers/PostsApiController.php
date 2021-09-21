<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostsApiController extends Controller
{
    public function index() {
        return Post::all();
    }

    public function store() {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        return Post::create([
            'title' => request('title'),
            'content' => request('content'),
        ]);
    }

    public function update(Post $post) {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $success = $post->update([
            'title' => request('title'),
            'content' => request('content'),
        ]);

        return [
            'success'=> $success
        ];
    }

    public function destroy(Post $post) {
        $success = $post->delete();
        return [
            'success' => $success
        ];
    }

    public function reverseContent() {
        $posts = Post::all();
        $reversedPosts = Post::orderBy("id", "DESC")->get();

        $arrayOfPosts = json_decode($posts, TRUE);
        $arrayOfReversedPosts = json_decode($reversedPosts, TRUE);

        
        for($i = 0; $i<count($arrayOfPosts); $i++) {
            $arrayOfPosts[$i]['content'] = $arrayOfReversedPosts[$i]['content'];
        }

        return $arrayOfPosts;
    }
}
