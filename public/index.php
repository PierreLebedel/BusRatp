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

	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

	<header id="header">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 45.437 45.437" style="enable-background:new 0 0 45.437 45.437;" xml:space="preserve">
			<path d="M41.403,11.11c-0.371-3.627-0.962-6.451-1.897-7.561c-3.855-4.564-30.859-4.898-33.925,0   c-0.75,1.2-1.276,4.014-1.629,7.567c-1.139,0.134-2.026,1.093-2.026,2.267v4.443c0,0.988,0.626,1.821,1.5,2.146 c-0.207,6.998-0.039,14.299,0.271,17.93c0,2.803,1.883,2.338,1.883,2.338h1.765v3.026c0,1.2,1.237,2.171,2.761,2.171 c1.526,0,2.763-0.971,2.763-2.171V40.24h20.534v3.026c0,1.2,1.236,2.171,2.762,2.171c1.524,0,2.761-0.971,2.761-2.171V40.24h0.58 c0,0,2.216,0.304,2.358-1.016c0-3.621,0.228-11.646,0.04-19.221c0.929-0.291,1.607-1.147,1.607-2.177v-4.443   C43.512,12.181,42.582,11.206,41.403,11.11z M12.176,4.2h20.735v3.137H12.176V4.2z M12.472,36.667c-1.628,0-2.947-1.32-2.947-2.948   c0-1.627,1.319-2.946,2.947-2.946s2.948,1.319,2.948,2.946C15.42,35.347,14.101,36.667,12.472,36.667z M32.8,36.667 c-1.627,0-2.949-1.32-2.949-2.948c0-1.627,1.321-2.946,2.949-2.946s2.947,1.319,2.947,2.946   C35.748,35.347,34.428,36.667,32.8,36.667z M36.547,23.767H8.54V9.077h28.007V23.767z" fill="#FFFFFF"/>
		</svg>
		<h1>BusRATP</h1>
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

		<input type="number" name="line" value="<?php echo $BusRatp->line; ?>" onblur="this.form.submit();" autocomplete="off" step="1" min="1">

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
	
	<script src="assets/js/app.js" type="text/javascript"></script>
</body>
</html>