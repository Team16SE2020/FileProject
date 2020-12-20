<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina per la visualizzazione delle attività"/>
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
		<title>ATTIVITA' ASSEGNATE[CTM]</title>
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
		<h1 class="title">ATTIVITA' ASSEGNATE</h1>
		<?php 
			$username = $_SESSION['codice_identificativo'];
			if(!($info = display_activity($username))){
			}else{
				require("userinfo.php");
			}
		?>
	</div>
	<?php 
		$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
		include($footer);

	function display_activity(){
		
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string)
			or die ("Could not connect to server\n");
		$sql = "SELECT attivita.id_attivita,attivita.descrizione,attivita.data_inizio,attivita.data_fine,utente.codice_identificativo FROM attivita INNER JOIN utente on utente.codice_identificativo = attivita.id_maint and attivita.id_maint=$1";
		$result = pg_prepare($db, "display_activity", $sql);
		$ret = pg_execute($db, "display_activity",array($_SESSION['codice_identificativo']) );
		$i = 0 ;
		echo '<table border="5"> <tr><td width="25%" height="40px">ID-ATTIVITA</td><td width="25%" height="40px">DESCRIZIONE</td><td width="25%" height="40px">DATA INIZIO</td><td width="25%" height="40px">DATA FINE</td></tr>';
		while($row = pg_fetch_assoc($ret)){
			///echo"<script>alert('ciao')</script>";
			$i++ ;
			//$unes_pdf = $row['documento'];
			echo '<tr><td width="25%" height="40px">',$row['id_attivita'],'</td>
			<td width="25%" height="40px">',$row['descrizione'],'</td>
			<td width="25%" height="40px">',$row['data_inizio'],'</td>
			<td width="25%" height="40px">',$row['data_fine'],'</td></tr>'; 
		} echo '</table>';
		pg_close($db); 
	}
?>

</body>
</html>