<?php
    header('Content-type: text/html; charset=utf-8');

    require 'AltoRouter.php';
    require 'connection.php';
//przekierowania
    $router = new AltoRouter();
    $router->setBasePath('/Workshop1');
    $router->map('GET|POST','/', 'login.php');
    $router->map('GET|POST','/main', 'main.php');
    $router->map('GET|POST','/messages', 'messages.php');
    $router->map('GET|POST','/friends', 'friends.php');
    $router->map('GET|POST','/users/[*:username]', 'users.php');
    $router->map('GET|POST','/settings/[*:username]', 'settings.php');
    $router->map('GET|POST','/logout', 'logout.php');
    $router->map('GET|POST','/send_message_to/[*:username]', 'sending.php');
    $router->map('GET|POST','/posts/[i:post_id]', 'post.php');

    $match = $router->match();
    session_start();
?>

<!doctype html>
<html>
    <head>
        <title>20</title>
        <link href="main.css" rel="stylesheet">
    </head>
    <body>

        <?php

/* Sprawdzanie stanu logowania:
    niezalogowany - na strone logowania
    zalogowany - na dowolną inną niż strona logowania
*/
        if($match){
            require('header.php');
            if($match['target']!='login.php'){
                if($_SESSION["id"]){
                    require $match['target'];
                }else{
                    header("Location: http://localhost/Workshop1/");
                }
            }else {
                if($_SESSION["id"]){
                    header("Location: http://localhost/Workshop1/main");
                } else{
                    require $match['target'];
                }
            }
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