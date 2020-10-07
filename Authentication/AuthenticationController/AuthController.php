<?php

include '../databaseconn.php';
class AuthController extends Database{
    private $username,$password;
    public function __construct()
    {
        parent::__construct();   
    }

    function validateUser($username){
        if(preg_match('/\\s+/',$username) || empty($username)){
            return 0;
        }else{
            return 1;
        }
    }

    function validatePass($password){
        if(preg_match('/\\s+/',$password) || empty($password)){
            return 0;
        }else{
            return 1;
        }
    }

    function loginUser($username,$password){
        $statusUser=$this->validateUser($username);
        $starusPass=$this->validatePass($password);

        if(!$starusPass && !$statusUser){
            // both fiels are empty
            header('location:../Clerk/index.php');
        }
        elseif(!$starusPass){
            $query="SELECT * FROM `user` WHERE `username`='.$username.'";
            $result=$this->conn->query($query);
            $row=$result->fetch_assoc();
            if($row['statusFlag']==0){// 0 is reset
                header('location:./reset.html');
                session_start();
                $_SESSION['user']=$username;
            }else{
                // password field is empty
            }

        }elseif(!$statusUser){
            // username field is empty
        }else{
            echo "came in to the else part  ".$username. " ".$password;
            echo "came in to the else part";
            $query="SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'";

            $result=$this->conn->query($query);
            // $result2=$result->fetch_assoc();
            
            if($result->num_rows==1){
                $row1=$result->fetch_assoc();
                if($row1['statusFlag']==1){
                    session_start();
                    $_SESSION['user']=$username;
                    switch($row1['occuFlag']){
                        case 1: header('location:../Clerk/index.php');break;
                        // case 2:header('location:./Clerk.html');break;
                        // case 3:header('location:./storekeeper.html');break;
                        // case 4:header('location:./technician.html');break;
                        default: session_destroy();
                    }
                }else if($row1['statusFlag']==0){
                    header('location:./reset.html');
                    session_start();
                    $_SESSION['user']=$username;
                }else{
                    // Account has banned
                }
            }else{
                //alert "wrong credentials"
            }

        }
    } 

}

?>