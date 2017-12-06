<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- meta stuff -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dhevak - Analoge Websites</title>
	<meta name="author" content="Alvaro Trigo Lopez" />
	<meta name="description" content="Project: Analoge Websites van Dhevak. Tomi Ristic &amp; Frank Arling. (Webdesign, Grafisch Design &amp; Socio-Culturele Projecten)" />
	<meta name="keywords"  content="webdesign, art, video, dhevak, innovative, grapicdesign, projects, emmen, drenthe, entrpeneur, web, experimental, design, mobile, coloring, people, together" />
	<meta name="Resource-type" content="Document" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="isd3UpdRa3pcKsh_V1BpIcwvhDUn7t_SQSTWPbNMzbc" />

	<!-- CSS Include -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/analoge-websites/reset.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/analoge-websites/jquery.fullPage.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/analoge-websites/style.css') }}" />

	<!-- Scripts -->
	<script src="scripts/jquery-3.1.1.min.js"></script>
	<script src="scripts/jquery.fullPage.js"></script>
	<script src="scripts/scripts.js"></script>
  <script src="scripts/analythics-script.js"></script>
	<!-- scroll overflow library -->

</head>
<body>
	<div class="loader-wrapper">
		<div class="loader"></div>
	</div>
	<div id="fullpage">
		<!-- Binnenkomer -->
		<div class="section active">
			<video class="binnenkomer-video" id='binnenkomer' autoplay loop>
				<source data-src="videos/binnenkomer-video.mp4" type="video/mp4">
				Your browser does not support HTML5 video.
			</video>
			<div class="binnenkomer-titel">
			</div>
		</div>
		<!-- Introduction Analoge Websites -->
		<div class="section" id='introduction-background'>
			<div class='tekst-image'>
				<div class="center">
					Wassup!
					<br /><br />
					Awesome dat je even een kijkje komt nemen naar Dhèvaks nieuwe kunstproject: Analoge Websites. Wij zijn Frank Arling en Tomi Ristic; een stel leipo’s die onder naam van kunstcollectief Dhèvak dit project zijn begonnen.
				</div>
				<div class="center">
					Ons doel met dit project is om met een frisse blik te kijken naar het concept ‘websites maken’. </br/> </br />We zagen websites van verschillende soorten instanties en organisaties en meestal was het standaard wordpress schijt. We gaan saaie alledaagse standaard concepten innoveren, de standaard uitdagen, mensen aan het denken zetten en gedurende het process misschien zelfs wat ogen openen want hey zeg nou eens zelfs de wereld ziet er een stuk mooier uit met de ogen wijd open. Of een bril dat helpt ook wel.
				</div>
				<div class="center">
					Wij vroegen ons af: waarom heeft een creatief bedrijf of museum geen kunstwerk als website. Wij willen creatieve bedrijven de kans bieden om dit kunstwerk te krijgen.
					Vind jij ook niet dat het verhaal van jouw bedrijf op een fantastische manier verteld moet worden?
				</div>
				<div class="center">
					Dhèvak werkt samen met  jonge kunstenaars (Zoals de gave Amber Rozema die deze site heeft gemaakt en Tessa Langeveld die het intro filmpje deed) die het concept en materiaal leveren voor deze gave analoge websites. Vervolgens maken de developers deze materialen digitaal en gebruiken ze als bouwstenen van de website.
					Deze website geeft een sneak peak van de mogelijkheden die dit concept biedt.
				</div>
			</div>

		</div>
                <!-- werkwijze -->
		<div class="section">
			<video class="werkwijze-video" id='werkwijze'>
				<source data-src="videos/werkwijze-video.mp4" type="video/mp4">
				Your browser does not support HTML5 video.
			</video>
			<div class='fullpage-container dhevak-het-moet-achtergrond'>
				<div class='replay'></div>
			</div>
		</div>
		<!-- Wie zijn we -->
		<div class="section">
			<div class='fullpage-container'>
                            <img class="foto-portret frank-portret" src="images/frank-portret.jpg" alt="Frank Portret">
                            <img class="foto-portret frank-foto" src="images/frank-foto.jpg" alt="Frank Foto">
			</div>
		</div>
		<div class="section">
			<div class='fullpage-container'>
                            <img class="foto-portret tomi-portret" data-src="images/tomi-portret.jpg" alt="Tomi Portret">
                            <img class="foto-portret tomi-foto" data-src="images/tomi-foto.jpg" alt="Tomi Foto">
			</div>
		</div>
		<div class="section">
			<div class='fullpage-container'>
                            <img class="foto-portret amber-portret" data-src="images/amber-portret.jpg" alt="Amber Portret">
                            <img class="foto-portret amber-foto" data-src="images/amber-foto.jpg" alt="Amber Foto">
			</div>
		</div>
		<!-- contact -->
		<div class="section" id="contact">
			<section id="hire">
				<div class='contact-titel'></div>
				<form method="post" action="{{ route('sendmail') }}">
	                <div class="field name-box">
	                    <input type="text" name='name' id="name" placeholder="Drop je naam" required>
	                    <label for="name">Naam</label>
	                </div>
	                <div class="field email-box">
	                    <input type="text" name='email' id="email" placeholder='Drop je email' required>
	                    <label for="email">Email</label>
	                </div>
	                <div class="field msg-box">
	                    <label id='msg' for="content">Samenwerken?</label>
	                    <textarea id="msg" name="content" rows="4" placeholder='Kom met ons gave shit maken. Laat ons je idee horen.'></textarea>
	                </div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	                <input class='button' type='submit' name='submit' value='Verstuur'>
				</form>
			</section>
		</div>
	</div>
</body>
</html>
