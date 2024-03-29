<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index($postUrl)
    {

        $post = Post::where('url', '=', $postUrl)->first();
        if ($post) {
            $array = ['title' => $post['title'], 'description' => $post['title']];
            return view('posts.index', $array);
        } else {
            return false;
        }
    }

    public function posts()
    {
        $array = ['title' => "Cтатьи", 'description' => "Cтатьи"];
        return view('posts.posts', $array);
    }
}
