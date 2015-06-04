<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Редактирование
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
	</HEAD>
	<BODY background="mainbg.jpg" link="#1dbe56" vlink="025720">
		<BR>
		<TABLE border=0 cellspacing=0 cellpadding=0 align=center>
			<TR>
				<TD width=171></TD>
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
						<form action="edit_2.php" method="post">
							<h1 align = "center" style = "padding-top:15px"> Редактировать
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px">
							<?php
							$id = $_POST['radio'];
							$_SESSION['radio'] = $id;
							
							$db = oci_connect('BOOK_STORE', 'ghjcbn', 'localhost/XE', 'utf8');
								
								$result = oci_parse($db, "SELECT * FROM product WHERE id = '$id'");	
								oci_execute($result);
								$myrow = oci_fetch_array($result);
							
								echo '<tr>
									<td align = "right">
									<label>ISBN:</label>
									</td>
									<td align = "left">
									<input type="text" name = "isbn" value = "'.$myrow['ISBN'].'" style = "width:310px" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Название:</label>
									</td>
									<td align = "left">
									<input type="text" name = "title" value = "'.$myrow['TITLE'].'" style = "width:310px" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Автор:</label>
									</td>
									<td align = "left">
									<input type="text" name = "author" value = "'.$myrow['AUTHOR'].'" style = "width:310px" required>
									</td>
								</tr>
								<tr >
									<td align = "right" >
									<label>Описание:</label>
									</td>
									<td align = "left">
									<textarea cols = "40" rows = "4" name = "description" style =  "resize: none;" required>'.$myrow['DESCRIPTION'].'</textarea>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Жанр:</label>
									</td>
									<td align = "left">
									<input type="text" name = "genre" value = "'.$myrow['GENRE'].'" style = "width:310px" required>
									</td>
								</tr>
								<tr>
									<td colspan = "2" style = "padding-top:15" align = "center">
									<button style = "font-size:19px; width:170px; height:30px; padding-bottom:2px;" type="submit"> Редактировать </button>
									</td>
								</tr>';
								?>
							</table>
							
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
		