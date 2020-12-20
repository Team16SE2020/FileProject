<title> MODIFICA DATI DI UN UTENTE[FORM]</title>
<?php echo'
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/gruppo07/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form name="dati" action="updatex.php" method="POST">
	
	
	
	<form action="updatex.php"  method="post" onsubmit="return validatePassword(this);" name="dati">
				<fieldset>
				<h1>FORM PER LA MODIFICA DEGLI UTENTI: COMPILA I SEGUENTI CAMPI</h1>
					<label>Seleziona un ruolo:</label>
		<select name="ddlTerminalProfiles">';
     
      
        require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
        $result=pg_query($db, "SELECT distinct ruolo from Utente"); 
        while ($row = pg_fetch_array($result)) {
		echo "<option value=\"{$row['ruolo']}\">{$row['ruolo']}</option>",PHP_EOL;}

			echo'		<input type="hidden" name="id_mod" value="',$_POST['cod_mod'],'"/>
					<br>
					<hr>
					<br>
					<input class="button button2" type="submit" name="register" value="INVIA!">					
					<p class="obbligatorio">*i campi contrassegnati sono obbligatori</p>
				</fieldset>
			</form>';
			
	
	
		