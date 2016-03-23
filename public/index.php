<?php

require_once('../src/BusRatp.php');
$BusRatp = new BusRatp();

?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BusRATP : Les horaires en temps réel à votre station !</title>
	<meta name="viewport" content="width=420, user-scalable=no">

	<link rel="icon" href="favicon.ico" />
	<meta name="description" content="Les horaires des bus RATP en temps réel à votre station !" />
	<link rel="canonical" href="http://busratp.pierros.fr" />
	
	<meta property="og:locale" content="fr_FR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="BusRATP : Horaires en temps réel" />
	<meta property="og:description" content="Les horaires des bus RATP, ligne par ligne, en temps réel à votre station !" />
	<meta property="og:url" content="http://busratp.pierros.fr" />
	<meta property="og:site_name" content="BusRATP" />
	<meta property="og:image" content="http://busratp.pierros.fr/assets/img/share.png?new=lala" />

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:description" content="Les horaires des bus RATP en temps réel à votre station !" />
	<meta name="twitter:title" content="BusRATP" />
	<meta name="twitter:image" content="http://busratp.pierros.fr/assets/img/share.png" />

	<link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/img/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon-180x180.png">

	<link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="assets/img/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="assets/img/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">

	<link rel="manifest" href="manifest.json">
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="mask-icon" href="assets/img/safari-pinned-tab.svg" color="#00b8a9">
	<meta name="apple-mobile-web-app-title" content="BusRATP">
	<meta name="application-name" content="BusRATP">
	<meta name="msapplication-TileColor" content="#00b8a9">
	<meta name="msapplication-TileImage" content="assets/img/mstile-144x144.png">
	<meta name="msapplication-config" content="browserconfig.xml">
	<meta name="theme-color" content="#00b8a9">

	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

	<header id="header">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 45.437 45.437" style="enable-background:new 0 0 45.437 45.437;" xml:space="preserve">
			<path d="M41.403,11.11c-0.371-3.627-0.962-6.451-1.897-7.561c-3.855-4.564-30.859-4.898-33.925,0   c-0.75,1.2-1.276,4.014-1.629,7.567c-1.139,0.134-2.026,1.093-2.026,2.267v4.443c0,0.988,0.626,1.821,1.5,2.146 c-0.207,6.998-0.039,14.299,0.271,17.93c0,2.803,1.883,2.338,1.883,2.338h1.765v3.026c0,1.2,1.237,2.171,2.761,2.171 c1.526,0,2.763-0.971,2.763-2.171V40.24h20.534v3.026c0,1.2,1.236,2.171,2.762,2.171c1.524,0,2.761-0.971,2.761-2.171V40.24h0.58 c0,0,2.216,0.304,2.358-1.016c0-3.621,0.228-11.646,0.04-19.221c0.929-0.291,1.607-1.147,1.607-2.177v-4.443   C43.512,12.181,42.582,11.206,41.403,11.11z M12.176,4.2h20.735v3.137H12.176V4.2z M12.472,36.667c-1.628,0-2.947-1.32-2.947-2.948   c0-1.627,1.319-2.946,2.947-2.946s2.948,1.319,2.948,2.946C15.42,35.347,14.101,36.667,12.472,36.667z M32.8,36.667 c-1.627,0-2.949-1.32-2.949-2.948c0-1.627,1.321-2.946,2.949-2.946s2.947,1.319,2.947,2.946   C35.748,35.347,34.428,36.667,32.8,36.667z M36.547,23.767H8.54V9.077h28.007V23.767z" fill="#FFFFFF"/>
		</svg>
		<h1><b>Bus</b>RATP</h1>
	</header>

	<form id="form" action="" method="get">
		<!--input type="hidden" name="type" value="bus"-->
		<!--select name="line" onchange="this.form.submit();">
			<option value="B39" <?php echo ($BusRatp->line=='B39') ? 'selected' : ''; ?>>39</option>
		</select-->
		
		<select name="type" onchange="this.form.submit();">
			<option value="bus" <?php echo ($BusRatp->type=='bus') ? 'selected' : ''; ?>>Bus</option>
			<option value="noctilien" <?php echo ($BusRatp->type=='noctilien') ? 'selected' : ''; ?>>Noctilien</option>
		</select>

		<input type="number" name="line" value="<?php echo $BusRatp->line; ?>" onfocus="this.value='';" onblur="this.form.submit();" autocomplete="off" step="1" min="1" placeholder="N°">

		<?php if(!empty($BusRatp->directions)): ?>
		<select name="stop" onchange="this.form.submit();" class="large">
			<?php foreach($BusRatp->stops as $k=>$v): ?>
			<option value="<?php echo $k; ?>" <?php echo ($BusRatp->stop==$k) ? 'selected' : ''; ?>><?php echo $v; ?></option>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
	</form>
	
	<?php if(!empty($BusRatp->directions)): ?>
	<div id="result">
		
		<h2><?php echo $BusRatp->type_display; ?> <?php echo $BusRatp->line_display; ?> - <?php echo $BusRatp->stop_display; ?></h2>
	
		<?php foreach($BusRatp->directions as $direction): ?>
			<div class="direction">
				<h3>Direction<?php echo $direction->direction; ?></h3>
				<?php foreach($direction->stops as $stop): ?>
					<div class="stop">
						<?php echo $stop->terminus; ?>&nbsp;: 
						<strong><?php echo $stop->timeout; ?> minute<?php echo($stop->timeout>1)?'s':''; ?></strong>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>

		<!--pre><?php print_r($BusRatp); ?></pre-->
	</div>
	<?php else: ?>
	<div id="error">
		<?php echo $BusRatp->error; ?>
	</div>
	<?php endif; ?>

	<footer id="footer">
		<p>BusRATP - <?php echo date('Y'); ?> - <a href="http://www.pierros.fr" target="_blank">Pierre Lebedel</a></p>
		<p>Sources sur <a href="https://github.com/PierreLebedel/BusRatp" target="_blank">Github</a> - Icon by <a href="http://www.freepik.com" target="_blank">Freepik</a></p>
	</footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="assets/js/app.js" type="text/javascript"></script>
</body>
</html>