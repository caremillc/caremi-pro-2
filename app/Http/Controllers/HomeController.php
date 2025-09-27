<?php declare(strict_types=1);
namespace App\Http\Controllers;

use Careminate\Http\Responses\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $content = '<h1>Hello World from HomeController</h1>';

        return new Response($content);
    }
}
