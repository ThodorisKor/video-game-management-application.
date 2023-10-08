<?php
$host='localhost';
$db = 'video_game_managment';
require_once "db_pass.php";

$user=$DB_USER;
$pass=$DB_PASS;

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
        echo '<script>alert("Connection to database failed!")</script>';
}
?>