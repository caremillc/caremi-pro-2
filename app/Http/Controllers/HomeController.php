<?php declare (strict_types = 1);
namespace App\Http\Controllers;

use App\Widget\Widget;

class HomeController extends Controller
{
    public function __construct(private Widget $widget)
    {
    }
    public function index()
    {
        return view('home.welcome', [
            'title'   => 'Welcome to Careminate!',
            'message' => 'This is a polished view() helper.',
        ]);
    }
}