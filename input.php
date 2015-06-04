<?php
session_start();
$login = trim($_POST['login']);
$password = trim($_POST['password']);

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');


$result = oci_parse($db, "SELECT ID, STATUS_ID, LASTNAME, FIRSTNAME, MIDDLENAME FROM person WHERE LOGIN = '$login' AND PASSWORD = '$password'");
oci_execute($result);

$myrow = oci_fetch_array($result);

if (count($myrow['ID']) == 0)
	{
		header('location: index.php');
	}
	else
	{
		$id = $myrow['ID'];
		$_SESSION['person_id'] = $id;
		$status_id = $myrow['STATUS_ID'];
		$_SESSION['status_id'] = $status_id;
		$_SESSION['lastname'] = $myrow['LASTNAME'];
		$_SESSION['firstname'] = $myrow['FIRSTNAME'];
		$_SESSION['middlename'] = $myrow['MIDDLENAME'];
		
		if ($status_id == 1) {header('location: lk_admin.php');}
		if ($status_id == 2) {header('location: main.php');}
		if ($status_id == 3) {header('location: lk_courier.php');}	
	}



	oci_commit($db);
   oci_close($db); 
?>
