
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Rejestracja - założenie nowego konta - dodanie parametrów nowego konta do obecnej sesji
    $username = $conn->real_escape_string($_POST["username"]);
    $pass = $conn->real_escape_string($_POST["password1"]);
    if(sizeof($_POST)>2){
        $email = $conn->real_escape_string($_POST["email"]);
        $name = $conn->real_escape_string($_POST["name"]);
        $surname = $conn->real_escape_string($_POST["surname"]);
        $options=['cost'=>11,'salt'=>mcrypt_create_iv(22,MCRYPT_RAND),];
        $hashedPass= password_hash($pass,PASSWORD_BCRYPT,$options);

        $sql = "INSERT INTO users (username, mail, name, surname, password) VALUES ('$username', '$email', '$name', '$surname', '$hashedPass')";
        if($result = $conn->query($sql)){

            $_SESSION["username"] = $username;
            $_SESSION["id"] = mysqli_insert_id($conn);
            header("Location: http://localhost/Workshop1/main");

            die();
        } else {
            echo "Login lub e-mail juz zajete";
        }
    } else {
        //Logowanie wraz z pobraniem parametrow konta do obecnej sesji
        $sql = "SELECT * FROM users WHERE (username = '$username' OR mail='$username')";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $hashed_pass = $row['password'];

            if(password_verify($pass, $hashed_pass)){

                $_SESSION["username"] = $row['username'];
                $_SESSION["id"] = $row['id'];
                header("Location: http://localhost/Workshop1/main");

                die();
            }else{
                echo "Błędne dane logowania.";
            }

        }
    }
}
?>


<script>
        //testowanie hasłą - 6 znaków duża litera i cyfra
        function checkPassword(str)
        {
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{6,}$/;
            return re.test(str);
        }
        //test formularza - uzupełnienie pól, właściweość wprowadzenia danych
        function checkForm(form)
        {
            if(form.username.value == "") {
                alert("Błąd: Nie podałeś nazwy użytkownika");
                form.username.focus();
                return false;
            }
            re = /^\w+$/;
            if(!re.test(form.username.value)) {
                alert("Błąd: Nazwa użytkownika może zawierać tylko litery, cyfry i znak podkreślenia.");
                form.username.focus();
                return false;
            }
            if(form.password1.value != "" && form.password1.value == form.password2.value) {
                if(!checkPassword(form.password1.value)) {
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

    </script>

<div class="container">
    <div class="row">
        <div class="col">

            <form class="form-signin" name="registration" method="post" action="" onsubmit="return checkForm(this);">

                    <input type="email" value="" name="email" required placeholder="Adres e-mail"><br>
                    <input type="text" value="" name="username" required placeholder="Nazwa użytkownika"><br>
                    <input type="password" value="" name="password1" required placeholder="Hasło"><br>
                    <input type="password" value="" name="password2" required placeholder="Powtórz hasło"><br>
                    <input type="text" value="" name="name" placeholder="Imię"><br>
                    <input type="text" value="" name="surname" placeholder="Nazwisko"><br>

                <button type="submit">Zarejestruj</button>
            </form>

        </div>
        <div class="col">

            <form class="form-signin" name="login" method="post" action="">

                    <input class='form-control' type="text" value="" name="username" required placeholder="Podaj adres e-mail lub nazwę użytkownika"><br>
                    <input class='form-control' type="password" value="" name="password1" required placeholder="Hasło"><br>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
            </form>

        </div>
    </div>
    <br>
</div>

