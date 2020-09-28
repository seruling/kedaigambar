<?php
include_once "header.php";
// if (!login_check()) {
// 	header("Location: login.php?err=Please login to continue.");
// }
$now = time();
$current_user = $_SESSION["username"];
if (isset($_GET['act'])) {
	if ($_GET['act'] == "approve") {
		$filetoact = explode("|",base64_decode($_GET['id']));
		$toact_filename =  $filetoact[0];
		$toact_submitted_date = $filetoact[1];
		$sql = "UPDATE photos SET approval_date='$now' WHERE filename='$toact_filename' AND submitted_date='$toact_submitted_date'";
		$result = $conn->query($sql);
		echo "<script>alert('Photo Approved')</script>";
	}
	if ($_GET['act'] == "reject") {
		$filetoact = explode("|",base64_decode($_GET['id']));
		$toact_filename =  $filetoact[0];
		$toact_submitted_date = $filetoact[1];
		$sql = "UPDATE photos SET rejected_date='$now' WHERE filename='$toact_filename' AND submitted_date='$toact_submitted_date'";
		$result = $conn->query($sql);
		echo "<script>alert('Photo Rejected')</script>";
	}

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
<h4>Hi 
<?php
echo $_SESSION["username"];
?>
,</h4>

<br/>
<strong>Pending approval submission</strong> <em>(Approved submission will be automatically published)</em>
<br/>
<div class="top-10 row list_head">
<div class="col-md-1">No</div>
<div class="col-md-7">Photo</div>
<div class="col-md-2">Date</div>
<div class="col-md-2">Action</div>
</div>

<?php
$sql = "SELECT photographer,filename,caption,submitted_date FROM photos where approval_date = 0 AND rejected_date =0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$rowcol = 1;
	$rowcount = 1;
    while($row = $result->fetch_assoc()) {
    	if ($rowcol) {
    		$row_col_list = "list_odd";
    	}
    	elseif (!$rowcol) {
    		$row_col_list = "list_even";
    	}
		echo "<div class='top-10 row $row_col_list'>";
		echo "<div class='col-md-1'>$rowcount</div>";
		echo "<div class='col-md-7'><a href='images/" . $row["filename"]."' target='_blank'><img src='images/thumbnail/thumb_" . $row["filename"]."'/></a> " . $row["caption"]. "<br/><em>Submit by: </em><strong>" . $row["photographer"]  . "</strong></div>";
		echo "<div class='col-md-2'>" . date('H:i:s d/m/Y',$row["submitted_date"]). "</div>";
		$filetoact = base64_encode($row["filename"] . "|" . $row["submitted_date"]);
		echo "<div class='col-md-2'><a href='editor.php?act=approve&id=" . $filetoact . "'>Approve</a> | <a href='editor.php?act=reject&id=" . $filetoact . "'>Reject</a></div>";
		echo " </div>";
		$rowcol = !$rowcol;
		$rowcount++;
    }
}

?>

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
<a href="upload.php"><button type="button" class="btn btn-info">Submit Photo</button></a>
</div>
</div>
</div>
<?php
include_once "footer.php";
?>