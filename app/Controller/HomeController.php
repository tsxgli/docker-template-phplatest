<?php
class HomeController{
    //should process requests to / and /home/index
    public function index(){
       require("../Repository/ArticleRepository.php");
       $repository= new ArticleRepository();
       $articles= $repository->getAll();
       print_r($articles);

       require("../View/Home/index.php");
    }

    //should process requests to /home/about
   public  function about(){
        echo"This is the about page of our website";
    }
}
?>