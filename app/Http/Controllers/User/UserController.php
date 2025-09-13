<?php declare(strict_types=1);
namespace App\Http\Controllers\User;

use Careminate\View\Engines\Contracts\ViewEngineInterface;

class UserController 
{
    public function __construct(private ViewEngineInterface $views) {}

    public function profile() {
        return $this->views->render('users.profile', ['user' => 'Alice']);
    }
}

