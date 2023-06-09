<?php

namespace App\Http\Controllers;

use App\Jobs\NotifySubscribers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        //validation here

        $post = Post::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'website_id' => 1,
        ]);

        NotifySubscribers::dispatch($post);
        return response()->json();
    }
}
