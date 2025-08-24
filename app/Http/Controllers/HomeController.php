<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Widget\Widget;
use Careminate\Http\Responses\Response;

class HomeController extends Controller
{
    public function __construct(private Widget $widget){}

    public function index(): Response
    {
        $title = "Home Page";
        return view('home.html.twig', compact('title'));
    }
}