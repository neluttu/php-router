<?
namespace Core;
use Core\Middleware\Middleware;
class Router {
    protected $routes = [];
    
    protected function add($method, $uri, $controller) {
        
        //$this->routes[] = compact('method', 'uri', 'controller'); same as:
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
            'redirect' => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        $this->add('GET', $uri, $controller);
        return $this;
    }
    
    public function post($uri, $controller) {
        $this->add('POST', $uri, $controller);
        return $this;
    }

    public function delete($uri, $controller) {
        $this->add('DELETE', $uri, $controller);
        return $this;
    }

    public function patch($uri, $controller) {
        $this->add('PATCH', $uri, $controller);
        return $this;
    }

    public function put($uri, $controller) {
        $this->add('PUT', $uri, $controller);
        return $this;
    }

    // grab the last added route and add the middleware key.
    public function only($key, $redirect = null) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        $this->routes[array_key_last($this->routes)]['redirect'] = $redirect;
        return $this;
    }


    // load controller.
    public function route() {
        $uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $method = strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);        

        foreach($this->routes as $route) {
            $uriSegmensts = explode('/', trim($uri, '/'));
            $routeSegments = explode('/', trim($route['uri'], '/'));
            $match = true;

            if(count($uriSegmensts) === count($routeSegments) and $route['method'] === $method) {
                $params = [];
                $match = true;

                for($i = 0; $i < count($uriSegmensts); $i++) { 
                    if($routeSegments[$i] !== $uriSegmensts[$i] and !preg_match('/\{(.+?)\}/', $routeSegments[$i])){
                        $match = false;
                        break;
                    }
                    if(preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches))
                        $params[$matches[1]] = $uriSegmensts[$i];
                }
                if($match) {
                    Middleware::resolve($route['middleware'], $route['redirect']);    
                    return require base_path('Http/controllers/' . $route['controller']);
                }
            }
        }
        $this->abort();
    }

    protected function abort($code = 404) {
        http_response_code($code);
        require base_path("views/{$code}.php");
    }
}