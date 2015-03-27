<h1> NAGLOWEK GORNY </h1>


<?php
if(sizeof($_SESSION)>0){
    echo '<h2> Czesc <a href="/Workshop1/users/'. $_SESSION["username"] . '">'. $_SESSION["username"] . '</a></h2>
            <span>
                <a href="/Workshop1/main">Główna</a>
            </span>
            <span>
                <a href="/Workshop1/messages">Wiadomosci</a>
            </span>
            <span>
                <a href="/Workshop1/friends">Znajomi</a>
            </span>
            <span>
                <a href="/Workshop1/settings/'. $_SESSION["username"] . '">ustawienia</a>
            </span>
            <span>
                <a href="/Workshop1/logout">Wyloguj</a>
            </span>';
} else{
    echo "Jesteś niezalogowany, prosimy zrób to poniżej. Jeżeli jeszcze nie masz konta, zapraszamy do rejestracji.";
}