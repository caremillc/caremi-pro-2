<?php  declare(strict_types=1); 
// Load environment variables
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(dirname(__DIR__) . '/.env');

$container = new \League\Container\Container();

$container->delegate(new \League\Container\ReflectionContainer(true));

#parameters

# get routes
$routes = Careminate\Routing\Route::getRoutes();

# twig template path
$templatesPath = BASE_PATH . '/templates';

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

// Register the Twig FilesystemLoader as a shared (singleton) service.
// It will use the provided $templatesPath as the base directory for template files.
$container->addShared('filesystem-loader', \Twig\Loader\FilesystemLoader::class)
    ->addArgument(new \League\Container\Argument\Literal\StringArgument($templatesPath));

// Register the Twig Environment as a shared (singleton) instance
// and inject the 'filesystem-loader' service into its constructor.
$container->addShared('twig', \Twig\Environment::class)
    ->addArgument('filesystem-loader');

// Register the AbstractController so it can be resolved by the container.
$container->add(\Careminate\Http\Controllers\AbstractController::class);

// Automatically call the setContainer() method on any class that extends AbstractController
// This injects the container itself into the controller, enabling dependency resolution within controllers.
$container->inflector(\Careminate\Http\Controllers\AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

# start database connection
$dbConfig = require BASE_PATH . '/config/database.php';
$defaultDriver = $dbConfig['default'];
$driverConfig = $dbConfig['drivers'][$defaultDriver];

$container->add(Careminate\Databases\Dbal\Connections\Contracts\ConnectionInterface::class, Careminate\Databases\Dbal\Connections\ConnectionFactory::class)
    ->addArgument($driverConfig);
# Optional – Register DB Connection globally in container
$container->addShared(\Doctrine\DBAL\Connection::class, function () use ($container) {
    return $container->get(Careminate\Databases\Dbal\Connections\Contracts\ConnectionInterface::class)->create();
});

# end database connection

// dd($container);
return $container;