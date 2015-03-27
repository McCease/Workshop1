<?php
$sql = "SELECT messages.id, username, user_from, user_to, text, is_read  FROM messages JOIN users on messages.user_from=users.id WHERE user_to={$_SESSION["id"]} ORDER BY is_read";
$result = $conn->query($sql);
echo"<h2>INBOX</h2><ul>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        if($row['is_read']==='0'){
            echo"Nieprzeczytana!<br>";
        }
        echo "<li><h4>Od {$row['username']}</h4>{$row['text']} <a href='/Workshop1/send_message_to/$username'><br><button>Odpowiedz</button></a></li>";
    };

}else{
    echo "<li>Nie masz żadnych wiadomośc</li>";
}
echo "</ul>";

echo"<h2>OUTBOX</h2><ul>";
$sql = "SELECT messages.id, username, user_from, user_to, text, is_read FROM messages JOIN users on messages.user_to=users.id WHERE user_from={$_SESSION["id"]} ORDER BY is_read";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()){
        if($row['is_read']==='0'){
            echo"Nieprzeczytana!<br>";
        }
        echo "<li><h4>Do {$row['username']}</h4>{$row['text']}</li>";

    };

}else{
    echo "<li>Nie masz żadnych wiadomośc</li>";
}

echo "</ul>";