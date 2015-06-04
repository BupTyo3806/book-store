<?php
$isbn = trim($_POST['isbn']);
$title = trim($_POST['title']);
$author = trim($_POST['author']);
$description = trim($_POST['description']);
$genre = trim($_POST['genre']);

$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$result = oci_parse($db, "INSERT INTO product (isbn, title, author, description, genre) VALUES ('$isbn', '$title', '$author', '$description', '$genre')");
oci_execute($result);


$_SESSION['add_s'] = true;
oci_commit($db);
oci_close($db);
header('location: lk_admin.php');
?>