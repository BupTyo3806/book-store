<?php
session_start();
$person_id = trim($_SESSION['person_id']);
$location = trim($_POST['location']);
$row = $_SESSION['row'];

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$result = oci_parse($db, "INSERT INTO request (person_id, begindate, location) VALUES ('$person_id', SYSDATE,'$location')");
oci_execute($result);

$last_id = oci_parse($db, "SELECT MAX(id) FROM request ORDER BY id DESC");
oci_execute($last_id);
$count = oci_fetch_row($last_id)[0];
echo $count;

foreach($row as $key=>$value)
	{
	$number = $_POST['r'.$value.''];
	$result2 = oci_parse($db, "INSERT INTO request_product (request_id, product_id, num) VALUES ('$count','$value','$number')");
	oci_execute($result2);
	}
$_SESSION['request_s'] = true;
oci_commit($db);
oci_close($db);
header('location: main.php');
?>