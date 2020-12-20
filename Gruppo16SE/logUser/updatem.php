<?php
	session_start();
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	if (isset($_POST['id'])){
		if(array_key_exists('register',$_POST)){
			require('../logUser/logindb.php'); 
			$db = pg_connect($connection_string) or die ("Could not connect to server\n");
			$sql = ("UPDATE magazzino set quantita_tot=$1 where id=$2");
			$result = pg_prepare($db, "update_mag", $sql);
			$ret = pg_execute($db, "update_mag", array($_POST['quantita_tot'],$_POST['id']));
			echo("La quantità è stata modificata!");
			echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/magazzino.php\'"> Torna indietro! </a>';
			pg_close($db);
		}
	}
else { echo 'Errore nella modifica.';} ?>
