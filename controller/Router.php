<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute($url,$controller)
    {
        $this->routes[$url] = $controller;
    }

    public function handleRequest($url){
        if(array_key_exists($url,$this->routes)){
            $controller = $this->routes[$url];
            $this->callController($controller);
        }else{
            $this->getErrorPage($url);
        }
    }

    private function callController($controller){
        list($classname, $method) = explode("::", $controller); 
         if(class_exists($classname)){
            $controllerInstance = new $classname();
               if(method_exists($controllerInstance, $method)){
                  $controllerInstance->$method();
               }else{
                  $this->getErrorPage($controller);
               }
         }else{
              $this->getErrorPage($controller);
         }
    }

    private function getErrorPage($url){
        header("HTTP/1.0 404 Not Found");
        die(strtoupper("error 404 $url not found"));
    }
}









