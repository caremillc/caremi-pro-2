<?php  declare(strict_types=1); 
// Load environment variables
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$container = new \League\Container\Container();

// Enable auto-resolution of dependencies through reflection
$container->delegate(new \League\Container\ReflectionContainer(true));

// View Engine registration
$viewConfig = require __DIR__ . '/view.php';
// dd($viewConfig);

#env parameters
$appEnv = env('APP_ENV', 'production'); // Default to 'production' if not set
$appKey = env('APP_KEY'); // Default to 'production' if not set
$appVersion = env('APP_VERSION');

$container->add('APP_ENV', new \League\Container\Argument\Literal\StringArgument($appEnv));
$container->add('APP_KEY', new \League\Container\Argument\Literal\StringArgument($appKey));
$container->add('APP_VERSION', new \League\Container\Argument\Literal\StringArgument($appVersion));


// Load application routes from an external configuration file.
$routes = Careminate\Routing\Route::getRoutes();

# Services
// Bind RouterInterface to Router implementation
$container->add(Careminate\Routing\Contracts\RouterInterface::class, \Careminate\Routing\Router::class);

// Register the HTTP Kernel with its dependencies
$container->add(\Careminate\Http\Kernel::class)
          ->addArgument(\Careminate\Routing\Contracts\RouterInterface::class)
          ->addArgument($container);



          // Extend RouterInterface definition to inject routes
$container->extend(Careminate\Routing\Contracts\RouterInterface::class)
          ->addMethodCall('setRoutes',[new League\Container\Argument\Literal\ArrayArgument($routes)]);


// Register the HTTP Kernel with its dependencies
$container->add(Careminate\Http\Kernel::class)
          ->addArgument(Careminate\Routing\Contracts\RouterInterface::class);

          /**
 * Start View Templates
 */

// ViewManager binding
$container->add(\Careminate\View\Engines\ViewManager::class, function () use ($viewConfig) {
    $manager = new \Careminate\View\Engines\ViewManager($viewConfig);

    // Load custom directives if Flint is the active engine
    $directivesFile = base_path('resources/views/directives.php');
    if (file_exists($directivesFile)) {
        $registerDirectives = require $directivesFile;
        if (is_callable($registerDirectives)) {
            $registerDirectives($manager);
        }
    }

    return $manager;
});

// Alias interface → manager
$container->add(
    \Careminate\View\Engines\Contracts\ViewEngineInterface::class,
    function () use ($container) {
        return $container->get(\Careminate\View\Engines\ViewManager::class);
    }
);

$container->add('flint',
    \Careminate\View\Engines\Contracts\ViewEngineInterface::class,
    function () use ($container) {
        return $container->get(\Careminate\View\Engines\ViewManager::class);
    }
);

/**
 * Start AbstractController
 */
// Register the AbstractController so it can be resolved by the container.
$container->add(\Careminate\Http\Controllers\AbstractController::class);

// Automatically call the setContainer() method on any class that extends AbstractController
// This injects the container itself into the controller, enabling dependency resolution within controllers.
$container->inflector(\Careminate\Http\Controllers\AbstractController::class)
    ->invokeMethod('setContainer', [$container]);
   
/**
 * End AbstractController
 */
/**
 * End View Template
 */

// dd($container);
return $container;