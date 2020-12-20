<?php
session_start();
if (!isset($_SESSION['codice_identificativo'])) {
	header('Location:login.php');
    exit;
}

if (isset($_POST['id'])){
	require('../logUser/logindb.php'); 
	$db = pg_connect($connection_string) or die ("Could not connect to server\n");
	$sql = ("DELETE FROM magazzino WHERE id=$1");
	$result = pg_prepare($db, "delete_mag", $sql);
	$ret = pg_execute($db, "delete_mag", array($_POST['id']));
	echo"Operazione eseguita con successo!";
	echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/magazzino.php\'"> Torna indietro! </a>';
	pg_close($db);
}
else { echo 'Errore nella cancellazione';}