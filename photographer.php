<?php
include_once "header.php";
// if (!login_check()) {
// 	header("Location: login.php?err=Please login to continue.");
// }
$current_user = $_SESSION["username"];
$sql = "SELECT count(submitted_date) as total_submission FROM photos where photographer = '$current_user'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$total_submission = $row['total_submission'];
}
$sql = "SELECT count(submitted_date) as total_active FROM photos where photographer = '$current_user' AND publish_status=1 AND approval_date !=0";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$total_active = $row['total_active'];
}
$sql = "SELECT sum(total_downloaded) as total_downloaded FROM photos where photographer = '$current_user'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
	$total_downloaded = $row['total_downloaded'];
}

if (isset($_GET['act'])) {
	if ($_GET['act'] == "del") {
		$filetoact = explode("|",base64_decode($_GET['id']));
		$toact_filename =  $filetoact[0];
		$toact_submitted_date = $filetoact[1];

		$sql = "DELETE FROM photos WHERE filename='$toact_filename' AND submitted_date='$toact_submitted_date' AND photographer = '$current_user'";
		$result = $conn->query($sql);
		echo "<script>alert('Photo Deleted')</script>";
	}
	if ($_GET['act'] == "unpublish") {
		$filetoact = explode("|",base64_decode($_GET['id']));
		$toact_filename =  $filetoact[0];
		$toact_submitted_date = $filetoact[1];

		$sql = "UPDATE photos SET publish_status=0 WHERE filename='$toact_filename' AND submitted_date='$toact_submitted_date'";
		$result = $conn->query($sql);
		echo "<script>alert('Photo Unpublished')</script>";
	}
	if ($_GET['act'] == "publish") {
		$filetoact = explode("|",base64_decode($_GET['id']));
		$toact_filename =  $filetoact[0];
		$toact_submitted_date = $filetoact[1];

		$sql = "UPDATE photos SET publish_status=1 WHERE filename='$toact_filename' AND submitted_date='$toact_submitted_date'";
		$result = $conn->query($sql);
		echo "<script>alert('Photo Unpublished')</script>";
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
<strong>Approved submission</strong>
<br/>
<div class="top-10 row list_head">
<div class="col-md-1">No</div>
<div class="col-md-7">Photo</div>
<div class="col-md-2">Date</div>
<div class="col-md-2">Action</div>
</div>

<?php
$sql = "SELECT filename, caption,submitted_date,publish_status FROM photos where photographer = '$current_user' AND approval_date!=0";
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
    	if ($row["publish_status"]) {
    		$publish_act = "unpublish";
    	}
    	elseif (!$row["publish_status"]) {
    		$publish_act = "publish";
    	}
		echo "<div class='top-10 row $row_col_list'>";
		echo "<div class='col-md-1'>$rowcount</div>";
		echo "<div class='col-md-7'><a href='images/" . $row["filename"]."' target='_blank'><img src='images/thumbnail/thumb_" . $row["filename"]."'/></a> " . $row["caption"]. "</div>";
		echo "<div class='col-md-2'>" . date('H:i:s d/m/Y',$row["submitted_date"]). "</div>";
		$filetoact = base64_encode($row["filename"] . "|" . $row["submitted_date"]);
		echo "<div class='col-md-2'><a href='photographer.php?act=del&id=" . $filetoact . "'>Delete</a> | <a href='photographer.php?act=" . $publish_act . "&id=" . $filetoact . "'>" . ucfirst($publish_act) . "</a></div>";
		echo " </div>";
		$rowcol = !$rowcol;
		$rowcount++;
    }
}

?>

<br/>
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
$sql = "SELECT filename, caption,submitted_date FROM photos where photographer = '$current_user' AND approval_date=0 AND rejected_date=0";
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
		echo "<div class='col-md-7'><a href='images/" . $row["filename"]."' target='_blank'><img src='images/thumbnail/thumb_" . $row["filename"]."'/></a> " . $row["caption"]. "</div>";
		echo "<div class='col-md-2'>" . date('H:i:s d/m/Y',$row["submitted_date"]). "</div>";
		$filetoact = base64_encode($row["filename"] . "|" . $row["submitted_date"]);
		echo "<div class='col-md-2'><a href='photographer.php?act=del&id=" . $filetoact . "'>Delete</a></div>";
		echo " </div>";
		$rowcol = !$rowcol;
		$rowcount++;
    }
}

?>

<br/>
<br/>

<br/>
<br/>
<strong>Rejected Photos</strong> <em>(Rejected photos will be deleted within 7 days)</em>
<br/>
<div class="top-10 row list_head">
<div class="col-md-1">No</div>
<div class="col-md-7">Photo</div>
<div class="col-md-2">Date</div>
</div>

<?php
$sql = "SELECT filename, caption,submitted_date FROM photos where rejected_date != 0";
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
		echo "<div class='col-md-7'><a href='images/" . $row["filename"]."' target='_blank'><img src='images/thumbnail/thumb_" . $row["filename"]."'/></a> " . $row["caption"]. "</div>";
		echo "<div class='col-md-2'>" . date('H:i:s d/m/Y',$row["submitted_date"]). "</div>";
		$filetoact = base64_encode($row["filename"] . "|" . $row["submitted_date"]);
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
Total Photos: <?php echo $total_submission; ?>
<br/>
Current Active: <?php echo $total_active; ?>
<br/>
Total Downloaded: <?php echo $total_downloaded; ?>
<br/>
<br/>
<a href="upload.php"><button type="button" class="btn btn-info">Submit Photo</button></a>
</div>
</div>
</div>
<?php
include_once "footer.php";
?>