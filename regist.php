<?php
session_start();
$last_name = trim($_POST['last_name']);
$first_name = trim($_POST['first_name']);
$middle_name = trim($_POST['middle_name']);
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$r_password = trim($_POST['r_password']);

if ($password == $r_password) 
	{
	$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

	$search = oci_parse($db, "SELECT login FROM person WHERE login = '$login'");
	oci_execute($search);
	$srow = oci_fetch_array($search);

	if (count($srow['LOGIN']) == 0)
		{
		$result = oci_parse($db, "INSERT INTO person (status_id, lastname, firstname, middlename, login, password) VALUES (2,'$last_name','$first_name','$middle_name','$login','$password')");
		echo $result;
		if (oci_execute($result) == "true")
			{
			header('location: index.php');
			$_SESSION['reg_s'] = true;
			}
			else
			{
			header('location: register.php');
			$_SESSION['reg_e'] = true;
			}
		}
		else
		{
		$_SESSION['reg_count'] = true;
		header('location: register.php');
		}

		oci_commit($db);
   oci_close($db);  
	
	}
	else
	{
	$_SESSION['reg_pas'] = true;
	header('location: register.php');
	}
?>