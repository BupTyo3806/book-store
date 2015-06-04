<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Авторизация
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
	</HEAD>
	<BODY background="mainbg.jpg" link="#1dbe56" vlink="025720">
		<BR>
		<TABLE border=0 cellspacing=0 cellpadding=0 align="center">
			<TR>
				<TD width=171 align = "right"></TD>
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
						<form action="input.php" method="post">
							<h1 align = "center" style = "padding-top:15px"> Вход в систему							
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px">
								<tr>
									<td align = "right">
									<label style = "font-size:20px">Введите имя:</label>
									</td>
									<td align = "left">
									<input style = "width:170px; height:23px;" type="text" name = "login" required>
									</td>
								</tr>
								<tr>
									<td align = "right">
									<label style = "font-size:20px">Введите пароль: </label>
									</td>
									<td align = "left">
									<input style = "width:170px; height:23px;" type="password" name = "password" required>
									</td>
								</tr>
								<tr>
									<td align = "right" style = "padding-top:12px">
									<a href = "register.php" style = "font-size:19px">Регистрация</a>
									</td>
									<td style = "padding-top:15">
									<button style = "font-size:19px; width:170px; height:30px; padding-bottom:2px;" type="submit"> Вход </button>
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
		if ((isset($_SESSION['reg_s']) == true) && ($_SESSION['reg_s'] == true)) {
		echo '<script>';
		echo 'alert ("Регистрация прошла успешно!");';
		echo '</script>';
		$_SESSION['reg_s'] = false;
		}
		?>
		<P><HR>
		<CENTER><I>&#169; Copyright Ivashin Aleksey </I></CENTER>
		</P>

	</BODY>
	
</HTML>	

		