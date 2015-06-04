<?php
session_start();

$isbn = trim($_POST['isbn']);
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$description = trim($_POST['description']);
$genre = trim($_POST['genre']);

$id = $_SESSION['radio'];

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$result = oci_parse($db, "UPDATE product SET isbn='$isbn', title='$title', author='$author', description='$description', genre='$genre' WHERE id='$id'");
oci_execute($result);


$_SESSION['edit_s'] = true;
oci_commit($db);
oci_close($db);
	header('location: lk_admin.php');
?>