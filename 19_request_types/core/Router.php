<?php

class Router
{
    public $routes = [

        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        //Create a new instance of the Router object BECAUSE it is then required by the 'require $file' below in order
        //to call the define function below (refer back to the index.php file)

        $router = new self;
        //Interesting syntax = this gives me a new instance of a Router object. You can also do new static();

        require __DIR__ . "/../$file";

        return $router; //Return a router instance so that I can chain function calls within index.php

    }

    public function direct($uri, $requestType)
    {
        //Given the current URI that the user has requested, if this matches a route, load the route controller...

        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->routes[$requestType][$uri];
        }

        // If no route found, throw an exception
        throw new Exception('No route found for this URI');
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }
}