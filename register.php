<?php

require_once('config.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);

    $password = trim($_POST["password"]);

    $name = trim($_POST["name"]);

    $phone_number = trim($_POST["phone"]);
    $stmt = "SELECT name, username, password, customer_num FROM customer;";
    $result = pg_query($dbconn, $stmt);
    $num = pg_num_rows($result)+1;
    $stmt = "INSERT INTO customer VALUES(".$num.",'".$phone_number."','".$name."','".$username."','".$password."');";
    $result = pg_query($dbconn, $stmt);
    $arr = pg_fetch_array($result);
    session_start();
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $name;
    $_SESSION["username"] = $username;
    $_SESSION["user"] = $num;
    header("location: index.php");
    pg_close($db_connect);
    $error = $username_err . " " . $password_err;
    echo "<script type='text/javascript'>";
    echo "alert('$error');";
    echo 'window.location.href="index.php";';
    echo "</script>";
    exit;
}
?>

