<?php  declare(strict_types=1); 

$container = new \League\Container\Container();

// Enable auto-resolution of dependencies through reflection
$container->delegate(new \League\Container\ReflectionContainer(true));

# Services
// Bind RouterInterface to Router implementation
$container->add(Careminate\Routing\Contracts\RouterInterface::class, \Careminate\Routing\Router::class);

// Register the HTTP Kernel with its dependencies
$container->add(\Careminate\Http\Kernel::class)
          ->addArgument(\Careminate\Routing\Contracts\RouterInterface::class)
          ->addArgument($container);

#parameters
// Load application routes from an external configuration file.
# get routes
$routes = Careminate\Routing\Route::getRoutes();

          // Extend RouterInterface definition to inject routes
$container->extend(Careminate\Routing\Contracts\RouterInterface::class)
          ->addMethodCall('setRoutes',[new League\Container\Argument\Literal\ArrayArgument($routes)]);


// Register the HTTP Kernel with its dependencies
$container->add(Careminate\Http\Kernel::class)
          ->addArgument(Careminate\Routing\Contracts\RouterInterface::class);

// dd($container);
return $container;