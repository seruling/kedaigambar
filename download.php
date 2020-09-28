<?php
$host = "localhost";
$db_username = "root";
$db_password = "MySQL@332";
$database = "kedaigambar";
$conn = mysqli_connect($host,$db_username,$db_password,$database);
if (isset($_GET['type'])) {
    $file = base64_decode($_GET['file']);
    $filepathname = explode("/", $file);
    $filename = $filepathname[1];
    $sql = "UPDATE photos SET total_downloaded=total_downloaded+1 WHERE filename='$filename'";
    $result = $conn->query($sql);
    if ($_GET['type'] == "zip") {
        $zip = new ZipArchive();
        $tmp_file = tempnam('.','');
        $zip->open($tmp_file, ZipArchive::CREATE);
        $download_file = file_get_contents($file);
        $zip->addFromString(basename($file),$download_file);
        $zip->addFile("$file", "$filename");
        $zip->close();
        header('Content-type: application/zip');
        header("Content-disposition: attachment; filename=$filename.zip");
        readfile($tmp_file);
        unlink($tmp_file);
    }
    if ($_GET['type'] == "jpg") {
    	header('Content-type: application/octet-stream');
        header("Content-disposition: attachment; filename=$file");
        readfile($file);
    }

}
?>