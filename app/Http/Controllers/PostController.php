<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index($postUrl) {

        return view('posts.index');
    }

    public function posts() {
        return view('posts.posts');

    }
}
