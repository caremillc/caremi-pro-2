<?php declare(strict_types=1);
namespace App\Widget;

class Widget
{
    public string $name = 'Default Widget';
    
    public function __construct(?string $name = null)
    {
        if ($name !== null) {
            $this->name = $name;
        }
    }
}