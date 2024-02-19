<?php


class Router
{
    /**
     * @var array
     */
    private array $routes = [];

    /**
     * @param string $path
     * @param array $rules
     * @return void
     */
    public function addRoute(string $path, array $rules): void
    {
        $this->routes[$path] = $rules;
    }

    /**
     * @param string $url
     * @param string $method
     * @return void
     * @throws Exception
     */
    public function processRoute(string $url, string $method):void
    {
        $routes = $this->getRoutes();
        if (!$routes){
            throw new Exception('Routes not defined');
        }
        foreach ($routes as $routeUrl => $routeMethods){
            if (strtolower($routeUrl) === $url){
                $controllerAction = $routeMethods[$method] ?? null;
                break;
            }
        }
        if (!isset($controllerAction)){
            header('NOT FOUND', true, 404);
            exit;
        }
        [$controller, $action] = explode('@', $controllerAction);
        if (!isset($controller) && !isset($action)){
            throw new Exception('Invalid route');
        }
        require_once CONTROLLERS_DIR . $controller . '.php';
        $controllerObject = new $controller;
        $controllerObject->$action();
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}