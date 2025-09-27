<?php  declare(strict_types=1); 
// Load environment variables
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$container = new \League\Container\Container();

// Enable auto-resolution of dependencies through reflection
$container->delegate(new \League\Container\ReflectionContainer(true));

#env parameters
$appEnv = env('APP_ENV', 'production'); // Default to 'production' if not set
$appKey = env('APP_KEY'); // Default to 'production' if not set
$appVersion = env('APP_VERSION');

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));
$container->add('APP_KEY', new \League\Container\Argument\Literal\StringArgument($appKey));
$container->add('APP_VERSION', new \League\Container\Argument\Literal\StringArgument($appVersion));

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