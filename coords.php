<?php
session_start();
$courier_id = $_SESSION['person_id'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$request = oci_parse($db, "SELECT * FROM request");
oci_execute($request);

while($data = oci_fetch_array($request)){
$id = $data['ID'];
$result = oci_parse($db, "UPDATE request SET latitude = '$latitude', longitude = '$longitude' WHERE id = '$id' AND courier_id = '$courier_id'");
oci_execute($result);
}

oci_commit($db);
oci_close($db);
$_SESSION['coords_s'] = true;
header('location: lk_courier.php');
?>