<?php
			echo "<form method='post' action='userPage.php' onsubmit='return confMod(this);'>";
			echo "<table>";
			foreach($info as $index => $element){
				echo '<tr><td>', $index, '</td><td>', $element, '</td>';
					
			}
?>

		
		<tr><td>PIN</td><td id="link"><a onclick="modify();">Modifica</a></td> <td class="mod"><p>********</p></td> <td class="mod"><label>Nuovo PIN: <input class="in" type="password" name="pwd"/></label></td></tr>
		<tr class="mod" id="button"><td><input class="button" type="submit" value="Conferma" /></td><td><input class="button" type="button" onclick="cancel();" value="Annulla" /></td><td><label>Conferma nuovo PIN: <input class="in" type="password" name="pwd2" oninput="this.setCustomValidity(''); this.style.backgroundColor = 'white';"/></label></td></tr>
		</table>
		<input type="input" class="in" id="pwdOld" name="oldPwd" style="display:none;" />
		</form>
		<br>
		<button class="button" onclick="window.location.href = 'logout.php';" style="vertical-align:middle"><span>Logout</span></button>
		<button class="button" onclick="window.location.href = 'moduloSign.php';" style="vertical-align:middle"><span>Inserimento utente</span></button>
		<button class="button" onclick="window.location.href = 'album.php';" style="vertical-align:middle"><span>Visualizza utenti</span></button>
		<button class="button" onclick="window.location.href = 'insertpdf.php';" style="vertical-align:middle"><span>Assegna attività al manutentore</span></button>
		
	</html>