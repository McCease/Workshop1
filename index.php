<?php
    header('Content-type: text/html; charset=utf-8');

    require 'AltoRouter.php';
    require 'connection.php';

    $router = new AltoRouter();
    $router->setBasePath('/Workshop1');
    $router->map('GET|POST','/', 'login.php');
    $router->map('GET|POST','/main', 'main.php');

    $match = $router->match();

var_dump($match);
?>

<!doctype html>
<html>
    <head>
        <title>20</title>
    </head>
    <body>
        <?php
        require('header.php');

        if($match){
            require $match['target'];
        }
        else{
            require('404.php');
        }

        require('footer.php');

        $conn->close();
        $conn = null;
        ?>
    </body>
</html>