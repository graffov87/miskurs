<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index($pageUrl)
    {

        $page = Page::where('url', '=', $pageUrl)->first();
        $array = ['title' => $page['title'], 'description' => $page['title']];
        return view('page.index', $array);
    }
}
