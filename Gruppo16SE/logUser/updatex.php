<?php
	session_start();
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	$username = $_SESSION['codice_identificativo'];
	if (isset($_POST['id_mod'])){
		if(array_key_exists('register',$_POST)){
			require('../logUser/logindb.php'); 
			$db = pg_connect($connection_string) or die ("Could not connect to server\n");
			$sql = ("UPDATE utente SET ruolo=$1 where codice_identificativo=$2");
			$result = pg_prepare($db, "update_utente", $sql);
			$ret = pg_execute($db, "update_utente", array($_POST['ddlTerminalProfiles'],$_POST['id_mod']));
			echo("L'utente è stato modificato!");
			echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/album.php\'"> Torna indietro! </a>';
			pg_close($db);
		}
	}
else { echo 'Errore nella modifica di questo utente';}

?>