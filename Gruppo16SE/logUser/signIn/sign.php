<?php session_start();
	if(isset($_SESSION['username']) || isset($_SESSION['id'])){
		header("location: ../userPage.php");
	}
?>
<html>
	<head>
	<link rel="stylesheet" href="sign.css" type="text/css" />
	<meta name="author" content="Gruppo 07"/>
    <meta name="description" content="Pagina di inserimento notizia"/>
	<!-- LINK GENERALI -->
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
	<link rel="icon" href="/gruppo07/style/ludeicon.ico" type="image/ico" />
	<link rel="stylesheet" href="/gruppo07/style/header/header.css" type="text/css" />
	<link rel="stylesheet" href="/gruppo07/style/button.css" type="text/css" />
	<link rel="stylesheet" href="/gruppo07/style/unique.css" type="text/css" />
	
	
	<title>DIGITAL BULLETIN[Inserimento notizia]</title>
	</head>
		<body>
			<!--HEADER-->
<?php
 $header =  $_SERVER['DOCUMENT_ROOT']."/gruppo07/style/header/header.php";
				include($header);
				
			
			
			$include=true;
				if(isset($_POST['username']))
					$username = $_POST['username'];
				else
					$username = "";
				if(isset($_POST['mail']))
					$email = $_POST['mail'];
				else
					$email = "";
				if(isset($_POST['pwd']))
					$password = $_POST['pwd'];
				else
					$password = "";
				if(isset($_POST['pwd2']))
					$repassword = $_POST['pwd2'];
				else
					$repassword = "";
				if(isset($_POST['nome']))
					$nome = $_POST['nome'];
				else
					$nome = "";
				if(isset($_POST['cognome']))
					$cognome = $_POST['cognome'];
				else
					$cognome = "";
				if(isset($_POST['sesso']) and $_POST['sesso']!="")
					$sesso = $_POST['sesso'];
				else
					$sesso = null;
				if(isset($_POST['birth']) and $_POST['birth']!="")
					$birth = $_POST['birth'];
				else
					$birth = null;
				

?>
<div class="error">
<?php
	if (!empty($username) && !empty($email) && !empty($password) && !empty($repassword) && !empty($nome) && !empty($cognome) ){
	
		//CHECK PASSWORD (inutile avendolo già effettuato prima del submit con JavaScript)
		if($password!=$repassword){
			echo "<p class='error'> Hai sbagliato a digitare la password. Riprova</p>";
			$password = "";
		}else{
			//Controllo prima l'esistenza dell'username inserito, se non esiste controllo la presenza della mail, se non esiste nel database,
			//inseriamo l'utente nel database
			
			if(!user_check($username)){
				if(!mail_check($email)){
					if(insert_utente($username, $email, $password, $nome, $cognome, $sesso, $birth)){
						echo '<div class="success">';
						echo "<p clss> Utente registrato con successo. Effettua il <a class='button' href=\"../login.php\">login</a></p></div>";
						$include= false;
					}
					else{
						echo "<p class='error'> Errore durante la registrazione. Riprova</p>";
					}
				}else{
					echo "<p class='error'> Email non disponibile. Riprova</p>";
					echo"<style>input[name='mail']{background : #ff9999;}</style>";	
					
				}
			}else{
				echo "<p class='error'> Nome utente non disponibile. Riprova</p>";
				 echo"<style>input[name='username']{background : #ff9999;}</style>";	
			}
		}
	}
?>
	</div>
<?php	
			if($include){
				include("moduloSign.html");
			}


			function insert_utente($username, $email, $password, $nome, $cognome, $sesso, $birth){
				require "../logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$hash = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO utente (username, email, password, nome, cognome, sesso, birth_day) values ($1, $2, $3, $4, $5, $6, $7);";
				$stmtname = "UserInsert";
				$result = pg_prepare ($db, $stmtname, $sql);
				$ret = pg_execute($db, "UserInsert", array($username, $email, $hash, $nome, $cognome, $sesso, $birth));
				if(!$ret) {
					echo "" . pg_last_error($db);
					pg_close($db);
					return false; 
				}else{
					pg_close($db); 
					return true;
				}
			}
			
			function user_check($username){
				require "../logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT username FROM utente WHERE username = $1;";
				$stmtname = "UsernameCheck";
				$result = pg_prepare ($db, $stmtname, $sql);
				$ret = pg_execute($db, "UsernameCheck", array($username));
				if(!$ret){
					echo "" . pg_last_error($db);
					pg_close($db);
					return false;
				}else{
					if ($row = pg_fetch_assoc($ret)){ 
						pg_close($db); 
						return true;
					}else{
						pg_close($db);
						return false;
					}
				}
			}
			
			function mail_check($email){
				require "../logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT email FROM utente WHERE email = $1;";
				$stmtname = "EmailCheck";
				$result = pg_prepare ($db, $stmtname, $sql);
				$ret = pg_execute($db, "EmailCheck", array($email));
				if(!$ret){
					echo "" . pg_last_error($db);
					return false;
				}else{
					if ($row = pg_fetch_assoc($ret)){ 
						pg_close($db); 
						return true;
					}else{
						pg_close($db);
						return false;
					}
				}
			}

			
?>			
<script>
			function validateUsername(form){
				var username = form.username;
				if(username.value.length < 20){
					var atpos = username.value.indexOf("@",0);
					if(atpos > -1){
						alert("Non puoi inserire @ nell'username!");
						username.style.backgroundColor = "#ff9999";
						return false;
					}else 
						return true;
						
				}else
					return false;
			}
			
			
			function validatePassword(form) {
				var password = form.pwd;
				var confirm_password = form.pwd2;
				if(!validateUsername(form))
					return false;
				
					if(password.value !== confirm_password.value) {
						if(confirm_password.validationMessage == "")
							alert("Passwords don't match!");
						confirm_password.setCustomValidity("Passwords don't match");
						confirm_password.style.backgroundColor = "#ff9999";
						return false;
				    } else {
						
						return true;
				    }
			}
			
			
			//Sticky TopNav
			window.onscroll = function() {StickyTopNav()};
			var navbar = document.getElementsByClassName("topnav");
			var sticky = navbar[0].offsetTop;
			function StickyTopNav() {
				if (window.pageYOffset >= sticky) {
					navbar[0].classList.add("sticky")
				}else{
					navbar[0].classList.remove("sticky");
				}
			}
			
			
		</script>