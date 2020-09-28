<?php
include_once "header.php";
login_check();
$now = time();
if (isset($_POST['submit'])) {
	$target_dir = "images/";
	$submission_id = str_replace(".","",((time() - 112441541)/2)*1.23);
	$target_file = strtolower($submission_id . "_" . basename($_FILES["photo_file"]["name"]));
	$full_path_file = $target_dir . $target_file;
	move_uploaded_file($_FILES["photo_file"]["tmp_name"], $full_path_file);

	make_thumb($target_file);

	$photo_desc = $_POST['photo_description'];
	$photographer = $_POST['photographer'];

	$sql = "INSERT INTO photos (filename, caption, photographer, submitted_date) VALUES ('$target_file', '$photo_desc', '$photographer', '$now')";
    $result = $conn->query($sql);
    echo "<script>alert('Photo Uploaded')</script>";
}

?>
<body>
<div class="container">
<?php
include_once "nav.php";
?>
<div class="col-md-12">
<div class="row">
<div class="col-md-10">
<h4>Upload Photo</h4>
<br/>
<div class="col-md-7">
<form class="form-horizontal center" method="post" enctype="multipart/form-data">
<fieldset>
<div class="form-group">
	<input id="file" name="photo_file" type="file" class="file" multiple data-show-upload="true" data-show-caption="true">
</div>
<div class="form-group">
    <input id="textinput" name="photo_description" type="text" placeholder="Caption" class="form-control input-md">
</div>
<div class="form-group">
    <input id="textinput" name="photographer" type="text" value="<?php echo $_SESSION["username"]; ?>" class="form-control input-md sr-only">
</div>
<div class="form-group">
    <input id="passwordinput" name="submit" type="submit" value="Upload" class="btn-info form-control input-md">
</div>
</fieldset>
</form>
</div>
<br/>
<br/>
<br/>
</div>
<div class="col-md-2">
<h4>Your Stats</h4>
Total Photos: 1521
<br/>
Current Active: 15
<br/>
<br/>
</div>
</div>
</div>
<?php
include_once "footer.php";
?>
