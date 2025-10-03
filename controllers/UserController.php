<?php
namespace controllers;
use models\User;
use vendor\frame\Controller;


class UserController extends Controller {
    public function list(){
         $user = new User();
         $result = $user->getList();
         $pagecount = $user->getCountPage();
         
             
      $this->render('user/list', ['users'=>$result,
      'pagecount'=>$pagecount], 'User list page');
    
  

    }
    public function view($id){
        $user = new User();
        $result = $user->getById($id);
      
     $this->render('user/view', ['user' => $result], 'User view page');
    }
     public function add(){
        if(isset($_POST['submit'])){

            $target_dir = "uploads/user/";
            $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image_file"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
            }else{
                echo "File is not an image.";
            }
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";

            }else{
                if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["image_file"]["name"]). " has been uploaded.";

                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }


            $user = new User();
            $data = [
                'username'=> $_POST['username'],
                'email'=> $_POST['email'],
                'password'=> $_POST['password'],
                'phone'=> $_POST['phone'],
                'image'=> $target_file,
                'role'=> $_POST['role']
            ];
            $user->save($data);
            header('Location:/user/list');
            exit();
        }
        $this->render('user/add', [], 'User add page');
        

     }
     public function update($id){
        $user = new User();
        if(isset($_POST['submit'])){

            if ($_FILES["image_file"]["name"] != "") {



            $target_dir = "uploads/user/";
            $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image_file"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
            }else{
                echo "File is not an image.";
            }
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            }else{
                if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["image_file"]["name"]). " has been uploaded.";
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }

                $data = [
                    'username'=> $_POST['username'],
                    'email'=> $_POST['email'],
                    'password'=> $_POST['password'],
                    'phone'=> $_POST['phone'],
                    'role'=> $_POST['role'],
                    'image'=> $target_file

                ];

            }

            $user->update($id,$data);
            header('Location: /user/list');
            exit();
        }
        $result = $user->getById($id);
      
     $this->render('user/update', ['user' => $result], 'User edit page');
    }

    public function change($id = null){
        $user = new User();
        if (isset($_SESSION['user']->id)) {
            $id = $_SESSION['user']->id;
        }

        if(isset($_POST['submit'])){

            if ($_FILES["image_file"]["name"] != "") {



                $target_dir = "uploads/user/";
                $target_file = $target_dir . basename($_FILES["image_file"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["image_file"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                }else{
                    echo "File is not an image.";
                }
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                }
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                }else{
                    if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
                        echo "The file ". basename( $_FILES["image_file"]["name"]). " has been uploaded.";
                    }else{
                        echo "Sorry, there was an error uploading your file.";
                    }
                }

                $data = [
                    'username'=> $_POST['username'],
                    'email'=> $_POST['email'],
                    'password'=> $_POST['password'],
                    'phone'=> $_POST['phone'],
                    'role'=> $_POST['role'],
                    'image'=> $target_file

                ];

            }

            $user->update($id,$data);
            header('Location: /user/about');
            exit();
        }




        $result = $user->getById($id);


        $this->render('user/change', ['results' => $result], 'User edit page');
    }
    public function delete($id){
        $user = new User();
        $user->delete($id);
        header('Location:/user/list');
        exit();
    }

    public function about($id = null){

        $user = new User();
        if ($id == null && isset($_SESSION['user']->id)) {
            $id = $_SESSION['user']->id;
        }
        $result = $user->getById($id);
        if ( $result && $result->username == $_SESSION['user']->username) {
            $this->render('user/about', ['users' => $result], 'User about page');
        }

    }
    

}