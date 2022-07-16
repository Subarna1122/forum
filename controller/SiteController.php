<?php
namespace app\controller;

use app\core\Application;
use app\core\controller;
use app\core\request;
class SiteController extends controller
{  
    public function home()
    {
        $params = [
            "name" => "user"
        ];
      return $this->render('homepage', $params);
    }
    public function replyPage()
    {
       return $this->render('replypage');
    }
    public function handleQuestion(Request $request)
    {
        $body = $request->getBody();
        echo "<pre>";
        print_r($body);
        echo "<pre>";
        
    }
}