<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'hello';
        return view('pages.index', compact('title'));
    }

    public function about()
    {
        $title = 'we are funy';
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = array(
            'title' => 'Services' );
        $datas1 = array( 'web design', 'programing', 'sao');
        return view('pages.sating')->with('data', $data)->with('datas1',$datas1);
    }
}
