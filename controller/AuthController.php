<?php

namespace app\controller;

use app\core\Application;
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
           
            if ($registerModel->validation() && $registerModel->save()) {
                Application::$app->session->setFlash('success', 'Thankyou for registering');
                Application::$app->response->redirect("/");
            }
            
            $registerModel->errors;
            
           
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

