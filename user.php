<?php 

class User {
    private $email ;
    private $password;
    private $role;
    private $logedIn;
    public static $error = "";
    
    public function __construct($data){
        $this->email = $data['email'] ;
        $this->role = $data['role'] ? $data['role'] : 'guest';
        $this->logedIn = false ;
        $this->password = password_hash($data['password'],PASSWORD_DEFAULT,['cost'=> 12]);
    }

        public static function login($email,$password){

            if(empty($email)){
                self::$error = "Veuillez entrer votre email !" ; 
            }
            else if(empty($password)){
                self::$error = "Veuillez entrer votre mot de passe !" ; 
            }
            else{
                $db = new Database ;
                $sql = "SELECT * FROM users WHERE email = ? ;";
                $stmt = $db->query($sql,array($email));

                if($stmt->rowCount() == 1){
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if(password_verify($password,$user['password'])){
                           
                            $_SESSION["userID"] = $user['id'] ;
                            header('Location: index.php') ;
                            
                        }else{
                            self::$error = "mot de passe incorrect" ;
                        }
                        
                      
                }
                else {
                        
                        self::$error = "email n'existe pas" ;
                }
            }
          
        }
        public  static  function clean($data){
            if(!empty($data)){
                $data = trim($data) ;
                $data = htmlspecialchars($data) ;
                $data = stripcslashes($data) ;
                return $data ;
            }
        }
    
        public function signUp(){
            $database = new Database ;
            $user_query = "INSERT INTO users(email,password,role) VALUES(?,?,?);";
            $data = array($this->email,$this->password,$this->role);
            $stmt1 = $database->query($user_query,$data);
            
            if($stmt1){
                header("Location: login.php");
                }
    
               
            }

            public function add(){
                $database = new Database ;
                $user_query = "INSERT INTO users(email,password,role) VALUES(?,?,?);";
                $data = array($this->email,$this->password,$this->role);
                $stmt1 = $database->query($user_query,$data);
                
                if($stmt1){
                    header("Location: index.php");
                }
        
                   
                }

                public function update($id){
                    $database = new Database ;
                    $user_query = "UPDATE users SET email=?,password=?, role=? WHERE id=? ";
                    $data = array($this->email,$this->password,$this->role, $id);
                    $stmt = $database->query($user_query,$data);
                    
                    if($stmt){
                        header("Location: index.php");
                    }
            
                       
                    }

                    public static function delete_user($current_user_id,$id){
                        $database = new Database ;
                        $user_query =  "DELETE FROM users WHERE id=?";
                        $data = array($id);
                        $stmt = $database->query($user_query,$data);
                        
                        if($stmt){
                            if($id == $current_user_id){
                                session_destroy();
                                header("location: login.php");
                            }
                            else{
                                header("location: index.php");
                            }

                        }
                
                           
                        }

                    public static function get_user($id){
                        $database = new Database ;
                        $user_query = "SELECT * from users WHERE id=?";;
                        $data = array($id);
                        $stmt = $database->query($user_query,$data);
                        
                        $user = $stmt->fetch();
                           
                        return $user ;
                        }
                
            


    public function logout(){
        $this->logedIn = false ;
    }
    public function getEmail(){
        return "$this->email" ;
    }
    public function getRole(){
        return "$this->role" ;
    }
 
}

?>