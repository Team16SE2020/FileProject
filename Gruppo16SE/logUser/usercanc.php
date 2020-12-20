<?php session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['id'])){
		header("location: login.php");
	}else{
?>
<head>
	<link rel="stylesheet" href="/Gruppo16SE/logUser/user.css" type="text/css" />
	<meta name="author" content="Gruppo 16"/>
	<meta name="description" content="Pagina di cancellazione dell'utente"/>
	<!-- LINK GENERALI -->	
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
	<link rel="icon" href="/Gruppo16SE/style/ludeicon.ico" type="image/ico" />
	<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
	<title>LUDE MUSIC [non andare :,( ]</title>
	<style>
		.content p{
			size: large;
			max-width: 700px;
		}
		
		.sure{
			display: none;
			margin: 10px;
			margin-left: 3%;
		}
	</style>
</head>
<body>
	<!--HEADER-->
			<?php $header =  $_SERVER['DOCUMENT_ROOT']."/gruppo07/style/header/header.php";
			include($header);?>
			
	<div class="content">
		<h1>ATTENZIONE</h1>
		<h2>CANCELLAZIONE ACCOUNT</h2>
		<p>Cancellando l'account si perde permanentemente l'accesso al sito e non si potrà più accedere ai contenuti riservati!</p>
		<p><button class="button" onclick="window.location.href = '../homePage/homePageLude.php';" style="vertical-align:middle">HomePage</button> <span>/</span> <a onclick="yes();">Si, sono sicuro di voler perdere i benefici</a></p>
		<form onsubmit="return confirm('SEI SICURO?!');" action="usercanc.php" method="post">
			<fieldset class="sure" style="width: 25%;">
			<legend>Cancellazione</legend>
			<div class="sure"><label>Utente: <b><?php echo $_SESSION['username'];?></b></div>
			<div class="sure"><label>Password: <input type="password" name="pwd" required /></label></div>
			<div class="sure"><label>Sono sicuro<input type="checkbox" name="s" required /></label></div>
			<div class="sure"><label><input type="submit" value="Cancellami!" /></label></div>
			</fieldset>
		</form>
</div>
		<!--FOOTER-->
		<?php $footer =  $_SERVER['DOCUMENT_ROOT']."/gruppo07/style/footer/footer.html";
			  include($footer);?>
</body>

<?php 

	}

		if(isset($_POST['pwd'])){
			$password = $_POST['pwd'];
		}else{
			$password = "";
		}
		
		if($password!=""){
			if(password_verify($password, get_pwd_id($_SESSION['id']))){
				if(cancel_user($_SESSION['id']))
					echo "<script>alert(\"Cancellazione avvenuta con successo!\"); window.location.href = '../homePage/homePageLude.php';</script>";
				else
					echo "<script>alert(\"Errore nella cancellazione. Riprovare!\");</script>";
			}else{
				echo "<script>alert(\"Password Errata!\");</script>";
				header("location: userpage.php");
			}
		}

		function cancel_user($id){
			require("logindb.php");
			$db = pg_connect($connection_string) or die("Errore database") .pg_last_error();
			$sql = "UPDATE utente SET canceled = 't' WHERE id = $1;";
			$stmtname = "userCancel";
			$result = pg_prepare($db, $stmtname, $sql);
			$ret = pg_execute($db, $stmtname, array($id));
				if(!$ret) {
					echo "ERRORE QUERY: " . pg_last_error($db);
					return false; 
				}
			destroy_session();
			return true;				
		}
		
		function destroy_session() { 
		$_SESSION = array();
		if(session_id() != "" ||  isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/'); 
		session_destroy();
	}
	
	function get_pwd_id($id){
				require "logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT password FROM utente WHERE id=$1;";
				$stmtname ="idPassword";
				$prep = pg_prepare($db, $stmtname, $sql); 
				$ret = pg_execute($db, "idPassword", array($id));
				if(!$ret) {
					echo "ERRORE QUERY: " . pg_last_error($db);
					return false; 
				}
				else{
					if ($row = pg_fetch_assoc($ret)){ 
						$password = $row['password'];
						return $password;
					}
					else{
						return false;
					}
				}
			}
?>
<script>
	function yes(){
		var sure = document.getElementsByClassName("sure");
		for(i=0; i<sure.length; i++){
			sure[i].style.display = "block";
		}
	}
</script>