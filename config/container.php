<?php  declare(strict_types=1); 

$container = new \League\Container\Container();

// Enable auto-resolution of dependencies through reflection
$container->delegate(new \League\Container\ReflectionContainer(true));

#parameters
// Load application routes from an external configuration file.
// 1. Require the web routes file so routes are registered
require_once route_path('web.php');

# Services
// Bind RouterInterface to Router implementation
// 2. Bind RouterInterface to Router implementation
$container->add(Careminate\Routing\Contracts\RouterInterface::class, \Careminate\Routing\Router::class);

// 3. Fetch all registered routes
$routes = Careminate\Routing\Route::getRoutes();

// 4. Inject them into Router
// Extend RouterInterface definition to inject routes
$container->extend(Careminate\Routing\Contracts\RouterInterface::class)
          ->addMethodCall('setRoutes',[new League\Container\Argument\Literal\ArrayArgument($routes)]);

// 5. Register the Kernel with dependencies
// Register the HTTP Kernel with its dependencies
$container->add(\Careminate\Http\Kernel::class)
          ->addArgument(\Careminate\Routing\Contracts\RouterInterface::class)
          ->addArgument($container);
         
// dd($container);
return $container;