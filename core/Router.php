<?php
namespace app\core;
class Router 
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function get(string $path,  $callback):void
     {
        $this->routes['get'][$path] = $callback;

    }
    public function post(string $path,  $callback):void
    {
       $this->routes['post'][$path] = $callback;

   }
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) { 
            $this->response->setStatusCode(404);           
            return $this->renderView("_404");
            exit;
        } 
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)){
            Application::$app->controller = new $callback[0];
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }
        public function renderView($view, $params = [])
        {
            $layoutContent = $this->layoutContent($view) ;
            $renderOnlyView = $this->renderOnlyView($view, $params);
            return str_replace('{{content}}', $renderOnlyView, $layoutContent);
        }
        public function layoutContent($view)
        {
            $layout = Application::$app->controller->layout;
            ob_start();
            include_once Application::$rootdir."/views/layout/$layout.php";
            return ob_get_clean();
        }
        public function renderOnlyView($view, $params)
        {
            foreach ($params as $key => $values)  {
                $$key = $values;
            }
            ob_start();
            include_once Application::$rootdir."/views/$view.php";
            return ob_get_clean();

        }
        
    }



