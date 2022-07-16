<?php

namespace app\core;

class Application
{
    public static string $rootdir;
    public Router $router;
    public Request $request;
    public Response $response;
    public static $app;
    public controller $controller;

   
    public function __construct($rootpath)
    {
        $this->controller = new controller();
        self::$rootdir = $rootpath;
        self::$app = $this;
        $this->response = new response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);      
    }

    public function run():void
     {
        echo $this->router->resolve();
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setControler(controller $controller)
    {
        $this->controller = $controller;
    }
}



