<?php session_start();
	if(isset($_SESSION['codice_identificativo'])){
		header("location: userPage.php");
	}
?>
<html>
	<head>
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="Pagina di login per gli utenti"/>
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
		<link rel="icon" href="/Gruppo16SE/style/ludeicon.ico" type="image/ico" />
		<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
		
	<title>CTM INDUSTRY [Login]</title>
		<style>
			.header{
				display: none;
			}
			.content{
				background-color: rgba(0,0,0,0.05);
				width: 510px;
				height: 400px;
				border: 3px solid #6709b7;
				border-radius: 18px;
				margin: 50px auto;
				z-index: 1;
			}
			
			.content h1{
				text-align: center;
			}
			
			
			
			.linea{
				margin-top: 20px;
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 20px;
				width: 90%;
				display: block;
				height: 10px;
				
			}
			
			.linea hr{
				width: 170px;
				float: left;
				display: block;		
			}
			
			.button.button2{
				display: block;
				margin: 35px auto;
				width: 400px;
				height: 45px;
			}
			.error{
				display:block;
				height:2em;
				color: red;
				text-align: center;
				margin-top: 71px;
			}
			.in{
				float:right;
				margin: 0 10px;
				border-width: 1px;
			}
			.label{
				display: inline-block;	
				margin: 6px 16px;
				font-size: 10pt;
				padding-top: 3px;
			}
		</style>
		
		<script>			
			function blank(ob){
					ob.style.backgroundColor = "white";
			}
		</script>
	</head>
	<body>
	<div class="error">
		<?php if(isset($_POST['login']))
					$login = $_POST['login'];
				else
					$login = "";
			  if(isset($_POST['pwd']))
					$password = $_POST['pwd'];
				else
					$password = "";
		
			if (!empty($login) && !empty($password)){
				if(!user_exists($login)){
						echo"<p>CODICE IDENTIFICATIVO O PIN ERRATI!</p>";
						echo "<style> \n .in{background-color: #ff72616b;};\n </style>";
					}else{
					if ($_POST['captcha'] != $_SESSION['captcha']) {
						echo" <p>CODICE CAPTCHA NON VALIDO!</p>";
						echo "<style> \n .in{background-color: #ff72616b;};\n </style>";
					}else{
							if(pwd_check($password, get_pwd_user($login))){
							
							$userid = get_id_byname($login);
							$_SESSION['email'] = $userid;
							$_SESSION['codice_identificativo'] = $login;
								header("location: ../homePage/HomePage.php");
							}else{
								echo"<p>CODICE IDENTIFICATIVO O PIN ERRATI!</p>";
								echo "<style> \n .in{background-color: #ff72616b;};\n </style>";
							}
						
					}
				}
			}
			
?>
	</div>
		<?php //HEADER
			$header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
			include($header);
		?>
	
		<div class="content">
			<div class="login">
				<h1>LOGIN</h1>
				
				<form name="loginF" method="post" action="login.php" enctype="multipart/form-data" />
					<label for="mail" class="label">CODICE IDENTIFICATIVO: <input oninput="blank(this);" maxlength="8" class="in" type="input" size="25" name="login" value="<?php echo $login ?>" placeholder="Inserisci il codice identificativo" required /></label>
					<label for="pwd" class="label">PIN: <input oninput="blank(this);" maxlength="5" class="in" type="password" size="15" name="pwd" placeholder="*******" required /></label>
					<br>
					<p class="label"> <img src="./captcha.php"/></p>
					<label for="captcha" class="label">CAPTCHA: <input type="text" name="captcha" placeholder="Inserire il codice raffigurato"  /> <br><br>
					<input type="submit" class="button button2" value="INVIA"/>
				</form>
				
				
				
			
			
			<script>
				document.loginF.login.focus();
				
				
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
			</div>
		</div>
		
		<!--FOOTER-->
		<?php $footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
			  include($footer);?>
		
		<div class="error">
		<?php 
			
			function user_exists($username){
				require_once('logindb.php');
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT codice_identificativo FROM utente WHERE codice_identificativo = $1;";
				$stmtname = "UsernameCheck";
				$result = pg_prepare ($db, $stmtname, $sql);
				$ret = pg_execute($db, "UsernameCheck", array($username));
				if(!$ret){
					echo "" . pg_last_error($db);
					return false;
				}else{
					if ($row = pg_fetch_assoc($ret)){ 
						return true;
					}else{
						return false;
					}
				}
			}
			
			
			
			function get_pwd_user($username){
				require "logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT pin FROM utente WHERE codice_identificativo=$1;";
				$stmtname ="userPassword";
				$prep = pg_prepare($db, $stmtname, $sql); 
				$ret = pg_execute($db, "userPassword", array($username));
				if(!$ret) {
					echo "ERRORE QUERY: " . pg_last_error($db);
					return false; 
				}
				else{
					if ($row = pg_fetch_assoc($ret)){ 
						$password = $row['pin'];
						return $password;
					}
					else{
						return false;
					}
				}
			}	
			
			
			
			
			function get_id_byname($username){
				require "logindb.php";
				$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
				$sql = "SELECT email FROM utente WHERE codice_identificativo = $1;";
				$stmtname ="idbyUser";
				$prep = pg_prepare($db, $stmtname, $sql); 
				$ret = pg_execute($db, $stmtname, array($username));
				if(!$ret) {
					echo "ERRORE QUERY: " . pg_last_error($db);
					return false; 
				}
				else{
					if ($row = pg_fetch_assoc($ret)){ 
						$id = $row['email'];
						return $id;
					}
					else{
						return false;
					}
				}
			}
			
			

			function pwd_check($dbpwd, $pwd){
				if($dbpwd == $pwd)
					return true;
				else
					return false;
			}
		
		?>
	</body>


</html>