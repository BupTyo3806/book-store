<?php
   header('Content-type: text/html; charset=utf-8');
	session_start();
?>
<HTML>
	<HEAD>
		<TITLE>
			Книжный магазин | Карта
		</TITLE>
		<link rel="stylesheet" href="style.css" media="all" />
		<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    
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
									<a href="lk_user.php" class="myButton">Назад</a>
									</td>
								</tr>
							</table>
							<table align = "center" border = "0px" cellspacing=10 cellpadding=10 style = "margin-top:15px;">
								<tr>
								<td>
								<?php								
								$lat = $_POST['lat'];
								$long = $_POST['long'];
								if ((strlen($lat) == 0) && (strlen($long) == 0)) {
								header('location: lk_user.php');
								}
								?>
								<script type="text/javascript">
								var latitude = '<?php echo $lat;?>';
								var longitude = '<?php echo $long;?>';
        ymaps.ready(init);
        var myMap, 
            myPlacemark;

        function init(){ 
            myMap = new ymaps.Map("map", {
                center: [latitude, longitude],
                zoom: 12
            }); 
            
            myPlacemark = new ymaps.Placemark([latitude, longitude], {
            });
            
            myMap.geoObjects.add(myPlacemark);
        }
    </script>
								<div id="map" style="width: 985px; height: 500px; border: 4px double black; margin-top: -10px;"></div>
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
		
		