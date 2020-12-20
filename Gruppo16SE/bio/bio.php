<?php session_start(); ?>

<html>
<head>
	<meta name="author" content="Gruppo 07"/>
    <meta name="description" content="Info del Sito"/>
	<link rel="stylesheet" href="bio.css" type="text/css" />
	
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet"/>
	<link rel="icon" href="/gruppo07/style/speech_reading_language_icon_148994.ico" type="image/ico" />
	<link rel="stylesheet" href="/Gruppo16SE/style/footer/footer.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/header/header.css" type="text/css" />
	<link rel="stylesheet" href="/Gruppo16SE/style/unique.css" type="text/css" />
	<title>CHI SIAMO[Info del Sito]</title>
</head>
	
<body>
	<?php $header =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/header/header.php";
			include($header);?>
	<div class="left column"> </div>
	
	<div class=" column middle">
		<div class="bio">
			<div class="maincontent_bio">
				<h1>CHI SIAMO</h1>
					<p>La "Ctm Industry" nasce come piccola azienda meccanica di precisione, con un'esperienza trentennale nella realizzazione e progettazione di stampi. La continua metamorfosi del settore ha indotto la nostra azienda, da oltre un decennio, ad orientare la propria attività verso nuovi mercati, che ha portato, anno dopo anno, ad investire in numerosi piani di rimodernamento, attraverso l'ampliamento del proprio stabilimento e l’inserimento di nuovi centri di lavoro.
Grazie a questi investimenti e alla capacità della Governance Aziendale di recepire le necessità di mercato, l'azienda ha raggiunto elevati standard tecnologici produttivi, al passo con le maggiori esigenze della meccanica di precisione.
                    </p>
			</div>
		</div>
		
		<div class="img_container">
			<div class="title">
				<h2>Galleria Immagini</h2>
				<p>Clicca sulle immagini sottostanti:</p>
			</div>
			<!-- The four columns -->
			<div class="gallery">
				<div class="imgs"><img src="ctm1.jpg" onclick="exendImg(this);"></div>
				<div class="imgs"><img src="ctm2.jpg" onclick="exendImg(this);"></div>
				<div class="imgs"><img src="ctm3.jpg"  onclick="exendImg(this);"></div>
				<div class="imgs"><img src="ctm4.jpg"  onclick="exendImg(this);"></div>
				<div class="imgs"><img src="ctm5.jpg"  onclick="exendImg(this);"></div>
				<div class="imgs"><img src="ctm6.jpg"  onclick="exendImg(this);"></div>
			</div>
			<div class="expandedContainer">
				<span onclick="closeBtn(this); " class="closebtn">&times;</span>
				<img id="expandedImg">
			</div>
		</div>
	</div>
	<div class="right column"> </div>
	
	<?php $footer =  $_SERVER['DOCUMENT_ROOT']."/Gruppo16SE/style/footer/footer.html";
			  include($footer);?>
	<script>
	var middle = document.getElementsByClassName("middle");
	function exendImg(imgs) {
		var expandImg = document.getElementById("expandedImg");
		expandImg.src = imgs.src;
		expandImg.parentElement.classList.add("open");
	}
		window.onscroll = function() {StickyTopNav()};
		var navbar = document.getElementsByClassName("topnav");
		var sticky = navbar[0].offsetTop;
		function StickyTopNav() {
			if (window.pageYOffset >= sticky) {
				navbar[0].classList.add("sticky");
			}else{
				navbar[0].classList.remove("sticky");
			}
		}
	
	function closeBtn(img){
		img.parentElement.classList.remove("open");
	}
		
	</script>
</body>
</html>