<?php
	session_start();
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	$codice= $_POST['id_sede'];
	if (isset($_POST['id_sede'])){
		if(array_key_exists('register',$_POST)){
			require('../logUser/logindb.php'); 
			$db = pg_connect($connection_string) or die ("Could not connect to server\n");
			$sql = ("UPDATE sede set via=$1 where id_sede=$2");
			$result = pg_prepare($db, "update_sede", $sql);
			$ret = pg_execute($db, "update_sede", array($_POST['via'],$_POST['id_sede']));
			echo("La via è stata modificata!");
			echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/showfiliali.php\'"> Torna indietro! </a>';
			pg_close($db);
		}
	}
else { echo 'Errore nella modifica di questa sede';}
?>