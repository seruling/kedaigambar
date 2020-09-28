<?php
include_once "header.php";
$error_message = "";
if (isset($_REQUEST['submit'])) {
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];

	if (login($username,$password,$conn)) {
		if ($_SESSION["roles"] == 1) {  
			header("Location: index.php");
		}
		elseif($_SESSION["roles"] == 2) {
			header("Location: photographer.php");
		}
		elseif($_SESSION["roles"] == 3) {
			header("Location: editor.php");
		}
	}
	else {
		header("Location: login.php?err=Error. Please try again.");
	}
}

if (isset($_REQUEST['err'])) {
	$error_message = $_REQUEST['err'];
}

?>
<body>
<div class="container">
<?php
include_once "nav.php";
?>
<div class="col-md-12 text-center">

<div class="col-md-4 col-md-offset-4">
<form class="form-horizontal center" method="POST">
<fieldset>
<legend>Login</legend>
<?php echo $error_message ?>
<div class="form-group">
  <input id="textinput" name="username" type="text" placeholder="Username" class="form-control input-md text-center" required pattern="[a-zA-Z0-9]+">
</div>
<div class="form-group">
    <input id="passwordinput" name="password" type="password" placeholder="Password" class="form-control input-md text-center">
</div>
<div class="form-group">
    <input id="passwordinput" name="submit" type="submit" value="Login" class="btn-info form-control input-md text-center">
</div>
</fieldset>
</form>

</div
</div>
<?php
include_once "footer.php";
?>
