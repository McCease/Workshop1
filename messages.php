<?php
echo"<h2>INBOX</h2><ul>";

//Pobieranie wiadomości przychodzących

$sql = "SELECT messages.id, username, user_from, user_to, topic, is_read  FROM messages JOIN users on messages.user_from=users.id WHERE user_to={$_SESSION["id"]} ORDER BY is_read";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        if($row['is_read']==='0'){
            echo"Nieprzeczytana!<br>";
        }
        $usrn=$row['username'];
        echo "<li><h4>Od $usrn</h4><h2><a href='/Workshop1/single_msg/id>{$row['topic']}</a></h2> <a href='/Workshop1/send_message_to/$usrn'><br><button>Odpowiedz</button></a></li>";
    };

}else{
    echo "<li>Nie masz żadnych wiadomośc</li>";
}
echo "</ul>";

echo"<h2>OUTBOX</h2><ul>";

//Pobieranie wiadomości wychodzących

$sql = "SELECT messages.id, username, user_from, user_to, topic, text, is_read FROM messages JOIN users on messages.user_to=users.id WHERE user_from={$_SESSION["id"]} ORDER BY is_read";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()){
        if($row['is_read']==='0'){
            echo"Nieprzeczytana!<br>";
        }
        echo "<li><h4>Do {$row['username']}</h4><h2>{$row['topic']}</h2>{$row['text']}</li>";

    };

}else{
    echo "<li>Nie masz żadnych wiadomośc</li>";
}

echo "</ul>";