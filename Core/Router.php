<?php
namespace Core;

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller) {
        $this->routes[] = [
            'uri' => $uri,
            'controller'=> $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controllerPath) {
        $this->add('GET', $uri, $controllerPath);
    }    

    public function post($uri, $controllerPath) {
        $this->add('POST', $uri, $controllerPath);
    }
    public function delete($uri, $controllerPath) {
        $this->add('DELETE', $uri, $controllerPath);
    }

    public function patch($uri, $controllerPath) {
        $this->add('PATCH', $uri, $controllerPath);
    }
    
    public function put($uri, $controllerPath) {
        $this->add('PUT', $uri, $controllerPath);
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper(($method))) {
                return require base_path($route['controller']);
            }

        }

        $this->abort();

    }

    protected function abort($code = 404) {
        http_response_code($code);
    
        $date = date_create();
    
        try {
          @require base_path("views/{$code}.php");
        } catch (\Throwable $e) {
          echo 'Unknown error encountered. Please contact the site administrator.' . date_timestamp_get($date);
        }
    
        die();
    }

       
}


//

//function routeToController($uri, $routes) {
    //if (array_key_exists($uri, $routes)) {
            //require base_path($routes[$uri]);
    //} else {
        //abort();
    //}
//}

//
//}
//

