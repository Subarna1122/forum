<?php

namespace app\core;

class Application
{
    public static string $rootdir;
    public Router $router;
    public Database $db;
    public Request $request;
    public Response $response;
    public static $app;
    public controller $controller;
    public session $session;

   
    public function __construct($rootpath, array $config)
    {
        $this->controller = new controller();
        self::$rootdir = $rootpath;
        self::$app = $this;
        $this->response = new response();
        $this->session = new session();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);      
        $this->db = new Database($config['db']);
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



