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

<script>
    function checkPost(form) {
        if (form.text.value == "") {
            alert("Wiadomość jest pusta!");
            form.text.focus();
            return false;
        }
    }
</script>
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

$sql = "SELECT username, text, posts.id FROM users JOIN friends ON friends.user_id2=users.id JOIN posts ON friends.user_id2=posts.user_id WHERE user_id1=" . $_SESSION["id"];
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo"<ul>";
    while($row = $result->fetch_assoc()){
        echo "<li><h4><a href='/Workshop1/users/{$row["username"]}'> {$row["username"]}</a></h4><a href='/Workshop1/posts/{$row["id"]}'>{$row["text"]}</a></li>";
    };
    echo "</ul>";
}
