<?php

class UserValidator {

    private $data;
    private $errors = [];
    private static $fields = ['email', 'role','password'];
  
    public function __construct($post_data){
      $this->data = $post_data;
    }
    public function getData(){
      return $this->data;
    }
    public function validateForm(){
      foreach(self::$fields as $field){
        if(!array_key_exists($field, $this->data)){
          trigger_error("'$field' is not present in the data");
          return;
        }
      }
  
      $this->validateEmail();
      $this->validateRole();
      $this->validatePassword() ;
      return $this->errors;
  
    }
  private  function clean_data($data){
    $data = trim($data) ;
    $data = htmlspecialchars($data) ;
    $data = stripcslashes($data) ;
    return $data ;
}

    private function validateRole(){
      $val = $this->clean_data($this->data['role']);
      if(empty($val)){
        $this->addError('role', 'Role est obligatoire');
      } 
    }

    private function validateEmail(){
      $val = $this->clean_data($this->data['email']);
  
      if(empty($val)){
        $this->addError('email', 'Email est obligatoire');
      } else {
        if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
          $this->addError('email', 'Email entré est invalide');
        }
      }
       //check the user has already signed up

       $sql = "SELECT email FROM users WHERE email = ?";
       $database = new Database ;
       $stmt = $database->query($sql,array($val));
       if($stmt->rowCount() > 0){
         $this->addError('email','Cet email a déjà été enregistrée');
       }
  
    }

    private function validatePassword(){
        $val1 = $this->clean_data($this->data['password']);
        // une validation simple
          if(strlen($val1) == 0){
            $this->addError('password', 'Enter votre mot de passe');
          }
    }

    private function addError($key, $val){
      $this->errors[$key] = $val;
    }
  
}