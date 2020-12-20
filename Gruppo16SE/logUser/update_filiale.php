<title> MODIFCA SEDE[CTM]</title>
<?php echo'
<div class="content">
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<link rel="icon" href="/gruppo07/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<form action="updatef.php"  method="post" onsubmit="return validatePassword(this);" name="dati">
				<fieldset>
				<h1>FORM PER LA MODIFICA DELLA SEDE: COMPILA I SEGUENTI CAMPI</h1>
					<input type="hidden" name="id_sede" value="',$_POST['cod_fil'],'"/>
					<p><label for="via">Via*: <input type="input" maxlength="50" size="18" name="via" placeholder="Inserisci qui la nuova via"  required /></label></p>
					<input class="button button2" type="submit" name="register" value="INVIA!" onclick="checkEmail();">					
					<p class="obbligatorio">*i campi contrassegnati sono obbligatori</p>
				</fieldset>
			</form>';
			
	
	?>