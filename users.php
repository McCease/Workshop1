
<h1>Profil użytkownika</h1><br>

<?php






$params=$match["params"];
$username=$params["username"];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user2 = $row['id'];
    echo "Nazwa użytkownika: " . $row['username'] . "<br>";
    echo "Adres email: " . $row['mail'] . "<br>";
    echo "Imię: " . $row['name'] . "<br>";
    echo "Nazwisko: " . $row['surname'] . "<br>";


    $sql = "SELECT * FROM friends WHERE user_id1='{$_SESSION["id"]}' AND user_id2='$user2'";
    $result = $conn->query($sql);
    if($result->num_rows === 0) {
        if($user2!=$_SESSION["id"]){
            echo"<form name='friending' method='post' action=''><button name='friendship' value='$user2' type='submit'>Dodaj do znajomych</button></form><br>";
        }
    }

} else {
    echo"<h2>Nie ma takiego użytkownika</h2>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user1=$_SESSION["id"];
    $sql = "INSERT INTO friends (user_id1 , user_id2) VALUES ($user1 , $user2), ($user2 , $user1)";
    var_dump($sql);
    if($result = $conn->query($sql)){
        echo "Przyjaźń została zawarta";

        header("Location: http://localhost/Workshop1/users/$username");
        die();
    };
}

$sql = "SELECT * FROM posts JOIN users ON users.id=posts.user_id WHERE users.username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo"<ul>";
    while($row = $result->fetch_assoc()){
        echo '<li>'. $row["text"] .'</li>';
    };
    echo "</ul>";
}
