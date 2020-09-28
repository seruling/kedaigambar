<?php
include_once "header.php";
?>
<body>
<div class="container">
<?php
include_once "nav.php";
?>
<div class="col-md-12">

Welcome to KedaiGambar!<br/><br/>
<div class="col-md-1"></div>
<div class="col-md-10">
</div>

<?php
/*
$sql = "SELECT filename, caption,submitted_date FROM photos where approval_date!=0 AND rejected_date=0";
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
		echo "<div class='col-md-2'><a href='images/" . $row["filename"]."' target='_blank'><img src='images/thumbnail/thumb_" . $row["filename"]."'/></a></div>";
		echo "<div class='col-md-9'>" . $row["caption"]. "</div>";
		echo " </div>";
		$rowcol = !$rowcol;
		$rowcount++;
    }
}
*/
?>

<br/>
<br/>

</div>
</div>
<div class="col-md-1"></div>
<?php
include_once "footer.php";
?>
