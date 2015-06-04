<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Оформление заказа
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
	</HEAD>
	<BODY background="mainbg.jpg" link="#1dbe56" vlink="025720">
		<BR>
		<TABLE border=0 cellspacing=0 cellpadding=0 align="center">
			<TR>
				<TD width=171 align = "right"></TD>
				<td> <a href = "main.php"><img align = "center" src = "logo.png" alt = "Book Store" border="0"></a>
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
									<td align = "right" width = "33%">
									<input type = "submit"  class = "myButton" name = "submit" value = "Оформить заказ" form = "req">
									</td>
								</tr>
							</table>
							<div style="width: 100%; float: left;">
							<form id = "req" action = "request_insert.php" method="post">'
							<div style="float: left; width: 65%;">
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;"> 
								<tr>
								<td>
								<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$row = $_SESSION['row']; 
								
								$result = oci_parse($db, "SELECT * FROM product WHERE id IN(".implode(',',$row).") ORDER BY title");	
								oci_execute($result);
								
								echo '<table rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';										   
							   echo '<td width = "30%"><b>Название</b></td>';
							   echo '<td><b>Автор</b></td>';
							   echo '<td><b>Жанр</b></td>';
							   echo '<td width = "10%"><b>Количество</b></td>';
							   echo '</tr>';
							   while($data = oci_fetch_array($result)){ 
								  echo '<tr>';
								  echo '<td align = "center" bgcolor = "#A4C7E5" style = "padding:5;"><b>' . $data['TITLE'] . '</b></td>';
								  echo '<td style = "padding:5;">' . $data['AUTHOR'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['GENRE'] . '</td>';
								  echo '<td style = "padding:5;"><input type = "number" min = "1" max = "10" value = "1" name="r'.$data['ID'].'"></td>';
								  echo '</tr>';
							   }
							   echo '</table>';
							   oci_commit($db);
								oci_close($db);
								?>
								</td>
								</tr>
							</table>
							</div>
							<div style="float: left; width: 30%; margin-left:20px;">
								<h4 style = "margin-top:27px;">Введите адрес доставки:</h4>
								<textarea cols = "40" rows = "4" name = "location" style = "margin-top:-15px; resize: none;" required></textarea>
							</div>
							</div>
							</form>
					</TD>
				</TABLE>
				</TD>	

			</TR>
		</TABLE>
		
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		
		