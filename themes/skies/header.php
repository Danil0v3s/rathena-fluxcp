<?php if (!defined('FLUX_ROOT')) exit; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta property="og:title" content="SkiesRO - Full PvP 999/255">
	<meta property="og:image" content="https://i.imgur.com/VQh4PKs.png">
	<meta property="og:description" content="Full PvP 999/255. O LENDÁRIO FULL PVP">
	<meta property="og:url" content="http://www.skiesro.com.br">
	<?php if (isset($metaRefresh)) : ?>
		<meta http-equiv="refresh" content="<?php echo $metaRefresh['seconds'] ?>; URL=<?php echo $metaRefresh['location'] ?>" />
	<?php endif ?>
	<title><?php echo Flux::config('SiteTitle');
			if (isset($title)) echo ": $title" ?></title>
	<link rel="icon" type="image/x-icon" href="./favicon.ico" />
	<link rel="stylesheet" href="<?php echo $this->themePath('css/flux.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
	<link rel="stylesheet" href="<?php echo $this->themePath('css/main.scss') ?>" type="text/css" media="screen" title="" charset="utf-8" />
	<link href="<?php echo $this->themePath('css/flux/unitip.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">
	<?php if (Flux::config('EnableReCaptcha')) : ?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php endif ?>
	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo $this->themePath('css/flux/ie.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
		<![endif]-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="<?php echo $this->themePath('css/sticky-footer-navbar.css') ?>" rel="stylesheet">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
	<!-- Fixed navbar -->
	<div class="bg-header container-fluid">
		<div class="btn-discord">
			<a href="https://discordapp.com/invite/u9z63b3">
				<img src="<?php echo $this->themePath('img/discord-full.svg') ?>" />
			</a>
		</div>
		<div class="logo">
			<a href="<?php echo $this->basePath ?>">
				<img src='<?php echo $this->themePath('img/logo.png') ?>' />
			</a>
		</div>

		<div id="drawmoveCanvasContainer">
		</div>
	</div>
	<?php include $this->themePath('main/navbar.php', true) ?>

	<div class="container-fluid">
		<div class="col-md-2">
			<?php if (!$session->isLoggedIn()) : ?>
				<?php include('main/loginsmall.php'); ?>
			<?php endif ?>
		</div>
		<div class="col-md-8 ro-container">
			<?php if (Flux::config('DebugMode') && @gethostbyname(Flux::config('ServerAddress')) == '127.0.0.1') : ?>
				<p class="notice">Please change your <strong>ServerAddress</strong> directive in your application config to your server's real address (e.g., myserver.com).</p>
			<?php endif ?>

			<!-- Messages -->
			<?php if ($message = $session->getMessage()) : ?>
				<p class="message"><?php echo htmlspecialchars($message) ?></p>
			<?php endif ?>

			<!-- Sub menu -->
			<?php include $this->themePath('main/submenu.php', true) ?>

			<!-- Page menu -->
			<?php //include $this->themePath('main/pagemenu.php', true) 
			?>
