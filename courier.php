<?php
session_start();
$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$request = oci_parse($db, "SELECT * FROM request");
oci_execute($request);

while($data = oci_fetch_array($request)){
$id = $data['ID'];
$id_s = "stat".$id;
$shipstat = $_POST[$id_s];
$result = oci_parse($db, "UPDATE request SET shipstat = '$shipstat' WHERE id = $id");
oci_execute($result);
}

oci_commit($db);
oci_close($db); 
$_SESSION['courier_s'] = true;
header('location: lk_courier.php');
?>