<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $text = $conn->real_escape_string($_POST["text"]);
    $is_private = $conn->real_escape_string($_POST["is_private"]);


    $sql = "INSERT INTO posts (text, is_private, user_id) VALUES ('$text' , '$is_private' , " . $_SESSION["id"] . ")";
    if($result = $conn->query($sql)) {
        header("Location: http://localhost/Workshop1/main");
        echo "Wpis opublikowany";
        die();
    }
}

?>

<h1> STRONA GLOWNA </h1>


<form method="post" action="" onsubmit="return checkPost(this);">
    <fieldset>
        <input type="text" placeholder="Powiedz nam co myślisz" required name="text" value="" maxlength="140"><br>
        <input type="radio" name="is_private" value="0" checked> Publiczny
        <input type="radio" name="is_private" value="1" > Prywatny
    </fieldset>
    <button type="submit">Opublikuj</button>
</form>
<?php

$sql = "SELECT * FROM posts WHERE user_id=" . $_SESSION["id"];
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo"<ul>";
        while($row = $result->fetch_assoc()){
            echo '<li>'. $row["text"] .'</li>';
        };
        echo "</ul>";
}