<?php
session_start();
$account = "";
if(isset($_SESSION["loggedin"])) {
    $account = $_SESSION["id"];
} else {
    $account = "Your Account";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<link rel="icon" href="./images/logo.png">
	<title>Sequoia Sandwhich Company</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<style>
*{
    margin: 0;
    padding: 0;
}
body, html {
    height = 100vh;
margin: 0;
padding: 0;
}

    body {
	background-image: url("./images/tree.png");
	background-attachment: fixed;;
	background-position: center;
	background-repeat: no-repeat;
	background-size: cover;
    }

    .navbar {
	margin-bottom: 50px;
	border-radius: 0;
	background-color: #D56D2D;
    }

    .jumbotron {
	background-color: #8F2E00;
	padding: 0;
	margin: 0;
	border-radius: 0;
    }

    .f {
	float: left; background-color: #D56D2D;
	display: block;
	width: 32px;
	height: 32px;
	padding: 5px;
	margin: 5px;
    }

    .center { background-color: #D56D2D;
	display: flex;
	align-items: center;
	flex-wrap: wrap;
    }

    footer {
	position: sticky;
	bottom: 0;
	width: 100%;
	background-color: #072A00;
    }

    div {
	height: 100%;
    }

    .fill {
	min-height: 100%;
	height: auto;
    }
    /* Full-width input fields */
    input[type=text], input[type=password] {
	width: 100%;
	padding: 12px 20px;
	margin: 8px 0;
	display: inline-block;
	border: 1px solid #ccc;
	box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
	background-color: #4CAF50;
	color: white;
	padding: 14px 20px;
	margin: 8px 0;
	border: none;
	cursor: pointer;
	width: 100%;
    }

    button:hover {
	opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
	width: auto;
	padding: 10px 18px;
	background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
	text-align: center;
	margin: 24px 0 12px 0;
	position: relative;
    }

    img.avatar {
	width: 10%;
	border-radius: 50%;
    }

    .container {
	padding: 16px;
    }

    span.password {
	float: right;
	padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
	background-color: #fefefe;
	margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
	border: 1px solid #888;
	width: 80%; /* Could be more or less, depending on screen size */
    }

    //r The Close Button (x) */
    .close {
	position: absolute;
	right: 50px;
	top: 0;
	color: #000;
	font-size: 35px;
	font-weight: bold;
    }

    .close:hover,
    .close:focus {
	color: red;
	cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
	-webkit-animation: animatezoom 0.6s;
	animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
	from {-webkit-transform: scale(0)} 
	to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
	from {transform: scale(0)} 
	to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
	span.password {
	    display: block;
	    float: none;
	}
	.cancelbtn {
	    width: 100%;
	}
    }        
	</style>
    </head>
    <body>
	<div class="h-100 row justify-content-sm-center" style="z-index: 0">
	    <div class="h-100 col-sm-8" style="background-color: white; padding: 0;">
		<div class="jumbotron">
		    <div class="container text-center">
			<img src="./images/logo.png">
		    </div>
		</div>
		<nav class="navbar navbar-expand-md navbar-dark" style="margin: 0; padding: 0;">
		    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
			<ul class="navbar-nav mr-auto">
			    <li class="align-self-center">
				<img src="./images/logo2.png" style="vertical-align: middle;"></img>
			    </li>
			    <li class="nav-item align-self-center">
			    <a class="nav-link" href="index.php">Home</a>
			    </li>
			    <li class="nav-item align-self-center">
				<a class="nav-link" href="menu.php">Menu</a>
			    </li>
			    <li class="nav-item align-self-center">
				<a class="nav-link" href="deals.php">Deals</a>
			    </li>
			    <li class="nav-item active align-self-center">
				<a class="nav-link" href="info.php">Information</a>
			    </li>
			</ul>
		    </div>
		    <div class="mr-auto order-0">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2" style="padding-left: 30px">
			    <span class="navbar-toggler-icon"></span>
			</button>
		    </div>
		    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
			<ul class="navbar-nav ml-auto">
			    <li class="nav-item align-self-center">
				<a style="float: left;" href="#" onclick="document.getElementById('login').style.display='block'"><img src="./images/user.png" style="height: 50px; width: 50px;"></a>
				<div style="text-align: center; float: right">
					<a href="#" onclick="document.getElementById('login').style.display='block'" style="color: black; margin: 10px;"><?php echo $account; ?></a>
					<a style="color: #1034A6" href="logout.php"><br><strong><?php if($account != "Your Account") {echo "Logout";}?></strong></a>
				</div>
			    </li>
			</ul>
		    </div>
		</nav>
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-8 offset-sm-2" style="background-color: rgba(255,255,255,.9);">
<div class="mapouter"><div class="gmap_canvas"><iframe width="1080" height="710" id="gmap_canvas" src="https://maps.google.com/maps?q=%20Sign%20in%20Sequoia%20Sandwich%20Company&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.pureblack.de"></a></div><style>.mapouter{position:relative;text-align:right;height:710px;width:1080px;}.gmap_canvas {overflow:hidden;background:none!important;height:710px;width:1080px;}</style></div>
		<div class="row">
				<div class="col-sm-2" onmouseover="this.style.border='solid #000000'" onmouseout="this.style.border='none'"style="padding: 10px;"> 
					<a href="report1.php">
						<div class="card">
							<img class="card-img-top" src="./images/report.png" alt="Card image cap">
							<div class="card-body"><u><i>Nutrition Report</i></u></div>
						</div>
					</a>
				</div>
				<div class="col-sm-2 offset-sm-8" onmouseover="this.style.border='solid #000000'" onmouseout="this.style.border='none'"style="padding: 10px;">
					<a href="report2.php">
						<div class="card">
							<img class="card-img-top" src="./images/report.png" alt="Card image cap">
							<div class="card-body"><u><i>Sandwich Frequency</i></u></div>
						</div>
					</a>
				</div>
		</div>
	    </div>
	</div>
	<div class="row justify-content-sm-center" style="margin-top: 0;">
	    <div class="col-sm-8" style="padding: 0;">
		<div class="card">
		    <div class="card-footer">
			<a href="http://twitter.com/sequoiasandwich" class="btn f" style="background-image: url(http://www.sequoiasandwich.com/v4/images/t.png); float: left;"></a>
			<a href="http://www.facebook.com/sequoiasandwich" class="btn f" style="background-image: url(http://www.sequoiasandwich.com/v4/images/f.png); float: left;"></a>
			<h5 class="card-title" style="padding-top: 10px;">Keep up with us on social media!</h5>
			<p class="card-text" style="float: right;">Created by Zakary Worman</p>
		    </div>
		</div>
	    </div>
	</div>
	<div id="login" class="modal">
	    <form class="modal-content animate" action="./login.php" method="post">
		<span onclick="document.getElementById('login').style.display='none'" class="align-self-end close" title="Close Modal">&times;</span>
		<div class="imgcontainer">
		    <img src="./images/user.png" alt="Avatar" class="avatar">
		</div>

		<div class="container">
		    <label for="username"><b>Username</b></label>
		    <input type="text" id="username" placeholder="Enter Username" name="username" required>

		    <label for="password"><b>Password</b></label>
		    <input type="password" id="password" placeholder="Enter Password" name="password" required>
		    <div id="login" class="modal">


			    <div class="container" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
				<span class="password">Forgot <a href="#">password?</a></span>
			    </div>
			</form>
		    </div>

		    <button name="submit" type="submit">Login</button>
		    <label>
			<input type="checkbox" checked="checked" name="remember"> Remember me
		    </label>
		</div>
		<div class="container" style="background-color:#f1f1f1; height: auto;">
		    <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
	    </form>
	</div>
    </body>
</html>

<script>
var modal = document.getElementById('login');
var login = "<?php echo $_SESSION['loggedin'] ?>";
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target.tagName == 'A' && login == true) {
	window.location.href = "account.php";
    }
    if (event.target == modal || login == true) {
	modal.style.display = "none";
    }
}
</script>
