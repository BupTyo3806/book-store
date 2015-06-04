<?php
$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');

$result = oci_parse($db, "SELECT request.id FROM person, request WHERE request.person_id = person.id");
oci_execute($result);
while($data = oci_fetch_array($result)){
	$id_1 = $data['ID'];
	$name = $_POST['s'.$data['ID'].''];
	$ln = oci_parse($db, "SELECT id FROM person WHERE lastname = '$name'");
	oci_execute($ln);
	$id = oci_fetch_array($ln)['ID'];
	$query = oci_parse($db, "UPDATE request SET courier_id = '$id' WHERE id = '$id_1'");
	oci_execute($query);
}
oci_commit($db);
oci_close($db);
$_SESSION['admin_s'] = true;
header('location: lk_admin.php');
?>