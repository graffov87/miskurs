<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index() {
        $array = ['title' => "Учебные Материалы",'description' => "Учебные Материалы"];
        return view('material.index', $array);
    }
}
