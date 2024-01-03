<?

use Core\Response;
function dd($value) {
    echo '<pre class="text-slate-600">';
    var_dump($value);
    echo '</pre>';
    die();
}

function getLangURLs() {
    $config = require base_path('config.php');
    $siteLangs = $config['siteLangs'];
    $LANGS = array_keys($siteLangs);
    $uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');

    // Check if language is set
    $checkURI = explode('/', $uri);
    unset($checkURI[0]);
    $checkURI = array_values($checkURI);
    // Here we have the first URI partial, $checkURI[0].
    
    if(!empty($checkURI[0]) and in_array($checkURI[0], $LANGS))
        $uri = substr($uri, 3);

    
    for($i=0; $i<count($LANGS);$i++) {
        
        $langs[$siteLangs[$LANGS[$i]]] = ($i !== 0) ? '/' . $LANGS[$i] . $uri : $uri;
    }

    return $langs;
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === \Core\Session::getLang() . $value;
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
    // fail require needs fallback.
    require base_path('Lang/' . \Core\Session::has('lang') .'.php');
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

function generateToken($length = 32) {
    $randomString = bin2hex(random_bytes($length));
    // $randomString = hash('sha256', $randomString);
    return $randomString;
}

function getPartial($partial) {
    require base_path('views/partials/'.$partial.'.php'); 
}