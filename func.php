<?php
function sec_session_start() {
    $session_name = 'sec_session_id';
    $secure = SECURE;
    $secure = FALSE;
    $httponly = true;
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    session_name($session_name);
    @session_start(); 
    session_regenerate_id(true);
}
function login($username,$password,$conn) {
    $sql = "SELECT username,password,email,name,roles FROM users where username='$username' AND password='$password' limit 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["username"] = $row['username'];
            $_SESSION["roles"] = $row['roles'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $login_string = hash('sha512', $user_agent);
            $_SESSION["login_string"] = $login_string;
            return true;
        }
    }

    else return false;
}


function login_check() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $login_string = hash('sha512', $user_agent);
    if ((isset($_SESSION["username"])) && ($login_string == $_SESSION['login_string'])) {
        return true;
    }
    else {
        header("Location: index.php");
    }
}

function make_thumb($src) {
    $img_fullpath = "images/" . $src;
    $desired_width = "100";
    $dest = "images/thumbnail/thumb_" . $src;
    $source_image = imagecreatefromjpeg($img_fullpath);
    $width = imagesx($source_image);
    $height = imagesy($source_image);
    $desired_height = floor($height * ($desired_width / $width));
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    imagejpeg($virtual_image, $dest);
}

function cleaner_alphanumeric($toclean) {
	return preg_replace("/[^A-Za-z0-9]/", '', $toclean);
}
function cleaner_numeric($toclean) {
	return preg_replace("/[^0-9]/", '', $toclean);
}
function cleaner_alphanumeric_space($toclean) {
	return preg_replace("/[^A-Za-z0-9 ]/", '', $toclean);
}
function cleaner_alphanumeric_underscore($toclean) {
	return preg_replace("/[^A-Za-z0-9_]/", '', $toclean);
}
function cleaner_mysqlescape($toclean) {
	global $mysqli;
	return $mysqli->real_escape_string($toclean);
}
function cleaner_htmlentities($toclean) {
	return htmlentities($toclean);
}
function cleaner_htmlentities_mysqlescape($toclean) {
	return cleaner_mysqlescape(htmlentities($toclean));
}
function purifier($toclean) {
	$purifier = new HTMLPurifier(); 
	$toclean = $purifier->purify($toclean);
	return $toclean;
}
