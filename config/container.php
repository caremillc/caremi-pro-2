<?php  declare(strict_types=1); 
// Load environment variables
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

#parameters

$routes = Careminate\Routing\Route::getRoutes();

#env parameters
$appEnv = env('APP_ENV', 'production'); // Default to 'production' if not set
$appKey = env('APP_KEY'); // Default to 'production' if not set
$appVersion = env('APP_VERSION');

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));
$container->add('APP_KEY', new \League\Container\Argument\Literal\StringArgument($appKey));
$container->add('APP_VERSION', new \League\Container\Argument\Literal\StringArgument($appVersion));

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

dd($container);
return $container;