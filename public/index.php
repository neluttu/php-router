<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
use Core\Session;

const BASE_PATH = __DIR__ . '/../';

require (BASE_PATH . 'vendor/autoload.php');
require BASE_PATH . 'Core/functions.php';
require base_path('bootstrap.php');

// Setup router.
$router = new \Core\Router;
require base_path('routes.php');

// Route to controller
$router->route();

// Unflash 
Session::unflash();