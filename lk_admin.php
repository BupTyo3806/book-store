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
				<td> <a href = "lk_admin.php"><img align = "center" src = "logo.png" alt = "Book Store" border="0"></a>
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
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;">
								<tr>
								<td>
								<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$result = oci_parse($db, "SELECT * FROM product ORDER BY title");	
								oci_execute($result);
								
								echo '<form>';
								echo '<table rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';				
								echo '<td><b>Отметить</b></td>';							   
							   echo '<td width = "15%"><b>Название</b></td>';
							   echo '<td><b>Автор</b></td>';
							   echo '<td><b>Описание</b></td>';
							   echo '<td><b>Жанр</b></td>';
							   echo '<td width = "14%"><b>ISBN</b></td>';
							   echo '</tr>';
							   while($data = oci_fetch_array($result)){ 
								  echo '<tr>';
								  echo '<td style = "padding:5;" align = "center"><input type="radio" name="radio" value="'.$data['ID'].'"></td>';
								  echo '<td align = "center" bgcolor = "#A4C7E5" style = "padding:5;"><b>' . $data['TITLE'] . '</b></td>';
								  echo '<td style = "padding:5;">' . $data['AUTHOR'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['DESCRIPTION'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['GENRE'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['ISBN'] . '</td>';
								  echo '</tr>';
							   }
							   echo '</table>';
							   echo '<br>';
							   echo '<button name = "add" formaction = "add.php" formmethod = "post" style = "width:250px; height:35px; margin-left:80px;" ><b>Добавить</b></button>';
							   echo '<button name = "edit" formaction = "edit.php" formmethod = "post" style = "width:250px; height:35px; margin-left:30px;" ><b>Редактировать</b></button>';
							   echo '<button name = "delete" formaction = "delete.php" formmethod = "post" style = "width:250px; height:35px; margin-left:30px;" ><b>Удалить</b></button>';
							   echo '</form>';
							   oci_commit($db);
								oci_close($db); 
								?>
								</td>
								</tr>
							<tr>
							<td>
							<h2 align = "center"> Список заказов
							<?php
								$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$result = oci_parse($db, "SELECT request.id, request.courier_id, lastname, firstname, middlename, begindate, location, shipstat FROM person, request WHERE request.person_id = person.id");	
								oci_execute($result);
								
								
								echo '<form action = "courier_update.php" method="post" align = "right">';
								echo '<table width = "990px" rules="rows" frame="void" style = "border-color:#1E4567;">';
							   echo '<tr align = "center">';				
								echo '<td width = "2%" ><b>ID заказа</b></td>';							   
							   echo '<td><b>ФИО получателя</b></td>';
							   echo '<td><b>Дата заказа</b></td>';
							   	echo '<td><b>Место получения</b></td>';
								echo '<td><b>Курьер</b></td>';
								echo '<td><b>Текущий</b></td>';
							   echo '</tr>';
							   while($data = oci_fetch_array($result)){
									$query = oci_parse($db, "SELECT lastname FROM person WHERE id = '".$data['COURIER_ID']."'");
									oci_execute($query);
								  echo '<tr>';
								  echo '<td style = "padding:5;" align = "center">' . $data['ID'] . '</td>';
								  echo '<td style = "padding:5;">'.$data['LASTNAME'].' '.$data['FIRSTNAME'].' '.$data['MIDDLENAME'].'</td>';
								  echo '<td style = "padding:5;">' . $data['BEGINDATE'] . '</td>';
								  echo '<td style = "padding:5;">' . $data['LOCATION'] . '</td>';
								  echo '<td style = "padding:5;" >';
									$person = oci_parse($db, "SELECT id, lastname FROM person WHERE status_id = '3' ORDER BY lastname");
									oci_execute($person);
									echo '<select style = "width:150px;" name = "s'.$data['ID'].'">';
									while($courier = oci_fetch_array($person)){
										echo '<option>'.$courier['LASTNAME'].'</option>';
									}
									echo '</select>';
								  echo '</td>';
								  echo '<td style = "padding:5;" bgcolor = "#A4C7E5">' . oci_fetch_array($query)['LASTNAME']. '</td>';
								  echo '</tr>';
							   }
							   echo '</table>';
							   echo '<br>';
							   echo '<button style = "font-size:14px; width:250px; height:35px; padding-bottom:2px; margin-right:12px;" type="submit"><b> Обновить данные </b></button>';
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
		if ((isset($_SESSION['admin_s']) == true) && ($_SESSION['admin_s'] == true)) {
		echo '<script>';
		echo 'alert ("Данные обновлены");';
		echo '</script>';
		$_SESSION['admin_s'] = false;
		}
		if ((isset($_SESSION['delete_s']) == true) && ($_SESSION['delete_s'] == true)) {
		echo '<script>';
		echo 'alert ("Запись удалена");';
		echo '</script>';
		$_SESSION['delete_s'] = false;
	}
	if ((isset($_SESSION['edit_s']) == true) && ($_SESSION['edit_s'] == true)) {
		echo '<script>';
		echo 'alert ("Редактирование завершено");';
		echo '</script>';
		$_SESSION['edit_s'] = false;
	}
	if ((isset($_SESSION['add_s']) == true) && ($_SESSION['add_s'] == true)) {
		echo '<script>';
		echo 'alert ("Запись удалена");';
		echo '</script>';
		$_SESSION['add_s'] = false;
	}
	?>
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		
		