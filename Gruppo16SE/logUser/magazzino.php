<?php session_start(); ?>

<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina Contenente la lista dei materiali"/>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
		<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
		<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
		<link rel="stylesheet" href="album.css" type="text/css" />
		<title>GESTISCI MAGAZZINO[CTM]</title>
	</head>

	<body>

	<?php 
		$header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
		include($header);
	
	echo '<br><br><br><br><br><br><br>';	
	
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	?>
<div class="content">
		<h1 class="title">GESTISCI MAGAZZINO</h1>
		<?php 
			$username = $_SESSION['codice_identificativo'];
			if(!($info = display_magazzino($username))){
			}else{
				require("userinfo.php");
			}
	
		?>
	</div>
	<?php 
		$footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
		include($footer);

	function display_magazzino(){
		
		require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$username= $_SESSION['codice_identificativo'];
		$sql = "select magazzino.id,magazzino.n_attivita, magazzino.cod_procedura, magazzino.quantita_tot,procedura.tipo, procedura.materiale from magazzino inner join procedura
		on magazzino.cod_procedura=procedura.id_procedura";
		$result = pg_prepare($db, "magazzino", $sql);
		$ret = pg_execute($db, "magazzino",array() );
		$i = 0 ;
		echo '<table border="5"> <tr>
		<td width="25%" height="40px">ID</td>
		<td width="25%" height="40px">Codice Procedura</td>
		<td width="25%" height="40px">Tipo</td>
		<td width="25%" height="40px">Materiale</td>
		<td width="25%" height="40px">Numero attività</td>
		<td width="25%" height="40px">Quantità totale</td></tr>';
		while($row = pg_fetch_assoc($ret)){
			$i++ ;
			echo '<tr><td width="25%" height="40px">',$row['id'],'</td>
			<td width="25%" height="40px">',$row['cod_procedura'],'</td>
			<td width="25%" height="40px">',$row['tipo'],'</td>
			<td width="25%" height="40px">',$row['materiale'],'</td>
			<td width="25%" height="40px">',$row['n_attivita'],'</td>
			<td width="25%" height="40px">',$row['quantita_tot'],'</td>
			<td><form name="myform" action="delete_magazzino.php" method="POST">
			<td><input type="submit" name="delete_magazzino" value="Clicca qui per cancellare questo materiale!" onclick="return verify()"/>
			<input type="hidden" name="id" value="',$row['id'],'" />
			</form></td>
			<td><form name="dati" action="update_magazzino.php" method="POST">
			<td><input type="submit" name="update_this" value="Clicca qui per modificare la quantità di questo materiale!" />
			<input type="hidden" name="id" value="',$row['id'],'" />
			</form></td></tr>
			<td width="20%">
			<script type="text/javascript">
				function verify() {
					msg = "Cliccando OK il materiale verrà eliminato!";
					return confirm(msg);
				} 
			</script>'; 
		}
		?>
		</table>
		<br><br>
		<button class="button" onclick="window.location.href = 'insertMateriale.php';" style="vertical-align:middle"><span>Inserisci materiale in magazzino</span></button>
		<?php
		pg_close($db); 
	}
?>

</body>
</html>