<title> ASSEGNAZIONE ATTIVITA'[FORM]</title>
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="assignactivity.php"  method="post" onsubmit="return validatePassword(this);" name="pdf">
		<fieldset>
		<h1>FORM PER L'INSERIMENTO DELL'ATTIVITA': COMPILA I SEGUENTI CAMPI</h1> 
		<label>Seleziona un manutentore:</label>
		<select name='ddlTerminalProfiles'>
     
       <?php
        #DB Connection
        require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$username = $_SESSION['codice_identificativo'];        
        #Query for maintainers
        $sql=("SELECT codice_identificativo from Utente where ruolo ='Maintainer'"); 
		$result = pg_prepare($db, "display_maint", $sql);
		$ret = pg_execute($db, "display_maint",array() );
        while ($row = pg_fetch_assoc($ret)) {
		echo "<option value=\"{$row['codice_identificativo']}\">{$row['codice_identificativo']}</option>",PHP_EOL;}
		?>
		</select>
		<p><label for="id">ID-Attività: <input type="input" maxlength="4" size="18" name="id_attivita" placeholder="Qui l'id"  required /></label></p>
		<p><label for="id">Data inizio: <input type="input" maxlength="10" size="18" name="data_inizio" placeholder="aaaa-mm-dd"  required /></label></p>
		<p><label for="id">Data fine: <input type="input" maxlength="10" size="18" name="data_fine" placeholder="aaaa-mm-dd"  required /></label></p>
		<p><label for="id">Descrizione: </p><p><textarea  type="input" maxlength="100" size="45" rows="10" cols="50"  style="resize:none;" name="desc" placeholder="Qui la descrizione"  required ></textarea></label></p>
		<input class="button button2" type="submit" name="register" value="INVIA!">		
		</fieldset>
		</form>
			
	
	<?php
	
	if(isset($_POST["ddlTerminalProfiles"]))
		insert_activity($_POST["id_attivita"], $_POST["desc"], $_POST["data_inizio"], $_POST["data_fine"], $_POST["ddlTerminalProfiles"]);
	
	
	function insert_activity($id_attivita,$desc,$data_inizio,$data_fine,$maintainer){
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$sql = "INSERT into ATTIVITA(ID_ATTIVITA,DESCRIZIONE,DATA_INIZIO, DATA_FINE, ID_MAINT) values ($1,$2, $3, $4, $5)";
		$stmtname = "insertActivity";
		$result = pg_prepare($db, $stmtname, $sql);
		$ret = pg_execute($db, $stmtname, array($id_attivita, $desc, $data_inizio, $data_fine, $maintainer));
		if(!$ret) {
			return false;
		}
        return true;
           
    }
	?>
	
</div>