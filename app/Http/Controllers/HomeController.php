<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(/*Request $request*/) {
        // use $request->get('name', 'Guest'); or
//        $name = request('name');
//        return "Hello, {$name}!";

        # if no session with name redirect to form
        if (!session()->has('name'))
            return redirect()->route('form');

        return view('index', [
            'name' => session('name')
        ]);
    }

    function form() {
        if (session()->has('name'))
            return redirect()->route('index');

        return view('form');
    }

    function handle() {
        # Secure from TSRF attacks: required must be in input name
        request()->validate([
            'name' => 'required'
        ]);

        session()->put('name', request('name'));

        return redirect()->route('index'); # by names
    }
}
