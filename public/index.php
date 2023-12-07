<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use Core\Session;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router;

$routes = require base_path('routes.php');

// Get current URI 
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

// Get current method
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route to controller
$router->route($uri, $method);

Session::unflash();