<?php  declare(strict_types=1); 

$container = new \League\Container\Container();

// Bind RouterInterface to Router implementation
$container->add(Careminate\Routing\Contracts\RouterInterface::class, \Careminate\Routing\Router::class);

// Register the HTTP Kernel with its dependencies
$container->add(Careminate\Http\Kernel::class)
          ->addArgument(Careminate\Routing\Contracts\RouterInterface::class);

// dd($container);
return $container;