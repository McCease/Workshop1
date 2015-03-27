<?php




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1 = $_SESSION["id"];
    $text = $conn->real_escape_string($_POST["text"]);

    $sql = "INSERT INTO comments (user_id , post_id, text) VALUES ($user1 , {$match["params"]["post_id"]}, '$text')";
    if($result = $conn->query($sql)){
        echo "<br>Komentarz został zamieszczony.";
    };
}





$sql = "SELECT username, text FROM users JOIN posts ON posts.user_id=users.id WHERE posts.id={$match["params"]["post_id"]}";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo"<h2>Autor: {$row["username"]}</h2>";
    echo"{$row["text"]}<br>";

    echo "<h2> Skomentuj to: </h2>";
    echo "<form method='post' action='' onsubmit='return checkComment(this);'>";
    echo "<input type='text' name='text' value='' placeholder='Co o tym sądzisz?' maxlength='60'><br>";
    echo "<button type='submit'>Opublikuj komentarz</button>";



    echo"<h3>Komentarze:</h3><br>";

    $sql = "SELECT username, text FROM comments JOIN users ON comments.user_id=users.id WHERE comments.post_id={$match["params"]["post_id"]} ORDER BY comments.id DESC";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo"<ul>";
            while($row = $result->fetch_assoc()){
                echo "<li><h4>Autor: {$row["username"]}</h4>{$row["text"]} </li>";
            };
            echo "</ul>";
        } else {
            echo"Ten wpis jeszcze nie ma komentarzy, możesz być pierwszy.";
        }

    }else {
    echo "Nie ma takiego wpisu.";
}

?>
<script>
    function checkComment(form) {
        if (form.text.value == "") {
            alert("Komentarz jest pusty!");
            form.text.focus();
            return false;
        }
    }
</script>