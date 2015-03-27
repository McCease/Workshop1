<?php
$sql = "SELECT username, mail, name, surname FROM users JOIN friends ON friends.user_id2=users.id WHERE user_id1=" . $_SESSION["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo"<ul>";
    while($row = $result->fetch_assoc()){
        echo "<li><a href='/Workshop1/users/{$row["username"]}'> {$row["username"]}</a><br>{$row["name"]} {$row["surname"]} </li>";
    };
    echo "</ul>";
}else{
    echo"Nie masz jeszcz znajomych.";
}