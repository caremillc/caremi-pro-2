<?php declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Careminate\Http\Responses\Response;

class InvokeController extends Controller
{
     public function __invoke(): Response
    {
        return new Response("Welcome InvokeController!");
    }
}