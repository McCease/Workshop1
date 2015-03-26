<?php

$servername = "localhost";
$username = "user1";
$password = "passwd";
$baseName = "workshop1";

$conn = new mysqli($servername, $username, $password, $baseName);

if ($conn->connect_error) {
    die("Polaczenie nieudane. Blad: " . $conn->connect_error."<br>");
}
