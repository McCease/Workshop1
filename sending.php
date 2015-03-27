<?php
$params=$match["params"];
$username=$params["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1 = $_SESSION["id"];
    $text = $conn->real_escape_string($_POST["text"]);
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user2 = $row['id'];
    }
    $sql = "INSERT INTO messages (user_from , user_to, text) VALUES ($user1 , $user2, '$text')";
    if($result = $conn->query($sql)){
        echo "Wiadomość została wysłana.";

        header("Location: http://localhost/Workshop1/users/$username");
        die();
    };
}

echo "<h2> Piszesz do $username </h2>";
echo "<form method='post' action='' onsubmit='return checkMsg(this);'>";
echo "<input type='text' name='text' value=''><br>";
echo "<button type='submit'>Wyślij wiadomość</button>";
?>
<script>
function checkMsg(form) {
    if (form.text.value == "") {
        alert("Wiadomość jest pusta!");
        form.text.focus();
        return false;
    }
}
</script>