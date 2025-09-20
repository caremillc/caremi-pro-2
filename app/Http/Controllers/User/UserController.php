<?php declare(strict_types=1);
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Careminate\View\Engines\Contracts\ViewEngineInterface;

class UserController extends Controller 
{
    public function __construct(private ViewEngineInterface $views) {}

    public function profile() {
        return $this->views->render('users.profile', ['user' => 'Alice']);
    }
}