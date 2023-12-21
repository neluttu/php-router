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


function authorize($condition, $status = Response::FORBIDDEN) {
    if(!$condition) abort($status);
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($view, $attributes = []) {
    extract($attributes);
    require base_path('views/' . $view . '.view.php');
}


function redirect ($path = '/') {
    header('Location: '.$path);
    die();
}

function old($key, $default = '') {
    return Core\Session::get('old')[$key] ?? $default;
}


function slug($string) {
    $string = preg_replace('/[^a-z0-9-]/', '', str_replace(' ', '-', strtolower($string)));
    return $string;
}
