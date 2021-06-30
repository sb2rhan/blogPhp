<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    function index() {
        /*$post = Post::query()
            ->create([
                'title' => 'First post',
                'content' => 'Some content'
            ]);

        dd($post); // dump and die will show the info and die
        */

        return view('index');
    }


}
