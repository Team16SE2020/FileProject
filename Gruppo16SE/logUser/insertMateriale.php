
<title> INSERIMENTO MATERIALE[FORM]</title>
	<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="insertMateriale.php"  method="post" onsubmit="return validatePassword(this);" name="insert_materials">
		<fieldset>
		<h1>FORM PER L'INSERIMENTO DEI MATERIALI ALL'INTERNO DEL MAGAZZINO': COMPILA I SEGUENTI CAMPI</h1> 
		<label>Seleziona una procedura:</label>
		<select name='ddlTerminalProfiles'>
        <?php
        #DB Connection
        require('../logUser/logindb.php'); 
		$db = pg_connect($connection_string) or die ("Could not connect to server\n");
		$username = $_SESSION['codice_identificativo'];        
        $sql=("SELECT id_procedura from procedura"); 
		$result = pg_prepare($db, "insert_mat", $sql);
		$ret = pg_execute($db, "insert_mat",array() );
        while ($row = pg_fetch_assoc($ret)) {
		echo "<option value=\"{$row['id_procedura']}\">{$row['id_procedura']}</option>",PHP_EOL;}
?>
		</select>
		<p><label for="id">Inserire l'ID : <input type="input" maxlength="8" size="18" name="id" placeholder="numero attività"  required /></label></p>
		<p><label for="id">Seleziona numero attività da eseguire: <input type="number" max="1000" size="18" name="n_attivita" placeholder="numero attività"  required /></label></p>
		<input class="button button2" type="submit" name="register" value="INVIA!">		
		</fieldset>
	</form>
			
	
	<?php
	if(isset($_POST["ddlTerminalProfiles"]))
		insert_materials();
	
	
	function insert_materials(){
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$quantita=$_POST["ddlTerminalProfiles"];
		$sql1 = "select quantita from procedura where id_procedura='$quantita'";
		$stmtname1 = "get_quantita";
		$result1 = pg_prepare($db, $stmtname1, $sql1);
		$ret1 = pg_execute($db, $stmtname1, array());
		while($row = pg_fetch_row($ret1))
		$quantita= $row[0]*$_POST["n_attivita"];
		$sql = "INSERT into magazzino(id,n_attivita,cod_procedura,quantita_tot) values ($1,$2,$3,$4)";
		$stmtname = "insert_materials";
		$result = pg_prepare($db, $stmtname, $sql);
		$ret = pg_execute($db, $stmtname, array($_POST['id'],$_POST["n_attivita"], $_POST["ddlTerminalProfiles"], $quantita));
		if(!$ret)
			return false;
        return true; 
    }
	?>
	
</div>





