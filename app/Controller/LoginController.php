<?php
class LoginController{
    
    public function login(){
    require("../View/Login/login.php");

      
    }

    //should process requests to /home/about
   public  function about(){
        echo"This is the about page of our website";
    }
}
?>