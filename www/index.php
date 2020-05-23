<?php
use HotelFactory\Core\ConstantLoader;

session_start();
function myAutoloader($class)
{
    $class = explode("\\",$class)[count(explode("\\",$class))-1];
    if (file_exists("Core/".$class.".class.php"))
    {
        include "Core/".$class.".class.php";
    }
    elseif (file_exists("Models/".$class.".model.php"))
    {
        include "Models/".$class.".model.php";
    }
    elseif (file_exists("Managers/".$class.".class.php"))
    {
        include "Managers/".$class.".class.php";
    }
}

spl_autoload_register("myAutoloader");

new ConstantLoader();

$uri = $_SERVER["REQUEST_URI"];
$uri = explode('?',$uri)[0];
if ($uri[strlen($uri)-1] == '/' && $uri != '/') $uri = substr($uri, 0, strlen($uri)-1);


$listOfRoutes = yaml_parse_file("routes.yml");


if (!empty($listOfRoutes[$uri])) {
    $c =  ucfirst($listOfRoutes[$uri]["controller"])."Controller";
    $a =  $listOfRoutes[$uri]["action"]."Action";

    $pathController = "Controllers/".$c.".class.php";

    $c = "\\HotelFactory\\Controllers\\".$c;
    if (file_exists($pathController)) {
        include $pathController;
        //Vérifier que la class existe et si ce n'est pas le cas faites un die("La class controller n'existe pas")
        if (class_exists($c)) {
            $controller = new $c();

            //Vérifier que la méthode existeet si ce n'est pas le cas faites un die("L'action' n'existe pas")
            if (method_exists($controller, $a)) {

                //EXEMPLE :
                //$controller est une instance de la class UserController
                //$a = userAction est une méthode de la class UserController
                $controller->$a();
            } else {
                die("L'action' n'existe pas");
            }
        } else {
            die("La class controller n'existe pas");
        }
    } else {
        die("Le fichier controller n'existe pas");
    }
} else {
    die("L'url n'existe pas : Erreur 404");
}
