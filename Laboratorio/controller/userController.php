<?php

class UserController{

     private $view;
     private $user;
     private $products;

     public function __construct(){
        $this->view = new Views("./view");
        $this->user = new User();
        $this->products = new Product();
     }

     public function index(){ //validacion para entrar al ecomerce
        if(isset($_POST['mail']) && isset($_POST['password'])){
            $user = $_POST['mail'];
            $password = $_POST['password'];

            $dbUser = $this->user->get_user($user,$password);

         if($dbUser != null){
            $_SESSION['user'] = $dbUser;
            header('Location:'.ROUTE.'home');
         }else{
            header('Location:'.ROUTE);
         }

        }else if(isset($_SESSION['user'])){
         header('Location:'.ROUTE.'home');
        } else{
            $this->view->render('index');
        }
     }

     public function login(){ // pagina principal
       if(isset($_SESSION['user'])){
         $availableProducts = $this->products->get_products();

         $this->view->render('/partial/header');
         $this->view->render('home', ['productos' => $availableProducts]);
         $this->view->render('/partial/footer');
       }else{
         header('Location:'.ROUTE);
       }
     }

     public function logout(){ //cerrar la sesion
      if(isset($_SESSION['user'])){
        session_destroy();
        header('Location:'.ROUTE);
      }
     }

     public function register() { // Registrar cliente
      if (isset($_POST['fullname']) && isset($_POST['mail']) && isset($_POST['phone']) && isset($_POST['id']) && isset($_POST['typeid'])) {
          
          $fullName = $_POST['fullname'];
          $mail = $_POST['mail'];
          $phone = $_POST['phone'];
          $id = $_POST['id'];
          $typeID = $_POST['typeid'];
  
          $client = $this->user->get_client($id, $typeID);
  
          if ($client != null) {
              $this->user->update_client($id, $typeID, $fullName, $mail, $phone);
          } else {
              $this->user->set_client($fullName, $mail, $phone, $id, $typeID);
              $client = $this->user->get_client($id, $typeID);
          }
          header('Location:'.ROUTE.'save?id='.$client['id']);
  
      } else {
          $this->view->render('/partial/header');
          $this->view->render('clientForm');
          $this->view->render('/partial/footer');
      }
  }


}