<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    function show(User $user) {
        $comments = $user->comments()
            ->with('post') # N+1 problem solved
            ->latest()
            ->take(5) # recent 5 comments
            ->get();

        $posts = $user->posts()
            ->latest()->get();

        return view('models.users.show', [
            'user' => $user,
            'comments' => $comments,
            'posts' => $posts
        ]);
    }
}
