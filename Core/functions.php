<?

use Core\Response;
function dd($value) {
    echo '<pre class="text-slate-600">';
    var_dump($value);
    echo '</pre>';
    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404) {
    http_response_code($code);
    
    require base_path("views/{$code}.php");

    die();

}

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes))
        require $routes[$uri];
    else 
        abort();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if(!$condition) abort($status);
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($view, $attributes = []) {
    extract($attributes);
    require base_path('views/' . $view);
}


function redirect ($path = '/') {
    header('Location: '.$path);
    die();
}

function logout() {
    $_SESSION = [];
    session_destroy();

    header('Location: /');
}    

function old($key, $default = '') {
    return Core\Session::get('old')['email'] ?? $default;
}
?>