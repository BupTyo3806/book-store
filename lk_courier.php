<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Личный кабинет
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
	</HEAD>
	<BODY background="mainbg.jpg" link="#1dbe56" vlink="025720">
		<BR>
		<TABLE border=0 cellspacing=0 cellpadding=0 align="center">
			<TR>
				<TD width=171 align = "right"></TD>
				<td> <a href = "lk_courier.php"><img align = "center" src = "logo.png" alt = "Book Store" border="0"></a>
				<TD width=171></TD>
			</TR>
			<tr>
				<td colspan = "3" align = "center">
				<?php
					echo '<h3 style = "margin-bottom:-15px;"> Здравствуйте, '.$_SESSION['lastname'].' '.$_SESSION['firstname'].' '.$_SESSION['middlename'];
				?>	
				</td>
			</tr>
		</TABLE>	
		<BR>
		<TABLE border=0 align=center>
			<TR>
				<TD>
				<TABLE border=1px cellspacing=0 cellpadding=0 bgcolor=white>
					<TD width=995>
							<table align = "center" cellspacing="0" cellpadding="0" border = "0px" width = "975" style = "margin-top:5px">
								<tr>
									<td align = "left" width = "33%">
									<a href="index.php" class="myButton">Выход</a>
									</td>
								</tr>
								
							</table>


<p id="demo"></p>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);	
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latitude = position.coords.latitude;
	var longitude = position.coords.longitude;
		window.location.href = 'coords.php?latitude='+latitude+'&longitude='+longitude;
}
</script>
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;">
								<tr>
								<td>
								<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$id = $_SESSION['person_id'];
								
								$request = oci_parse($db, "SELECT request.id, lastname, firstname, middlename, begindate, location, shipstat FROM person, request WHERE request.person_id = person.id AND request.courier_id = '$id' ORDER BY begindate");	
								oci_execute($request);
								
								echo '<form action = "courier.php" method="post" align = "right">';
								echo '<table rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';				
								echo '<td width = "2%" ><b>ID заказа</b></td>';							   
							   echo '<td><b>ФИО</b></td>';
							   echo '<td><b>Дата заказа</b></td>';
							   	echo '<td><b>Место получения</b></td>';
								echo '<td><b>Статус</b></td>';
							   echo '</tr>';
							   while($data = oci_fetch_array($request)){
								  echo '<tr>';
								  echo '<td style = "padding:5;" align = "center">' . $data['ID'] . '</td>';
								  echo '<td style = "padding:5;">'.$data['LASTNAME'].' '.$data['FIRSTNAME'].' '.$data['MIDDLENAME'].'</td>';
								  echo '<td style = "padding:5;">' . $data['BEGINDATE'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['LOCATION'] . '</td>';
								  echo '<td style = "padding:5;"><input type="text" name = "stat'.$data['ID'].'" value = "'.$data['SHIPSTAT'].'" required></td>';
								  echo '</tr>';
							   }
							   echo '</table>';
							   echo '<br>';
							   echo '<button style = "font-size:14px; width:170px; height:25px; padding-bottom:2px; margin-right:12px;" type="submit"> Обновить данные </button>';
							   echo '<button style = "font-size:14px; width:170px; height:25px; padding-bottom:2px; margin-right:12px;" type="button" onclick="getLocation()"> Обновить координаты </button>';
							   echo '</form>';
							   oci_commit($db);
								oci_close($db); 
								?>
								</td>
								</tr>
							</table>
					</TD>
				</TABLE>
				</TD>	

			</TR>
		</TABLE>
		<?php
		if ((isset($_SESSION['courier_s']) == true) && ($_SESSION['courier_s'] == true)) {
		echo '<script>';
		echo 'alert ("Данные обновлены");';
		echo '</script>';
		$_SESSION['courier_s'] = false;
		}
		if ((isset($_SESSION['coords_s']) == true) && ($_SESSION['coords_s'] == true)) {
		echo '<script>';
		echo 'alert ("Координаты обновлены");';
		echo '</script>';
		$_SESSION['coords_s'] = false;
	}
	?>
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		
		