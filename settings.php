
<h1>Zmiana ustawien</h1><br>
<script>
    //Sprawdzenie hasła - minimum 6 znaków w tym jedna cyfra i jedna wielka litera

    function checkPassword(str)
    {
        var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
        return re.test(str);
    }

    //Sprawdzenie czy hasło jest podane, i czy podane hasła są ze sobą zgodne
    function checkForm(form) {
        if (form.password1.value != '' && form.password2.value != '') {
            if (form.password1.value != "" && form.password1.value == form.password2.value) {
                if (!checkPassword(form.password1.value)) {
                    alert("Hasło musi posiadać conajmniej: 6 znaków, jedną małą, jedną wielką literę, jedną cyfrę i nie może zawierać znaków specjalnych.");
                    form.password1.focus();
                    return false;
                }
            } else {
                alert("Błąd: Upewnij się, że podałeś poprawnie hasło");
                form.password1.focus();
                return false;
            }
            return true;
        }
    }

</script>

<?php

$params=$match["params"];
$username=$params["username"];
//Zmiana ustawień użytkownika na serwerze

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $conn->real_escape_string($_POST["name"]);
    $new_pass = $conn->real_escape_string($_POST["password1"]);
    $surname = $conn->real_escape_string($_POST["surname"]);
    $pass = $conn->real_escape_string($_POST["password"]);
    $sql = "SELECT * FROM users WHERE (username = '$username')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $hashed_pass = $row['password'];
        if(password_verify($pass, $hashed_pass)){

            if($new_pass!='') {
                //Zmiana danych i hasła
                $options = ['cost' => 11, 'salt' => mcrypt_create_iv(22, MCRYPT_RAND),];
                $hashedPass = password_hash($new_pass, PASSWORD_BCRYPT, $options);

                $sql = "UPDATE users SET name='$name', surname='$surname', password='$hashedPass' WHERE username = '$username'";
                $result = $conn->query($sql);

                echo "Dane i hasło poprawnie zmienione";
                die();
            }else {
                //Zmiana tylko danych
                $sql = "UPDATE users SET name='$name', surname='$surname' WHERE (username = '$username')";
                $result = $conn->query($sql);
                echo "Dane poprawnie zmienione";

                die();
            }
        }else {
            echo "Błędne dane logowania.";
        }
    }

}


//Pobieranie danych uzytkownika

if($username===$_SESSION["username"]) {
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Nazwa użytkownika: {$row['username']}<br>";
        echo "Adres email: {$row['mail']}<br>";
        echo "<form method='post' name='modify' action='' onsubmit='return checkForm(this);'>Imię: <input type='text' name='name' value={$row['name']}><br>";
        echo "Nazwisko: <input type='text' name='surname' value={$row['surname']}><br>";
        echo "Stare hasło (wymagane do dokonania jakichkolwiek zmian): <input type='password' name='password' required><br>";
        echo "Nowe hasło <input type='password' value='' name='password1'><br>";
        echo" <input type='password' value='' name='password2'><br>";
        echo "<button type='submit'>Zmień dane</button></form>";

    }
}