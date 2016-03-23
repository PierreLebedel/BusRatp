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
		<p>Sources sur <a href="https://github.com/PierreLebedel/BusRatp" target="_blank">Github</a></p>
	</footer>
	
	<script src="assets/js/app.js" type="text/javascript"></script>
</body>
</html>