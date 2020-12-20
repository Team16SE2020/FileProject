<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina per la visualizzazione delle procedure"/>
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
		<title>GESTISCI PROCEDURE[CTM]</title>
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
	<h1 class="title">GESTISCI PROCEDURE</h1>
	<?php 
		$username = $_SESSION['codice_identificativo'];
		if(!($info = display_procedura($username))){
		}else{
			require("userinfo.php");
		}
	?>
</div>
	<?php 
	$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
	include($footer);

	function display_procedura(){
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$username= $_SESSION['codice_identificativo'];
		$sql = "SELECT id_procedura,tipo,materiale,quantita from procedura";
		$result = pg_prepare($db, "display_procedura", $sql);
		$ret = pg_execute($db, "display_procedura",array() );
		$i = 0 ;
		echo '<table border="5"> <tr><td width="25%" height="40px">ID-Procedura</td><td width="25%" height="40px">Tipo</td><td width="25%" height="40px">Materiale</td><td width="25%" height="40px">Quantità</td></tr>';
		while($row = pg_fetch_assoc($ret)){
			$i++ ;
			echo '<tr><td width="25%" height="40px">',$row['id_procedura'],'</td>
			<td width="25%" height="40px">',$row['tipo'],'</td>
			<td width="25%" height="40px">',$row['materiale'],'</td>
			<td width="25%" height="40px">',$row['quantita'],'</td>
			<td><form name="myform" action="delete_proc.php" method="POST">
			<td><input type="submit" name="delete_proc" value="Clicca qui per cancellare questa procedura!" onclick="return verify()"/>
			<input type="hidden" name="id_procedura" value="',$row['id_procedura'],'" />
			</form></td>
			<td><form name="dati" action="update_proc.php" method="POST">
			<td><input type="submit" name="update_this" value="Clicca qui per modificare questa procedura!" />
			<input type="hidden" name="cod_proc" value="',$row['id_procedura'],'" />
			</form></td></tr>
			<td width="20%">
			<script type="text/javascript">
				function verify() {
					msg = "Cliccando OK la procedura verrà eliminata!";
					return confirm(msg);
				} 
			</script>'; 
		} echo '</table>';
		pg_close($db); 
	}

?>

</body>
</html>