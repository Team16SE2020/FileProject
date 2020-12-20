<?php session_start();?>
<head>
	<link rel="stylesheet" href="/Gruppo16SE/logUser/user.css" type="text/css" />
	<meta name="author" content="Gruppo 16"/>
    <meta name="description" content="Pagina di logout"/>
	
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
	<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
	
	<title>LOG OUT[logout]</title>
	
</head>
	<?php $header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
	include($header);
	destroy_session();
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"7; url=../homepage/HomePage.php\" />";
?>
	
<html>
	<div class="content">
	<h1>Logout</h1>
	<p>Log out effettuato con successo! <button class="button" onclick="window.location.href = '../homePage/HomePage.php';" style="vertical-align:middle"><span>HomePage</span></button></p>
	</div>
</html>

<?php
function destroy_session() { 
		$_SESSION = array();
		if(session_id() != "" ||  isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/'); 
		session_destroy();
	}
?>