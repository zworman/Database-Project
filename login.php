<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: index.php");
    exit;
}

require_once "config.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST["username"]);

    $password = trim($_POST["password"]);

    if($username_err == false && $password_err == false){
	$stmt = "SELECT name, username, password, customer_num FROM customer WHERE username = '";
	$stmt .= $username;
	$stmt .= "';";
	$result = pg_query($dbconn, $stmt);
	if(pg_num_rows($result) == 1) {
	    $arr = pg_fetch_array($result);
	    if($password == $arr['password']) {
		session_start();
		$_SESSION["loggedin"] = true;
		$_SESSION["id"] = $arr['name'];
		$_SESSION["username"] = $arr['username'];
		$_SESSION["user"] = $arr['customer_num'];
		header("location: index.php");
		exit;
	    } else {
		$password_err = "Invalid Password";
	    }
	} else {
	    $username_err = "No account found with that username";
	}
    } else {
	echo "Something went wrong. Please try again";
    }
    pg_close($db_connect);
    $error = $username_err . " " . $password_err;
    echo "<script type='text/javascript'>";
    echo "alert('$error');";
    echo 'window.location.href="index.php";';
    echo "</script>";
    exit;
}
?>
