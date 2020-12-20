<title> INSERIMENTO SEDE[FORM]</title>
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
	<form action="newsede.php"  method="post" onsubmit="return validatePassword(this);" name="dati">
		<fieldset>
		<h1>FORM PER L'INSERIMENTO DELLA SEDE: COMPILA I SEGUENTI CAMPI</h1>
			<p><label for="idsede">ID-SEDE*: <input type="input" maxlength="50" size="18" name="idsede" placeholder="Inserisci qui l'id della sede"  required /></label></p>
			<p><label for="citta">Città*: <input type="input" maxlength="50" size="18" name="citta" placeholder="Qui la città"  required /></label></p>
			<p><label for="cap">CAP*: <input type="input" maxlength="8" size="18" name="cap" placeholder="Qui il cap" onkeypress="return soloNumeri(event);" required /></label></p>
			<p><label for="via">VIA*: <input type="input" maxlength="100" size="18" name="via" placeholder="Qui la via"  required /></label></p>
			<!--<p><label for="via">ID-Repository*: <input disabled type="input" maxlength="100" size="18" name="idrep" placeholder="Qui la via"  required /></label></p>-->
			<br>
			<hr>
			<br>
			<input class="button button2" type="submit" name="register" value="INVIA!"'>					
			<p class="obbligatorio">*i campi contrassegnati sono obbligatori</p>
		</fieldset>
	</form>
			
	
	<?php
	session_start();
	if(isset($_POST["idsede"]))
		insert_sede();

	function insert_sede(){
		$username=$_SESSION['codice_identificativo'];
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$sql = "INSERT into SEDE(id_sede,città,via,cap,id_rep) values ($1,$2,$3,$4,$5)";
		$stmtname = "modpin";
		$result = pg_prepare($db, $stmtname, $sql);
		$ret = pg_execute($db, $stmtname, array($_POST["idsede"], $_POST["citta"],$_POST["via"], $_POST["cap"],$username));
		if(!$ret) {
			return false;
		}
		return true;

    }
	?>
	
</div>