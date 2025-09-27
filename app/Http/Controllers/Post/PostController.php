<?php declare (strict_types = 1);
namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Careminate\Http\Responses\Response;

class PostController extends Controller
{
    public function index(): Response
    {
        // Your logic here
        return new Response('<h1>Post Index</h1>');
    }

    public function create(): Response
    {
        // Your logic here
        return new Response('<h1>Create Post</h1>');
    }

    public function store(): Response
    {
        // Your logic here
        return new Response('<h1>Store Post</h1>');
    }

    public function show(int $id): Response
    {
        // Your logic here
        return new Response("<h1>Show Post with ID: $id</h1>");
    }

    public function edit(int $id): Response
    {
        // Your logic here
        return new Response("<h1>Edit Post with ID: $id</h1>");
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
