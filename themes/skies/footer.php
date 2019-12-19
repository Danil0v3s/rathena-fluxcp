<?php if (!defined('FLUX_ROOT')) exit; ?>

</div> <!-- close column -->
<div class="col-md-2 server-status-box">
	<?php 
		$cServerStatus = array();
		foreach (Flux::$loginAthenaGroupRegistry as $groupName => $loginAthenaGroup) {
			if (!array_key_exists($groupName, $cServerStatus)) {
				$cServerStatus[$groupName] = array();
			}
			$loginServerUp = $loginAthenaGroup->loginServer->isUp();
			foreach ($loginAthenaGroup->athenaServers as $athenaServer) {
				$serverName = $athenaServer->serverName;
				$sql = "SELECT COUNT(char_id) AS players_online FROM {$athenaServer->charMapDatabase}.char WHERE online > 0";
				$sth = $loginAthenaGroup->connection->getStatement($sql);
				$sth->execute();
				$res = $sth->fetch();
				$cServerStatus[$groupName][$serverName] = array(
					'loginServerUp' => $loginServerUp,
					'charServerUp' => $athenaServer->charServer->isUp(),
					'mapServerUp' => $athenaServer->mapServer->isUp(),
					'playersOnline' => intval($res ? $res->players_online : 0)
				);
			}
		}
	?>
	<?php foreach ($cServerStatus as $privServerName => $gameServers) : ?>
		<?php foreach ($gameServers as $serverName => $gameServer) : ?>
			<?php
				$sStatus = "up";
				if (!($gameServer['loginServerUp'] && $gameServer['charServerUp'] && $gameServer['mapServerUp'])){
					$sStatus = "down";
				}
			?>
			<h3 class="invert"><?php echo htmlspecialchars(Flux::message('ServerStatusHeading')) ?></h3>
			<h4 class="<?php echo $sStatus ?>"><?php if ($sStatus) echo "ONLINE"; else echo "OFFLINE"; ?></h4>
			<h3 class="invert"><?php echo htmlspecialchars(Flux::message('ServerStatusOnlineLabel')) ?></h3>
			<h4 class="invert"><?php echo $gameServer['playersOnline'] ?></h4>
		<?php endforeach ?>
	<?php endforeach ?>
	<!-- <img src="<?php echo $this->themePath('img/coffin.gif') ?>" /> -->
</div>
</div> <!-- close container -->
<div id="footer">
	<div class="container">
		<p class="text-muted">
			<?php if (Flux::config('ShowCopyright')) : ?>
				Powered by <a href="https://github.com/daniloleemes" target="_blank">Danilov3s</a>
			<?php endif ?>
		</p>
		<form action="<?php echo $this->urlWithQs ?>" method="post" name="preferred_theme_form" style="display: none">
			<input type="hidden" name="preferred_theme" value="" />
		</form>
	</div>
</div>


<!--[if lt IE 9]>
		<script src="<?php echo $this->themePath('js/ie9.js') ?>" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.unitpngfix.js') ?>"></script>
		<![endif]-->

<script type="text/javascript">
	function updatePreferredServer(sel) {
		var preferred = sel.options[sel.selectedIndex].value;
		document.preferred_server_form.preferred_server.value = preferred;
		document.preferred_server_form.submit();
	}

	function updatePreferredTheme(sel) {
		var preferred = sel.options[sel.selectedIndex].value;
		document.preferred_theme_form.preferred_theme.value = preferred;
		document.preferred_theme_form.submit();
	}

	function updatePreferredLanguage(sel) {
		var preferred = sel.options[sel.selectedIndex].value;
		setCookie('language', preferred);
		reload();
	}

	// Preload spinner image.
	var spinner = new Image();
	spinner.src = '<?php echo $this->themePath('img/spinner.gif') ?>';

	function refreshSecurityCode(imgSelector) {
		$(imgSelector).attr('src', spinner.src);

		// Load image, spinner will be active until loading is complete.
		var clean = <?php echo Flux::config('UseCleanUrls') ? 'true' : 'false' ?>;
		var image = new Image();
		image.src = "<?php echo $this->url('captcha') ?>" + (clean ? '?nocache=' : '&nocache=') + Math.random();

		$(imgSelector).attr('src', image.src);
	}

	function toggleSearchForm() {
		//$('.search-form').toggle();
		$('.search-form').slideToggle('fast');
	}

	function setCookie(key, value) {
		var expires = new Date();
		expires.setTime(expires.getTime() + expires.getTime()); // never expires
		document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
	}
</script>

<?php if (Flux::config('EnableReCaptcha') && Flux::config('ReCaptchaTheme')) : ?>
	<script type="text/javascript">
		var RecaptchaOptions = {
			theme: '<?php echo Flux::config('ReCaptchaTheme') ?>'
		};
	</script>
<?php endif ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var inputs = 'input[type=text],input[type=password],input[type=file]';
		$(inputs).focus(function() {
			$(this).css({
				'background-color': '#f9f5e7',
				'border-color': '#dcd7c7',
				'color': '#726c58'
			});
		});
		$(inputs).blur(function() {
			$(this).css({
				'backgroundColor': '#ffffff',
				'borderColor': '#dddddd',
				'color': '#444444'
			}, 500);
		});
		$('.menuitem a').hover(
			function() {
				$(this).fadeTo(200, 0.85);
				$(this).css('cursor', 'pointer');
			},
			function() {
				$(this).fadeTo(150, 1.00);
				$(this).css('cursor', 'normal');
			}
		);
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

	function reload() {
		window.location.href = '<?php echo $this->url ?>';
	}
</script>

<script type="text/javascript" src="<?php echo $this->themePath('js/flux.datefields.js') ?>"></script>
<script type="text/javascript" src="<?php echo $this->themePath('js/flux.unitip.js') ?>"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo $this->themePath('js/drawmove.js') ?>"></script>
</body>

</html>