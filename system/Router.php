<?php

namespace Kev;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    /**
     * @param $regexp
     * @param array $route
     */
    public static function setRoutes($regexp, array $route=[]):void
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    /**
     * @param string $url
     * @return string
     */
    protected static function removeQueryString(string $url): string
    {
        if($url){
            $params = explode('&', $url, 2);
            if(false === str_contains($params[0], '=')){
                return rtrim($params[0], '/');
            }
        }
        return '';
    }

    /**
     * @throws \Exception
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);

        if(self::matchRoute($url)){

           $controller = 'App\Controllers\\'.self::$route['admin_prefix'].self::$route['controller'];

           if(class_exists($controller)){

               /** @var Controller $controllerObject */
               $controllerObject = new $controller(self::$route);

               $controllerObject->getModel();

               $action = self::lowerCamelCase(self::$route['action']);

               if(method_exists($controllerObject, $action)){

                   $controllerObject->$action();
                   $controllerObject->getView();

               }else{
                   throw new \Exception("Method {$controller} -> {$action} not found");
               }
           }else{
               throw new \Exception("Controller {$controller} not found", 404);
           }

        }else{
            throw new \Exception("Page not found", 404);
        }
    }

    public static function matchRoute($url): bool
    {
        foreach(self::$routes as $pattern => $route){
            if(preg_match("#{$pattern}#", $url, $matches)){
                foreach($matches as $key => $value){
                    if(is_string($key)) $route[$key] = $value;
                }

                if(empty($route['action'])) $route['action'] = 'index';

                if(!isset($route['admin_prefix'])){
                    $route['admin_prefix'] = '';
                }else{
                    $route['admin_prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);

                self::$route = $route;

                return true;
            }
        }
        return false;
    }

    /**
     *  ...to CamelCase
     * @param $name
     * @return string
     */
    protected static function upperCamelCase($name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-',' ', $name)));
    }

    /**
     *  ...to camelCase
     * @param $name
     * @return string
     */
    protected static function lowerCamelCase($name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}