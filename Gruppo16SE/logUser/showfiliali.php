<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina per la visualizzazione delle filiali"/>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
		<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
		<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
		<link rel="stylesheet" href="album.css" type="text/css" />
		<script>
		function switchArticle(el){
			var iframe = el.parentNode.getElementsByTagName('iframe')[0] ;
			if(iframe.style.display== "none")
				iframe.style.display = "";
			else
				iframe.style.display = "none" ;
		}
		</script>
		<title>GESTIONE FILIALI[CTM]</title>
	</head>
<body>

	<?php 
		$header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
		include($header);
	?>
	<br><br><br><br><br><br><br>	
	<!-- IF STATMENT -->
	<?php
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	?>
<div class="content">
		<h1 class="title">STORICO SEDI</h1>
		<?php 
			$username = $_SESSION['codice_identificativo'];
			if(!($info = display_filiali($username))){
			}else{
				require("userinfo.php");
			}
	
		?>
	</div>
	<?php 
		$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
		include($footer);

	function display_filiali(){
		
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$sql = "SELECT * from SEDE";
		$result = pg_prepare($db, "display_pdf", $sql);
		$ret = pg_execute($db, "display_pdf",array() );
		$i = 0 ;
		echo '<table border="5">';
		while($row = pg_fetch_assoc($ret)){
			$i++ ;
			echo '<tr><td width="25%">',$row['id_sede'],'</td>
			<td width="25%">',$row['città'],'</td>
			<td width="25%">',$row['cap'],'</td>
			<td width="25%">',$row['via'],'</td>
			<td width="25%">',$row['id_rep'],'</td>
			<td><form name="myform" action="delete_sede.php" method="POST">
			<input type="submit" name="delete_sede" value="Clicca qui per cancellare questa sede!" onclick="return verify()"/>
			<input type="hidden" name="id_sede" value="',$row['id_sede'],'" />
			</form></td>
			<td><form name="dati" action="update_filiale.php" method="POST">
			<input type="submit" name="update_this" value="Clicca qui per modificare questa sede!" />
			<input type="hidden" name="cod_fil" value="',$row['id_sede'],'" />
			</form></td></tr>
			<td width="20%">
		    <script type="text/javascript">
				function verify() {
					msg = "Cliccando OK la sede verrà eliminata!";
					return confirm(msg);
				}
		</script>'; 
		} echo '</table>';
		pg_close($db); 
	}
?>

</body>
</html>