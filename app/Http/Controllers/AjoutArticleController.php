<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AjoutArticleController extends Controller
{
    public function index() {
        return view('ajoutArticle');
    }
  
}
