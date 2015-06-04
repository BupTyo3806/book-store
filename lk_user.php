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
									<a href="main.php" class="myButton">На главную</a>
									</td>
								</tr>
							</table>
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;">
								<tr>
								<td>
								<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$person_id = $_SESSION['person_id'];
								
								$request = oci_parse($db, "SELECT * FROM request WHERE person_id = '$person_id' ORDER BY begindate");
								oci_execute($request);								
								
								
								echo '<table rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';				
								echo '<td width = "15%"><b>Дата заказа</b></td>';							   
							   echo '<td><b>Место получения</b></td>';
							   echo '<td><b>Описание</b></td>';
							   echo '<td><b>Статус заказа</b></td>';
							   echo '<td><b>Где курьер?</b></td>';
							   echo '</tr>';
							   while($data = oci_fetch_array($request)){ 
								  echo '<tr>';
								  echo '<form method = "post" action = "map.php">';
								  echo '<td style = "padding:5;" align = "center">' . $data['BEGINDATE'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['LOCATION'] . '</td>';
								  echo '<td bgcolor = "#A4C7E5" style = "padding:5;">';
									$id = $data['ID'];
									$product = oci_parse($db, "SELECT title, author, num FROM product, request_product WHERE product.id = request_product.product_id AND request_product.request_id = '$id'");
									oci_execute($product);
									while($book = oci_fetch_array($product))
									{
										echo $book['TITLE'].', '.$book['AUTHOR'].', '.$book['NUM'].' шт. <br>';
									}
								  echo '</td>';
								  echo '<td style = "padding:5;" align = "center">' . $data['SHIPSTAT'] . '</td>';
								  echo '<td style = "padding:5;" align = "center"><input type = "image" src = "map.png" width = "40px" height = "40px">';
								  echo '<input type = "hidden" name = "lat" value = "'.$data['LATITUDE'].'">';
								  echo '<input type = "hidden" name = "long" value = "'.$data['LONGITUDE'].'">';
								  echo '</td>';
								  echo '</form>';
								  echo '</tr>';
							   }
							   echo '</table>';
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
		
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		
		