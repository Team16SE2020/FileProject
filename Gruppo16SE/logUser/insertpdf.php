<title> ASSEGNAZIONE INCARICO[FORM]</title>
	<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/gruppo07/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="insertpdf.php"  method="post" onsubmit="return validatePassword(this);" name="pdf">
		<fieldset>
		<h1>FORM PER L'INSERIMENTO DELL'INCARICO: COMPILA I SEGUENTI CAMPI</h1> 
		<label>Seleziona un manutentore:</label>
		<select name='ddlTerminalProfiles'>
     
        <?php
        #DB Connection
        $con_string= "host=localhost port=5432 dbname=gruppoBA user=www password=tsw2020";
        $dbcon = pg_connect($con_string);              
        #Query for manteiners
        $result=pg_query($dbcon, "SELECT codice_identificativo from Utente where ruolo ='Maintainer'"); 
        while ($row = pg_fetch_array($result)) {
		echo "<option value=\"{$row['codice_identificativo']}\">{$row['codice_identificativo']}</option>",PHP_EOL;}
		?>
		</select>
		<p><label for="cognome">Codice protocollo documento: <input type="input" maxlength="4" size="18" name="codice" placeholder="Qui il codice"  required /></label></p>
		<p><label name="notizia"> Inserisci qui l'incarico: <label for="myfile">Scegli file:<input type="file" id="myfile" name="myfile" accept="application/pdf"></label></p>
		<input class="button button2" type="submit" name="register" value="INVIA!">		
		</fieldset>
	</form>
			
	
	<?php
	if(isset($_POST["ddlTerminalProfiles"]))
		insert_pdf();
	
	
	function insert_pdf(){
		error_reporting(0);
		require("logindb.php");
		$db = pg_connect($connection_string) or die ("Impossibile connettersi al database").pg_last_error();
		$data = addslashes(fread(fopen($_FILES["myfile"]["tmp_name"], "rb"), $_FILES["myfile"]["size"]));
		$es_data = pg_escape_bytea($data);
		fclose($img);
		$sql = "INSERT into DOCUMENTO(ID_UTENTE,CODICE,DOCUMENTO) values ($1,$2,$3)";
		$stmtname = "modpin";
		$result = pg_prepare($db, $stmtname, $sql);
		$ret = pg_execute($db, $stmtname, array($_POST["ddlTerminalProfiles"], $_POST["codice"], $data));
		if(!$ret) {
			return false;
		}
        return true;
           
    }
	
	?>
	
	
</div>