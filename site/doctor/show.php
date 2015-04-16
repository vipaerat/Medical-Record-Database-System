<?php
include '../config.php';

$id_pat = $_GET['pat'];
$id_doc = $_GET['doc'];
$id_pha = $_GET['pha'];
$timestamp = $_GET['date']." ".$_GET['time'];

$query = "SELECT medical_cert FROM Prescription WHERE id_pat='$id_pat' and id_doc='$id_doc' and id_pha='$id_pha' and time_stamp='$timestamp'";
// echo $query;

$res = pg_query($db,$query);
$row = pg_fetch_row($res);
// echo pg_last_error();

// $med_cert = $_GET['med_cert'];
header("Content-Type: image/jpg");
// echo $row[0];
echo pg_unescape_bytea($row[0]);
?>