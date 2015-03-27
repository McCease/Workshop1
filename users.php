
<h1>Profil użytkownika</h1><br>

<?php
$params=$match["params"];
$username=$params["username"];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Nazwa użytkownika: " . $row['username'] . "<br>";
    echo "Adres email: " . $row['mail'] . "<br>";
    echo "Imię: " . $row['name'] . "<br>";
    echo "Nazwisko: " . $row['surname'] . "<br>";
}
