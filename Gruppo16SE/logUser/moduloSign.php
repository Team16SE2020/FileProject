<title> INSERIMENTO UTENTE[FORM]</title>
<head>
<script type="text/javascript">
   function soloNumeri(evt) {
   var charCode = (evt.which) ? evt.which : event.keyCode
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
   }
   return true;
}
</script>

</head>
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="moduloSign.php"  method="post" onsubmit="return validatePassword(this);" name="dati">
		<fieldset>
		<h1>FORM PER L'INSERIMENTO DELL'UTENTE: COMPILA I SEGUENTI CAMPI</h1>
			<p><label for="email">E-mail*: <input type="input" maxlength="50" size="18" name="email" placeholder="Inserisci qui l'e-mail"  required /></label></p>
			<p><label>Seleziona un ruolo:<select name='ddlTerminalProfiles'/></label></p>
			<option value="System Administrator">System Administrator</option>
			<option value="Planner">Planner</option>
			<option value="Repository Manager">Repository Manager</option>
			<option value="Maintainer">Maintainer</option>
			</select>
			<p><label for="codice">Codice Identificativo*: <input type="input" maxlength="8" size="18" name="codice" placeholder="Qui il codice identificativo numerico" onkeypress="return soloNumeri(event);" required /></label></p>
			<p><label for="pin">PIN*: <input type="input" maxlength="5" size="18" name="pin" placeholder="Qui il PIN" onkeypress="return soloNumeri(event);" required /></label></p>
			<p><label for="nome">Nome*: <input type="input" maxlength="50" size="18" name="nome" placeholder="Qui il nome"  required /></label></p>
			<p><label for="cognome">Cognome*: <input type="input" maxlength="50" size="18" name="cognome" placeholder="Qui il cognome"  required /></label></p>
			<br>
			<hr>
			<br>
			<input class="button button2" type="submit" name="register" value="INVIA!" onclick='checkEmail();'>					
			<p class="obbligatorio">*i campi contrassegnati sono obbligatori</p>
		
		</fieldset>
	</form>
			
	<?php
	if(isset($_POST["email"]))
		insert_utente($_POST["email"], $_POST['ddlTerminalProfiles'],$_POST["codice"],  $_POST["pin"],$_POST["nome"], $_POST["cognome"]);
	
	
	function insert_utente($email, $ruolo, $codice, $pin, $nome, $cognome){
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$sql = "INSERT into UTENTE(EMAIL,RUOLO,CODICE_IDENTIFICATIVO,PIN, NOME,COGNOME) values ($1,$2,$3,$4,$5,$6)";
                        $stmtname = "modpin";
                        $result = pg_prepare($db, $stmtname, $sql);
                        $ret = pg_execute($db, $stmtname, array($email, $ruolo, $codice, $pin, $nome, $cognome));
                        if(!$ret) {
                            return false;
                        }
        return true;
           
    }
	?>
</div>