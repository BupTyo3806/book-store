<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Главная страница
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
									<td align = "center" width = "33%">
									<a href="lk_user.php" class="myButton">Личный кабинет</a>
									</td>
									<td align = "right" width = "33%">
									<input type = "submit"  class = "myButton" name = "submit" value = "Оформление заказа" form = "req">
									</td>
								</tr>
							</table>
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;">
								<tr>
								<td>
								<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$result = oci_parse($db, "SELECT * FROM product ORDER BY title");	
								oci_execute($result);
								$res = oci_parse($db, "SELECT COUNT(*) FROM product"); 
								oci_execute($res);
								$count = oci_fetch_row($res)[0]; // всего записей 
								$_SESSION['count'] = $count;
								
								echo '<table rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';				
								echo '<td><b>В корзину</b></td>';							   
							   echo '<td width = "15%"><b>Название</b></td>';
							   echo '<td><b>Автор</b></td>';
							   echo '<td><b>Описание</b></td>';
							   echo '<td><b>Жанр</b></td>';
							   echo '<td width = "14%"><b>ISBN</b></td>';
							   echo '</tr>';
								echo '<form id = "req" action = "request.php" method="post">';
								echo '<input type = "hidden" name = "count" value = "'.$count.'">';
							   while($data = oci_fetch_array($result)){ 
								  echo '<tr>';
								  echo '<td style = "padding:5;" align = "center"><input type="checkbox" name="cb'.$data['ID'].'" value="'.$data['ID'].'"></td>';
								  echo '<td align = "center" bgcolor = "#A4C7E5" style = "padding:5;"><b>' . $data['TITLE'] . '</b></td>';
								  echo '<td style = "padding:5;">' . $data['AUTHOR'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['DESCRIPTION'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['GENRE'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['ISBN'] . '</td>';
								  echo '</tr>';
							   }
								echo '</form>';
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
		<?php
		if ((isset($_SESSION['request_s']) == true) && ($_SESSION['request_s'] == true)) {
		echo '<script>';
		echo 'alert ("Заказ успешно добавлен!");';
		echo '</script>';
		$_SESSION['request_s'] = false;
		}
		?>
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		
		