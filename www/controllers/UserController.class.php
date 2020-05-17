<?php
namespace HotelFactory\controllers;
use HotelFactory\core\View;
use HotelFactory\models\User;

class UserController
{
    public function defaultAction()
    {
        echo "User default";
    }

    public function addAction()
    {
        echo "User add";
    }

    public function removeAction()
    {
        echo "L'utilisateur va être supprimé";
    }




    public function loginAction()
    {
        $myView = new View("login", "account");
    }

    public function registerAction()
    {

        $configFormUser = user::getRegisterForm();

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            //Vérification des champs
            $errors = Validator::checkForm($configFormUser ,$_POST);
            //Insertion ou erreurs
            //print_r($errors);
            $user = new user();
            $user->hydrate($_POST);
            $user->save();
        }
        //Insertion d'un user

        // $user->setFirstname($_POST['firstname']);
        // $user->setName($_POST['lastname']);
        // $user->setEmail($_POST['email']);
        // $user->setPassword($_POST['password']);
        // $user->setBirthdate(1);
        // $user->setDd_hf_role(1);
        // $user->setid_hf_company(1);
       
        
        $myView = new View("register", "account");
        $myView->assign("configFormUser", $configFormUser);
    }

    public function forgotPwdAction()
    {
        $myView = new View("forgotPwd", "account");
    }
}
