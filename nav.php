<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php">KedaiGambar</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
	    <ul class="nav navbar-nav">
	      <li class=""><a href=
	      <?php

      		if (@$_SESSION["roles"] == 2 ) { echo '"photographer.php"'; }
      		elseif (@$_SESSION["roles"] == 3 ) { echo '"editor.php"'; }
      		else { echo '"index.php"'; }

	      ?>
	      >Home</a></li>
	      <li><a href="gallery.php">Gallery</a></li> 
	    </ul>
      <ul class="nav navbar-nav navbar-right">
<?php
	if (@strlen($_SESSION["username"]) > 0) {
		$username = $_SESSION["username"];
		echo "<li><a>Logged in as: $username</a></li>";
        echo '<li><a href="logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>';
	}
	else {
		echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
	}
?>
      </ul>
    </div>
  </div>
</nav>