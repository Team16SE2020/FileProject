<title> MODIFCA PROCEDURA[CTM]</title>
<?php echo'
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="updatem.php"  method="post" onsubmit="return validatePassword(this);" name="dati">
				<fieldset>
				<h1>FORM PER LA MODIFICA DELLA PROCEDURA: COMPILA I SEGUENTI CAMPI</h1>
					<input type="hidden" name="id" value="',$_POST['id'],'"/>
					<p><label for="quantita">Quantità*: <input type="number" max="1000000" size="18" name="quantita_tot" placeholder="Inserisci qui la nuova quantità"  required /></label></p>
					<input class="button button2" type="submit" name="register" value="INVIA!">					
					<p class="obbligatorio">*i campi contrassegnati sono obbligatori</p>
				</fieldset>
			</form>';
			
	
	?>