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
    public function route($uri, $method) {
        
        // $uri  = /notes/user/neluttu
        // $route['uri'] = /notes/user/{user}

        foreach($this->routes as $route) {

            $getParams = self::getParamMatches($uri, $route['uri']);
            $reqUri = $getParams['reqUri'];
            $params = $getParams['params'];

            if((preg_match("/$reqUri/", $route['uri']) or $route['uri'] === $uri) and $route['method'] === strtoupper($method))
            {
                
                Middleware::resolve($route['middleware'], $route['redirect']);    
                return require base_path('Http/controllers/' . $route['controller']);
            }

        }
        $this->abort();
    }

    protected function abort($code = 404) {
        http_response_code($code);
        require base_path("views/{$code}.php");
    }

    protected static function getParamMatches($uri, $route) {

            $params = [];
            $paramKey = [];
            
            preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

            if(!empty($paramMatches)) {
                foreach($paramMatches[0] as $key)
                $paramKey[] = $key;

                $reqUri = $uri;
                $URI = explode("/", $route);

                $indexNum = [];

                foreach($URI as $index => $param)
                    if(preg_match("/{.*}/", $param)) $indexNum[] = $index;

                $reqUri = explode("/", $reqUri);

                foreach($indexNum as $key => $index) {
                    if(!empty($reqUri[$index])) {

                        $params[$paramKey[$key]] = $reqUri[$index];
                        $reqUri[$index] = "{.*}";
                    }
                }

                $reqUri = implode("/", $reqUri);
                $reqUri = str_replace("/", '\\/', $reqUri);
                
                return ['reqUri' => $reqUri, 'params' => $params];
        }

    }
}

?>