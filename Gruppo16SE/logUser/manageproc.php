<?php 
session_start();
if (!isset($_SESSION['codice_identificativo'])) {
    header('Location:login.php');
    exit;
}
?>
<title> GESTISCI PROCEDURA[CTM]</title>
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="manageproc.php"  method="post" onsubmit="return validatePassword(this);" name="manage_proc">
		<fieldset>
		<h1>FORM PER LA GESTIONE DI UNA MANUTENZIONE: COMPILA I SEGUENTI CAMPI</h1> 
		<label>Seleziona una tipologia:</label>
		<select name='ddlTerminalProfiles'>
		<option value="Eletttrica">Elettrica</option>
		<option value="Idraulico">Idraulico</option>
		<option value="Elettronico">Elettronico</option>
		<option value="Meccanico">Meccanico</option>
		</select>
		<p><label for="id">ID-Procedura<input type="input" maxlength="4" size="18" name="id_procedura" placeholder="Qui l'id"  required /></label></p>
		<p><label for="id">Materiale: <input type="input"  size="18" name="materiale" placeholder="Qui il tipo di materiale"  required /></label></p>
		<p><label for="id">Quantità: <input type="input" maxlength="10" size="18" name="quantita" placeholder="Qui la quantità"  required /></label></p>
		<input class="button button2" type="submit" name="register" value="INVIA!">		
		</fieldset>
	</form>
			
	<?php
	if(isset($_POST["ddlTerminalProfiles"]))
		insert_proc();

	function insert_proc(){
		require("logindb.php");
		error_reporting(0);
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$username= $_SESSION["codice_identificativo"];
		$sql = "INSERT into PROCEDURA(ID_PROCEDURA,TIPO,MATERIALE, QUANTITA, ID_REPOS) values ($1,$2, $3, $4, $5)";
		$stmtname = "modpin";
		$result = pg_prepare($db, $stmtname, $sql);
		$ret = pg_execute($db, $stmtname, array($_POST["id_procedura"], $_POST["ddlTerminalProfiles"], $_POST["materiale"], $_POST["quantita"], $username));
		if(!$ret) {
			return false;
		}
        return true;
    }
	?>
</div>