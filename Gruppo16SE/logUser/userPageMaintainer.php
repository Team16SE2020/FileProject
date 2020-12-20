
<title> USER PAGE MAINTAINER[AREA UTENTE]</title>
<?php session_start();
?>
<head>		
		<link rel="stylesheet" href="/Gruppo16SE/logUser/user.css" type="text/css" />
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina utente riservata."/>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
		<link rel="icon" href="/Gruppo16SE/style/speech_reading_language_icon_148994.ico" type="image/ico" />
		<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
</head>
			
		<?php $header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
		include($header);
			

		if(!isset($_SESSION['codice_identificativo'])){
		
		?>
<html>
	<div class="content">
		<h1>Pagina Riservata</h1>
		<p>Registrati o Accedi per visualizzare l'area utente privata! 	<button class="button" onclick="window.location.href = 'login.php';" style="vertical-align:middle"><span>ACCEDI </span></button></p>
	</div>
</html>		

<?php

	}
	else{
		
?>

<html>
<head>
	<style>
		table, tr, td{
			border: solid black 1px;
		}
		.content table{
			margin-bottom: 3px;
			margin-top: 20px;
			margin-left: 20px;
			border-radius: 4pt;
			font-size: 11.8pt;
		}
		
		.content td{
			padding-right: 8px;
			padding-left: 8px;
			text-align: left;
			padding-bottom: 2px;
			padding-top: 2px;
			
		}
		.content .title{
			color: lightblue;
			margin: 15px;
		}
		
		.content .mod{
			display: none;
		}
		
	</style>
</head>

<body>
	<div class="content">	
		<h1 class="title">AREA UTENTE</h1>
		<?php 
			$username = $_SESSION['codice_identificativo'];
			if(!($info = get_user_info($username))){
			}else{
				require("userInfoMaintainer.php");
			}
	}
		?>
	</div>
<!--FOOTER-->
		<?php $footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
			  include($footer);?>
	
	
<?php
	
	if(isset($_POST['pwd'])){
		$password = $_POST['pwd'];
	}else{
		$password = null;
	}
	if(isset($_POST['pwd2'])){
		$password2 = $_POST['pwd2'];
	}else{
		$password2 = null;
	}
	if(isset($_POST['oldPwd'])){
		$oldPassword = $_POST['oldPwd'];
	}else{
		$oldPassword = null;
	}
	
	if(!is_null($password)){
		if($password == $password2) 
			mod_pin($_SESSION['codice_identificativo'], $password);
	
	}
	
	
	function mod_pin($username, $pwd){
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$sql = "UPDATE utente SET pin = $1 WHERE codice_identificativo = $2;";
                        $stmtname = "modpin";
                        $result = pg_prepare($db, $stmtname, $sql);
                        $ret = pg_execute($db, $stmtname, array($pwd, $username));
                        if(!$ret) {
                            echo "ERRORE QUERY: " . pg_last_error($db);
                            return false;
                        }
        return true;
           
    }
	
	
           
    
	
	
	
	function get_user_info($username){
		require("logindb.php");
		$db = pg_connect($connection_string) or die("Impossibile connettersi al database").pg_last_error();
		$sql= "SELECT nome,cognome,ruolo,email FROM utente WHERE codice_identificativo=$1";
		$result = pg_prepare($db, "userInfo", $sql);
		$ret = pg_execute($db, "userInfo", array($username));
		if(!$ret){
			echo pg_last_error();
		}else{
			if($row = pg_fetch_assoc($ret)){
				return $row;
			}else{
				return false;
			}
		}
	}
	
	
	
	
	function destroy_session() { 
		$_SESSION = array();
		if(session_id() != "" ||  isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/'); 
		session_destroy();
	}

			
	
	
?>
</body>
<script>
	var obj = document.getElementsByClassName("mod");
	var link = document.getElementById("link");
	var inputs = document.getElementsByClassName("in");
	var radio = document.getElementsByClassName("ins");
	
	function modify(){
		for(i=0; i<obj.length; i++){
		obj[i].style.display = "table-cell";
		}
		link.style.display = "none";
		document.getElementById("button").style.display = "table-row";
	}
	
	
	
	function confMod(form){
				if(confirm("Vuoi confermare le modifiche?")){
					var oldpw = document.getElementById('pwdOld');
					var pw = prompt("Inserisci la password corrente:", "");
					if(pw != "" && pw != null){
						oldpw.value = pw;
						return true;
					}else{
						oldpw.value="";
						return false;
					}
				}
			
		else{
			alert("Nessuna modifica!");
		}
		
		return false;
	}
	
	
	

	
</script>