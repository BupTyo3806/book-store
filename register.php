<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Регистрация
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
	</HEAD>
	<BODY background="mainbg.jpg" link="#1dbe56" vlink="025720">
	
		<BR>
		<TABLE border=0 cellspacing=0 cellpadding=0 align=center>
			<TR>
				<TD width=171></TD>
				<td> <a href = "index.php"><img align = "center" src = "logo.png" alt = "Book Store" border="0"></a>
				<TD width=171></TD>
			</TR>
		</TABLE>	
		<BR>
		<TABLE border=0 align=center>
			<TR>
				<TD>
				<TABLE border=1px cellspacing=0 cellpadding=0 bgcolor=white>
					<TD width=995>
						<form action="regist.php" method="post">
							<h1 align = "center" style = "padding-top:15px"> Регистрация
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px">
								<tr>
									<td align = "right">
									<label>Фамилия:<font color = "red">*</font></label>
									</td>
									<td align = "left">
									<input type="text" name = "last_name" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Имя:<font color = "red">*</font></label>
									</td>
									<td align = "left">
									<input type="text" name = "first_name" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Отчество:</label>
									</td>
									<td align = "left">
									<input type="text" name = "middle_name">
									</td>
								</tr>
								<tr >
									<td align = "right" style = "padding-top:15">
									<label>Имя пользователя:<font color = "red">*</font></label>
									</td>
									<td align = "left" style = "padding-top:15">
									<input type="text" name = "login" required>
									</td>
								</tr>
								<tr>
									<td align = "right" style = "padding-top:15">
									<label>Пароль:<font color = "red">*</font></label>
									</td>
									<td align = "left" style = "padding-top:15">
									<input type="text" name = "password" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label>Повторите пароль:<font color = "red">*</font></label>
									</td>
									<td align = "left">
									<input type="text" name = "r_password" required>
									</td>
								</tr>
								<tr>
									<td colspan = "2" align = "center">
									<label><i><font color = "red">*</font> - поля, обязательные для заполнения</i></label>
									</td>
								</tr>
								<tr>
									<td colspan = "2" style = "padding-top:15" align = "center">
									<button style = "font-size:19px; width:170px; height:30px; padding-bottom:2px;" type="submit"> Регистрация </button>
									</td>
								</tr>
								
							</table>
							
						</form>
					</TD>
				</TABLE>
				</TD>	

			</TR>
		</TABLE>
		<?php
	if ((isset($_SESSION['reg_pas']) == true) && ($_SESSION['reg_pas'] == true)) {
		echo '<script>';
		echo 'alert ("Пароли не совпадают!");';
		echo '</script>';
		$_SESSION['reg_pas'] = false;
		}
		if ((isset($_SESSION['reg_count']) == true) && ($_SESSION['reg_count'] == true)) {
		echo '<script>';
		echo 'alert ("Такой пользователь существует!");';
		echo '</script>';
		$_SESSION['reg_count'] = false;
		}
		if ((isset($_SESSION['reg_e']) == true) && ($_SESSION['reg_e'] == true)) {
		echo '<script>';
		echo 'alert ("Неизвестная ошибка");';
		echo '</script>';
		$_SESSION['reg_e'] = false;
	}
	?>
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
</HTML>	
		