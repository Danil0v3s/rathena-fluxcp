<?php if (!defined('FLUX_ROOT')) exit; 
include $this->themePath('settings.php', true); 
include $this->themePath('main/functions.php', true); 
?>
<!DOCTYPE html>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php if (isset($metaRefresh)): ?>
		<meta http-equiv="refresh" content="<?php echo $metaRefresh['seconds'] ?>; URL=<?php echo $metaRefresh['location'] ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php endif ?>
		<title><?php if (isset($title)) echo "$title &raquo; "; echo Flux::config('SiteTitle'); ?></title>
		<!--[if lt IE 9]>
		<script src="<?php echo $this->themePath('js/html5.js') ?>" type="text/javascript"></script>
		<![endif]-->
		<link rel='stylesheet' id='style-css' href='<?php echo $this->themePath('css/main.css?nocache='.rand()) ?>' type='text/css' media='all' />
		<link href="<?php echo $this->themePath('css/flux/unitip.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
		<?php if (Flux::config('EnableReCaptcha')): ?>
		<link rel='stylesheet' id='recaptcha-css' href='<?php echo $this->themePath('css/flux/recaptcha.css') ?>' type='text/css' media='screen' />
		<?php endif ?>
		
				<!--[if lt IE 9]>
		<script src="<?php echo $this->themePath('js/ie9.js') ?>" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.unitpngfix.js') ?>"></script>
		<![endif]-->
		<!--- Stellar Theme --->
		
		<!--[if lte IE 8]><script src="<?php echo $this->themePath('js/ie/html5shiv.js')?>"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo $this->themePath('css/main.css')?>" />
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo $this->themePath('css/ie9.css')?>" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo $this->themePath('css/ie8.css')?>" /><![endif]-->
		<!-- Scripts -->
			<script src="<?php echo $this->themePath('js/jquery.min.js')?>"></script>
			<script src="<?php echo $this->themePath('js/jquery.scrollex.min.js')?>"></script>
			<script src="<?php echo $this->themePath('js/jquery.scrolly.min.js')?>"></script>
			<script src="<?php echo $this->themePath('js/skel.min.js')?>"></script>
			<script src="<?php echo $this->themePath('js/util.js')?>"></script>
			<!--[if lte IE 8]><script src="<?php echo $this->themePath('js/ie/respond.min.js')?>"></script><![endif]-->
			<script src="<?php echo $this->themePath('js/main.js')?>"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.datefields.js') ?>"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.unitip.js') ?>"></script>
			<script src="<?php echo $this->themePath('js/countdown.js')?>"></script>
		
		
		<link rel="icon" href="<?php echo $stellar_settings['favicon'] ?>" type="image/x-icon"/>
		<link rel="shortcut icon" href="<?php echo $stellar_settings['favicon']?>" type="image/x-icon"/>
		<script type='text/javascript'>
			$(document).ready(function(){
				$('.money-input').keyup(function() {
					var creditValue = parseInt($(this).val() / <?php echo Flux::config('CreditExchangeRate') ?>, 10);
					if (isNaN(creditValue))
						$('.credit-input').val('?');
					else
						$('.credit-input').val(creditValue);
				}).keyup();
				$('.credit-input').keyup(function() {
					var moneyValue = parseFloat($(this).val() * <?php echo Flux::config('CreditExchangeRate') ?>);
					if (isNaN(moneyValue))
						$('.money-input').val('?');
					else
						$('.money-input').val(moneyValue.toFixed(2));
				}).keyup();
				
				// In: js/flux.datefields.js
				processDateFields();
			});
			
			function reload(){
				window.location.href = '<?php echo $this->url ?>';
			}
		</script>
		
		<script type='text/javascript'>
			function updatePreferredServer(sel){
				var preferred = sel.options[sel.selectedIndex].value;
				document.preferred_server_form.preferred_server.value = preferred;
				document.preferred_server_form.submit();
			}

			function updatePreferredTheme(sel){
				var preferred = sel.options[sel.selectedIndex].value;
				document.preferred_theme_form.preferred_theme.value = preferred;
				document.preferred_theme_form.submit();
			}
			
			// Preload spinner image.
			var spinner = new Image();
			spinner.src = '<?php echo $this->themePath('img/spinner.gif') ?>';
			
			function refreshSecurityCode(imgSelector){
				$(imgSelector).attr('src', spinner.src);
				
				// Load image, spinner will be active until loading is complete.
				var clean = <?php echo Flux::config('UseCleanUrls') ? 'true' : 'false' ?>;
				var image = new Image();
				image.src = "<?php echo $this->url('captcha') ?>"+(clean ? '?nocache=' : '&nocache=')+Math.random();
				
				$(imgSelector).attr('src', image.src);
			}
			function toggleSearchForm()
			{
				//$('.search-form').toggle();
				$('.search-form').slideToggle('fast');
			}
		</script>

		<?php if (Flux::config('EnableReCaptcha') && Flux::config('ReCaptchaTheme')): ?>
		<script type="text/javascript">
			 var RecaptchaOptions = {
			    theme : '<?php echo Flux::config('ReCaptchaTheme') ?>'
			 };
		</script>
		<?php endif ?>
		
		<?php if (in_array($params->get('module'), array('main'))):?>
		<script type="text/javascript">
		$(document).ready(function() {
			$(".woe_time").countdown({
				date: "<?php echo date("F d, Y H:i:s", $startingTime); ?>",
				onComplete: function( event ) {
				},
				concat: " ",
				leadingZero: true,
				offSet: <?php $time = explode(":", str_replace("+", "", $server->getServerTime('P'))); echo intval($time[0].".".($time[1]/60));?>
			});
		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}

		function startTime() {
			var today = new Date();
			
			var h = <?php echo $server->getServerTime('H') ?>;
			var m = <?php echo $server->getServerTime('i') ?>;
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
			t = setTimeout(function () {
				startTime()
			}, 500);
		}
		startTime();
		});
		</script>
		<?php endif ?>
	</head>
	<body>
		<div id="wrapper">
			
				<!-- Header -->
					<header id="header" class="alt">
						<a href ="<?php echo $this->url('main')?>"><span class="logo"><img src="<?php echo $stellar_settings['logo'] ?>" alt="" /></span>
						<?php if($stellar_settings['showTitle']): ?><h1><?php echo Flux::config('SiteTitle') ?></h1><?php endif ?>
						<?php if($stellar_settings['showDescription']): ?><p><?php echo $stellar_settings['description'] ?></p><?php endif ?>
						</a>
					</header>
			

			<!-- Main -->
			<div id="main">		
					<?php if (Flux::config('DebugMode') && @gethostbyname(Flux::config('ServerAddress')) == '127.0.0.1'): ?>
					<!--Please change your <strong>ServerAddress</strong> directive in your application config to your server's real address (e.g., myserver.com).-->
					<?php endif ?>
								
					<!-- Messages -->
					<?php if ($message=$session->getMessage()): ?>
					<p class="message"style="margin-bottom: 30px;"><?php echo htmlspecialchars($message) ?></p>
					<?php endif ?>
				
				<!-- Nav -->
					<nav id="nav">
						<ul>
							<?php foreach($stellar_settings['siteNavi'] as $url => $siteTitle): ?>
							<li><a href="<?php echo $url?>"><?php echo $siteTitle ?></a></li>
							<?php endforeach ?>
						</ul>
						
						
						<!-- Sub menu -->
						<?php include $this->themePath('main/newsub.php', true) ?>
						
									
					</nav>
				<?php if (!in_array($params->get('module'), array('main'))):?>
				<div style="padding: 10px;">
				<?php endif ?>
						<!-- Credit balance -->
						<?php if (in_array($params->get('module'), array('donate', 'purchase'))) include $this->themePath('main/balance.php', true) ?>
