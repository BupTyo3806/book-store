<?php
session_start();
$row = array();
for ($i = 1; $i <= $_SESSION['count']; $i++)
	{
	if (isset($_POST['cb'.$i.'']))
		{
		array_push($row, $_POST['cb'.$i.'']);
		}
	}
	
if (count($row) != 0) {	
$_SESSION['row'] = $row;	
header('location: request_form.php');
}
else {
header('location: main.php');
}	
?>