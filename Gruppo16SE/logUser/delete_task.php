<?php
session_start();
if (!isset($_SESSION['codice_identificativo'])) {
	header('Location:login.php');
    exit;
}
$username = $_SESSION['codice_identificativo'];
if (isset($_POST['codice'])){
	require('../logUser/logindb.php'); 
	$db = pg_connect($connection_string) or die ("Could not connect to server\n");
	$sql = ("DELETE FROM documento WHERE codice=$1");
	$result = pg_prepare($db, "delete_task", $sql);
	$ret = pg_execute($db, "delete_task", array($_POST['codice']));
	echo "Incarico completato e cancellato dal sistema!";
	echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/showincarico.php\'"> Torna indietro! </a>';
	pg_close($db);
}
else { echo 'Errore nella cancellazione di questa task';}