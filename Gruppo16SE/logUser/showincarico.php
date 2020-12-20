<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina per la visualizzazione degli incarichi"/>
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
		<title>Visualizza incarichi[CTM INDUSTRY]</title>
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
	<h1 class="title">STORICO INCARICHI ASSEGNATI</h1>
	<?php 
		$username = $_SESSION['codice_identificativo'];
		if(!($info = display_incarico($username))){
		}else{
			require("userinfo.php");
		}
	?>
</div>
	<?php 
	$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
	include($footer);


	function display_incarico(){
		
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$sql = "SELECT documento.codice,documento.documento,utente.nome,utente.cognome,utente.codice_identificativo FROM documento INNER JOIN utente on utente.codice_identificativo = documento.id_utente and documento.id_utente=$1";
		$result = pg_prepare($db, "display_incarico", $sql);
		$ret = pg_execute($db, "display_incarico",array($_SESSION['codice_identificativo']) );
		$i = 0 ;
		while($row = pg_fetch_assoc($ret)){
			$i++ ;
			$unes_pdf = pg_unescape_bytea($row['documento']);
			$unes_pdf= base64_encode($unes_pdf);
			echo '<div class="news"><table  border="5"><tr><td width="25%">',$row['nome'],'</td>
			<td width="25%">',$row['cognome'],'</td>
			<td width="25%">',$row['codice_identificativo'],'</td>
			<td width="25%">',$row['codice'],'</td></tr></table>
			<button onclick= \'switchArticle(this) ;\'>Visualizza anteprima </button>
			<iframe src="data:application/pdf;base64,',$unes_pdf,'" id="prova" style="width:45%;height:45%;display:none;" ></iframe></div>';
			 echo '<td width="20%">
			<script type="text/javascript">
				function verify() {
					msg = "Cliccando OK il tuo incarico risulterà terminato";
					return confirm(msg);
				} 
			</script>
			<form name="myform" action="delete_task.php" method="POST">
			<input type="submit" name="delete_this" value="Incarico completato!" onclick="return verify()"/>
			<input type="hidden" name="codice" value="',$row['codice'],'" />
			</form>
			</td>'; 
		}
		
		pg_close($db); 
	}
?>

</body>
</html>