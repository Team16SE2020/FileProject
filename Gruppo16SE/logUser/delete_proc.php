<?php
session_start();
if (!isset($_SESSION['codice_identificativo'])) {
	header('Location:login.php');
    exit;
}

if (isset($_POST['id_procedura'])){
	require('../logUser/logindb.php'); 
	$db = pg_connect($connection_string) or die ("Could not connect to server\n");
	$sql = ("DELETE FROM procedura WHERE id_procedura=$1");
	$result = pg_prepare($db, "delete_proc", $sql);
	$ret = pg_execute($db, "delete_proc", array($_POST['id_procedura']));
	echo"Sede cancellata con successo!";
	echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/showproc.php\'"> Torna indietro! </a>';
	pg_close($db);
}
else { echo 'Errore nella cancellazione di questa procedura';}