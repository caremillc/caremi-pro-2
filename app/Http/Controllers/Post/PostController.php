<?php declare(strict_types=1);
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Careminate\Http\Responses\Response;


class PostController extends Controller
{
    public function index(): Response
    { 
        $posts = "All Posts";

       return view('posts/index.html.twig', compact('posts'));
    }

    public function create(): Response
    {
        // Your logic here
        return view('posts/create.html.twig');
    }

    public function store(): Response
    {
        // Your logic here
        return new Response('<h1>Store Post</h1>');
    }

    public function show(int $id): Response
    {
        // Your logic here
        $postId = "<h1>Show Post with ID: $id</h1>";
        return view('posts/show.html.twig', compact('postId'));
    }

    public function edit(int $id): Response
    {
        // Your logic here
        $postId = "<h1>Edit Post with ID: $id</h1>";
        return view('posts/edit.html.twig', compact('postId'));
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
