<?php declare(strict_types=1);
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Careminate\Http\Responses\Response;


class PostController extends Controller
{
    public function index()
    { 
        $posts = "All Posts";

       return view('posts.index', compact('posts'));
    }

    public function create()
    {
        // Your logic here
        return view('posts.create');
    }

    public function store()
    {
        dd(request_all());
        // Your logic here
        return new Response('<h1>Store Post</h1>');
    }

    public function show(int $id)
    {
        // Your logic here
        $postId = "<h1>Show Post with ID: $id</h1>";
        return view('posts.show', compact('postId'));
    }

    public function edit(int $id)
    {
        // Your logic here
        $id = 2;
        return view('posts.edit', compact('id'));
    }

    public function update(int $id): Response
    {
        // Your logic here
        return new Response("<h1>Update Post with ID: $id</h1>");
    }

    public function delete(int $id): Response
    {
        // Your logic here
        return new Response("<h1>Delete Post with ID: $id</h1>");
    }
}
