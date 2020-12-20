<style>
@font-face {
  font-family: 'nostrofont';
  src: url('/Gruppo16SE/fonts/LinotypeAtomatic.eot');
  src: local('nostrofont'), local('LinotypeAtomatic'), url('/Gruppo16SE/fonts/LinotypeAtomatic.ttf') format('truetype');
</style>
<div class="head">
				<div class="header">
					<h1 onclick="window.location.href = '/Gruppo16SE/HomePage/HomePage.php'" style="font-family:nostrofont">ctm industry.</h1>
					<!--<a style="display: contents;" title="CTM Industries" target="_blank" <img class="social" src="ctm-logo-bianco.png" /></a>-->
				</div>			
				<div class="topnav">
					<a href="/Gruppo16SE/HomePage/HomePage.php">HomePage<div class="line">_________</div></a>	
					<a href="/Gruppo16SE/bio/bio.php">Chi siamo<div class="line">_____</div></a>
					
				
					<?php 
						if(isset($_SESSION['email'])){
							$username = $_SESSION['email'];
							echo '<a class="user" href="/Gruppo16SE/logUser/userPage.php">', $_SESSION['email'], '<div class="line">__________</div></a>';
						}else
							echo '<a class="user" href="/Gruppo16SE/logUser/login.php">Login/Register<div class="line">______________</div></a>';
		
					?>
				</div>
		</div>
			

