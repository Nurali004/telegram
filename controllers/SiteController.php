<?php
namespace controllers;
use vendor\frame\Mail;
use models\User;
use vendor\frame\Controller;


class SiteController extends Controller{

public function index(){
   
   
   $this->view->render('site/index', [], 'Home page');


}


public function contact(){
    
   $this->render('site/contact');
}

public function about(){
   $this->render('site/about');
}

public function reg(){
   if(isset($_POST["submit"])){
      
      $data = [
         "username"=> $_POST["username"],
         "password"=> $_POST["password"],
         "email"=> $_POST["email"],
         "role"=> 2
      ];
      $user = new User();
      $mail = new Mail();
      $emails = [$data["email"]];
      $mail->send($emails, 'Registiratsiya', "Siz mvc dan muvafaqqiyatli ro'yxatdan o'tdingiz");
      $user->save($data);
      header("Location: /site/login");
      
   }
   
   
   $this->view->render("/site/reg", [], 'Register page');
}
public function login(){
 
   if(isset($_POST["submit"])){
      $data = [
         "username"=> $_POST["username"],
         "password"=> $_POST["password"]

      ];
      $user = new User();
      $user->login($data);

   }
   $this->view->render("site/login", [], 'Login page');
}
public function logout(){
   session_destroy();
   header("Location:/site/login");
}



}
