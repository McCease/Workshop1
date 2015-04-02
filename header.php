<?php
if(sizeof($_SESSION)>0){
    echo '<nav class="navbar-fixed-top"><div class="container"><br>
            <h3> Czesc <a href="/Workshop1/users/'. $_SESSION["username"] . '">'. $_SESSION["username"] . '</a></h3>
            <span>
                <a href="/Workshop1/main"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
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
            </span>
           </div></nav>';
} else{
    echo '<nav class="navbar-fixed-top">
            <div class="container">
            Jesteś niezalogowany, prosimy zrób to poniżej. Jeżeli jeszcze nie masz konta, zapraszamy do rejestracji.
            </div>
            </nav>';
}


