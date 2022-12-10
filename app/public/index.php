<?php
<<<<<<< Updated upstream
echo "Requested URL: " . $_SERVER['REQUEST_URI'];
phpinfo();
=======
$url= $_SERVER["REQUEST_URI"];
require("../Router/router.php");
$router = new Router();
$router->route($url);


?>
>>>>>>> Stashed changes
