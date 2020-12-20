<?php
	session_start();
	if (!isset($_SESSION['codice_identificativo'])) {
		header('Location:login.php');
		exit;
	}
	$codice= $_POST['id_procedura'];
	if (isset($_POST['id_procedura'])){
		if(array_key_exists('register',$_POST)){
			require('../logUser/logindb.php'); 
			$db = pg_connect($connection_string) or die ("Could not connect to server\n");
			$sql = ("UPDATE procedura set quantita=$1 where id_procedura=$2");
			$result = pg_prepare($db, "update_proc", $sql);
			$ret = pg_execute($db, "update_proc", array($_POST['quantita'],$_POST['id_procedura']));
			echo("La quantità è stata modificata!");
			echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/showproc.php\'"> Torna indietro! </a>';
			pg_close($db);
		}
	}
else { echo 'Errore nella modifica di questa procedura';} ?>
