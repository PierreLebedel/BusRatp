<?php

require_once('../src/BusRatp.php');

if( isset($_GET['type']) ){
	$type = $_GET['type'];
	setcookie('type', $type, time()+(3600*24*360), "/");
}else if( isset($_COOKIE['type']) ){
	$type = $_COOKIE['type'];
}else{
	$type = 'bus';
}

if( isset($_GET['line']) ){
	$line = $_GET['line'];
	setcookie($type, $line, time()+(3600*24*360), "/");
}else if( isset($_COOKIE[$type]) ){
	$line = $_COOKIE[$type];
}else{
	$line = '39';
}

if( isset($_GET['stop']) ){
	$stop = $_GET['stop'];
	setcookie($type.'_'.$line, $stop, time()+(3600*24*360), "/");
}else if( isset($_COOKIE[$type.'_'.$line]) ){
	$stop = $_COOKIE[$type.'_'.$line];
}else{
	$stop = false;
}

$BusRatp = new BusRatp($type, $line, $stop);
//BusRatp::debug($_COOKIE);


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
		<svg id="icon_bus" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 45.437 45.437" style="enable-background:new 0 0 45.437 45.437;" xml:space="preserve">
			<path d="M41.403,11.11c-0.371-3.627-0.962-6.451-1.897-7.561c-3.855-4.564-30.859-4.898-33.925,0   c-0.75,1.2-1.276,4.014-1.629,7.567c-1.139,0.134-2.026,1.093-2.026,2.267v4.443c0,0.988,0.626,1.821,1.5,2.146 c-0.207,6.998-0.039,14.299,0.271,17.93c0,2.803,1.883,2.338,1.883,2.338h1.765v3.026c0,1.2,1.237,2.171,2.761,2.171 c1.526,0,2.763-0.971,2.763-2.171V40.24h20.534v3.026c0,1.2,1.236,2.171,2.762,2.171c1.524,0,2.761-0.971,2.761-2.171V40.24h0.58 c0,0,2.216,0.304,2.358-1.016c0-3.621,0.228-11.646,0.04-19.221c0.929-0.291,1.607-1.147,1.607-2.177v-4.443   C43.512,12.181,42.582,11.206,41.403,11.11z M12.176,4.2h20.735v3.137H12.176V4.2z M12.472,36.667c-1.628,0-2.947-1.32-2.947-2.948   c0-1.627,1.319-2.946,2.947-2.946s2.948,1.319,2.948,2.946C15.42,35.347,14.101,36.667,12.472,36.667z M32.8,36.667 c-1.627,0-2.949-1.32-2.949-2.948c0-1.627,1.321-2.946,2.949-2.946s2.947,1.319,2.947,2.946   C35.748,35.347,34.428,36.667,32.8,36.667z M36.547,23.767H8.54V9.077h28.007V23.767z" fill="#FFFFFF"/>
		</svg>
		<h1><b>Bus</b>RATP</h1>

		<svg id="icon_man" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
			<ellipse fill="#FFFFFF" cx="167.974" cy="57.465" rx="58.001" ry="57.465"/>
			<path fill="#FFFFFF" d="M49.364,166.832c8.041-9.395,22.254-10.551,31.745-2.58c10.591,8.907,31.124,11.563,49.918,6.479 c15.255-4.13,26.426-12.531,29.919-22.479c0.307-0.898,0.696-1.755,1.118-2.583c3.907-12.204,13.169-22.64,23.347-29.209
			c2.343-2.054,5.149-3.653,8.332-4.613c1.386-0.603,2.914-1.181,4.508-1.644c5.955-1.743,12.999-2.473,12.999-2.473l0.178-0.033
			c2.902-0.201,5.902-0.16,8.923,0.078c28.165-1.107,59.615,6.651,87.076,22.118c31.749,17.874,53.527,43.363,61.313,71.772
			c0.132,0.487,0.228,0.976,0.323,1.464c2.33-0.689,4.958-0.197,6.854,1.574l5.836,5.421l23.706-25.05l62.518,58.063l-79.382,83.881
			l-62.521-58.071l23.708-25.047l-5.837-5.421c-2.57-2.391-2.913-6.236-0.984-9.033c-8.257-1.505-15.347-7.517-17.689-16.078
			c-4.561-16.611-19.176-32.896-40.105-44.68c-4.536-2.555-9.225-4.814-13.988-6.795l31.123,96.519
			c1.896,5.889,2.244,11.671,1.465,17.219l21.87,57.834l68.149,3.354c14.685,0.734,25.987,13.097,25.259,27.642
			c-0.703,14.102-12.466,25.059-26.554,25.059c-0.447,0-0.895-0.017-1.342-0.032l-85.61-4.22
			c-10.607-0.521-19.879-7.233-23.604-17.083l-19.126-50.564c-2.293,0.619-4.619,1.107-6.978,1.456l-34.91,49.908l29.885,109.771
			c3.833,14.062-4.568,28.528-18.765,32.321c-2.317,0.619-4.647,0.927-6.945,0.927c-11.737,0-22.486-7.755-25.677-19.515
			l-33.103-121.586c-2.044-7.496-0.637-15.496,3.821-21.881l34.811-49.776c-1.626-2.646-3.017-5.532-4.051-8.738l-28.836-89.43
			c-8.517,5.434-18.314,9.751-29.162,12.691c-10.235,2.772-20.698,4.117-30.908,4.117c-23.037,0-44.836-6.84-60.025-19.609
			C42.485,190.307,41.318,176.23,49.364,166.832z M347.979,234.212l5.831,5.421l23.89-25.247l-5.836-5.417
			c-0.468-0.438-1.209-0.414-1.647,0.05l-0.849,0.901c-0.977,8.861-7.268,16.652-16.468,19.13c-0.666,0.18-1.342,0.278-2.008,0.401
			l-0.426,0.447l-2.542,2.686C347.478,233.047,347.499,233.781,347.979,234.212z"/>
		</svg>
	</header>

	<form id="form" action="" method="get">
		
		<select id="select_type" name="type">
			<option value="bus" <?php echo ($BusRatp->type=='bus') ? 'selected' : ''; ?>>Bus</option>
			<option value="noctilien" <?php echo ($BusRatp->type=='noctilien') ? 'selected' : ''; ?>>Noctilien</option>
		</select>

		<input id="input_line" type="number" name="line" value="<?php echo $BusRatp->line; ?>" autocomplete="off" step="1" min="1">

		<?php if(!empty($BusRatp->directions)): ?>
		<select id="select_stop" name="stop" onchange="this.form.submit();" class="large">
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

	<a href="#" id="refresh">Actualiser</a>

	<footer id="footer">
		<p>BusRATP - <?php echo date('Y'); ?> - <a href="http://www.pierros.fr" target="_blank">Pierre Lebedel</a></p>
		<p>Sources sur <a href="https://github.com/PierreLebedel/BusRatp" target="_blank">Github</a> - Icons by <a href="http://www.freepik.com" target="_blank">Freepik</a></p>
	</footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script src="assets/js/app.js" type="text/javascript"></script>
</body>
</html>