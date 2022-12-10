<?php
class Router{
    public function route($url){
      $url = $_SERVER["REQUEST_URI"];
        require("../Controller/HomeController.php");
        
        switch ($url){
            case"/home/index":
            case"/":
            case"/home":    
                $controller=new HomeController();
                $controller->index();
                break;
             case"/home/about":
                $controller = new HomeController();
                $controller->about();
                break;
            case"/login":
                require("../Controller/LoginController.php");
               $controller = new LoginController();
               $controller->login();
                break;
            default:
                echo"404";
                break;
        }
    }
}
?>