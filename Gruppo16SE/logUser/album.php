<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina contenente la lista di tutti gli utenti dell'azienda"/>
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
		<title>CTM INDUSTRY[UTENTI DELL'AZIENDA]</title>
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
		<h1 class="title">STORICO UTENTI DEL SISTEMA</h1>
		<?php 
			$username = $_SESSION['codice_identificativo'];
			if(!($info = display_utenti($username))){
			}else{
				require("userinfo.php");
			}
	
		?>
	</div>
	

		
	<?php 
	$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
	include($footer);

	
	function display_utenti(){
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$sql = "SELECT * from utente";
		$result = pg_prepare($db, "display_utenti", $sql);
		$ret = pg_execute($db, "display_utenti",array() );
		$i = 0 ;
		echo '<table border="5">';
		while($row = pg_fetch_assoc($ret)){
			$i++ ;
			echo '<div class="news">
			<tr><td>',$row['nome'],'</td>
			<td>',$row['cognome'],'</td>
			<td>',$row['ruolo'],'</td>
			<td>',$row['codice_identificativo'],'</td>
			<td>',$row['pin'],'</td>
			<td>',$row['email'],'</td>
			<td><form name="myform" action="delete.php" method="POST">
			<input type="submit" name="delete_this" value="Clicca qui per cancellare questo utente!" onclick="return verify()"/>
			<input type="hidden" name="codice" value="',$row['codice_identificativo'],'" />
			</form></td>
			<td><form name="dati" action="update.php" method="POST">
			<input type="submit" name="update_this" value="Clicca qui per modificare questo utente!" />
			<input type="hidden" name="cod_mod" value="',$row['codice_identificativo'],'" />
			</form></td></tr>
			</div>
			<td width="20%">
			<script type="text/javascript">
				function verify() {
					msg = "Sicuro di voler cancellare?";
					return confirm(msg);
				} 
			</script>';
		}
		echo '</table><br><br><br><br>';
		
		pg_close($db); 
	}
?>

</body>
</html>