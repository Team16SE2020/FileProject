<?php
session_start();
if (!isset($_SESSION['codice_identificativo'])) {
	header('Location:login.php');
    exit;
}
$username = $_SESSION['codice_identificativo'];
if (isset($_POST['codice'])){
	$codice = $_POST['codice'];
	require('../logUser/logindb.php'); 
	$db = pg_connect($connection_string) or die ("Could not connect to server\n");
	$sql = ("DELETE FROM UTENTE WHERE codice_identificativo=$1");
	$result = pg_prepare($db, "delete_utente", $sql);
	$ret = pg_execute($db, "delete_utente", array($codice));
	echo("L'utente è stato eliminato!");
	echo '<a onclick="window.location=\'http://localhost/Gruppo16SE/logUser/album.php\'"> Torna indietro! </a>';
	pg_close($db);
}else
	echo 'Errore nella cancellazione di questo utente';
?>