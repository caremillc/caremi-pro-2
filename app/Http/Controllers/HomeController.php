<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Widget\Widget;
use Careminate\Http\Requests\Request;
use Careminate\Http\Responses\Response;

class HomeController extends Controller
{
    public function __construct(private Widget $widget){}

    public function index()
    {
        // Renders via selected engine (flint/twig/plates)
        return view('home.index', ['name' => 'Careminate']);
    }
}
