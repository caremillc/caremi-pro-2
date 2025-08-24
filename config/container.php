<?php  declare(strict_types=1); 

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

#parameters

$routes = Careminate\Routing\Route::getRoutes();

// Bind RouterInterface to Router implementation
$container->add(Careminate\Routing\Contracts\RouterInterface::class, 
                Careminate\Routing\Router::class);

// Extend RouterInterface definition to inject routes
$container->extend(Careminate\Routing\Contracts\RouterInterface::class)
          ->addMethodCall('setRoutes',
          [new League\Container\Argument\Literal\ArrayArgument($routes)]);


// Register the HTTP Kernel with its dependencies
$container->add(Careminate\Http\Kernel::class)
          ->addArgument(Careminate\Routing\Contracts\RouterInterface::class)
          ->addArgument($container);

// dd($container);
return $container;