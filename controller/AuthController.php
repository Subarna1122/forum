<?php

namespace app\controller;
use app\core\controller;
use app\core\request;
use app\model\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout("Auth");
        return $this->render('login');
    }
    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
           
            if ($registerModel->validation() && $registerModel->register()) {
                return "Success";
            }
            echo "<pre>";
            var_dump($registerModel->errors);
            echo "<pre>";
           
            return $this->render('register', [
                'model' => $registerModel
            ]);

               
        }
        $this->setLayout("Auth");
        return $this->render('register', [
            'model' => $registerModel
        ]);

    }
}

