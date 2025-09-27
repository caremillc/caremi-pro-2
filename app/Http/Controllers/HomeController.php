<?php declare(strict_types=1);
namespace App\Http\Controllers;

use Twig\Environment;
use App\Widget\Widget;
use Careminate\Http\Controllers\AbstractController;
use Careminate\Http\Responses\Response;

class HomeController extends AbstractController
{
    public function __construct(private Widget $widget)
    {
    }

    public function index(): Response
    {
        $content = "<h1>Hello {$this->widget->name}</h1>";

        return new Response($content);
    }
}