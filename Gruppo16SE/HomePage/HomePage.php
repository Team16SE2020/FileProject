<?php session_start(); ?> 
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="HomeStyle.css" type="text/css" />
		<meta name="author" content="Gruppo 16"/>
		<meta name="description" content="HomePage sito web"/>
		<!-- LINK GENERALI -->
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
		<link rel="icon" href="/gruppo07/style/speech_reading_language_icon_148994.ico" type="image/ico" />
		<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/button.css" type="text/css" />
		<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
		
		<title>CTM[Homepage]</title>
	</head>
		<body>
		<div class="parent">
			<!--HEADER-->
			<?php $header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
			include($header);?>
			
			<div class="maincontent">
					
				<img id="LUDE" src="ctm-logo-bianco.png" />
				
				<div id="loghini">
					<a style="display: contents;" title="Seguici su Facebook!" target="_blank" href="https://www.facebook.com/"> <img class="social" src="iconfinder_2018_social_media_popular_app_logo_facebook_3228552.png" /></a>
					<a style="display: contents;" title="Seguici su Twitter"target="_blank" href="https://twitter.com"> <img class="social"  src="2018_social_media_popular_app_logo_twitter-512.png" /></a>
					<a style="display: contents;" title="Seguici su Instagram"target="_blank" href="https://www.instagram.com"> <img class="social" src="2018_social_media_popular_app_logo_instagram-512 (1).png"/></a>
				</div>
			
			</div>
			
			 <div class="contatti">
                <img id="ludepiccolo" src="ctm-logo-bianco.png"/>
                <div id="info">
					<p><b>INFO E CONTATTI</b></p>
					<p>Indirizzo: Corso Vittorio Emanuele II, 5 - 83100, Avellino</p>
					<p>E-Mail: ctmindustry@gmail.com </p>
					<p>PEC: ctmindustry@pec.com</p>
					<p>Telefono: 333 3333333</p>
                </div>
            </div>
		<!--FOOTER-->
		<?php $footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
			  include($footer);?>
		</div>
		<script>
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
		</body>
</html>