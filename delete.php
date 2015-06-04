<?php
$id = $_POST['radio'];
echo $id;

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$result = oci_parse($db, "DELETE FROM product WHERE id='$id'");
oci_execute($result);
$_SESSION['delete_s'] = true;
header('location: lk_admin.php');

oci_commit($db);
oci_close($db);
?>