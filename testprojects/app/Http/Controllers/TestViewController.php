<?php

namespace App\Http\Controllers;

class TestViewController extends Controller
{
    public function test()
    {
        return view('test_view');
    }
}
