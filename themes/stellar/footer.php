<?php if (!defined('FLUX_ROOT')) exit; ?>
				<?php if (!in_array($params->get('module'), array('main'))):?>
					</div>
				<?php endif ?>
					</div>
<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>Aliquam sed mauris</h2>
							<p>Sed lorem ipsum dolor sit amet et nullam consequat feugiat consequat magna adipiscing tempus etiam dolore veroeros. eget dapibus mauris. Cras aliquet, nisl ut viverra sollicitudin, ligula erat egestas velit, vitae tincidunt odio.</p>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn More</a></li>
							</ul>
						</section>
						<section>
							<h2>Etiam feugiat</h2>
							<dl class="alt">
								<dt>Address</dt>
								<dd>1234 Somewhere Road &bull; Nashville, TN 00000 &bull; USA</dd>
								<dt>Phone</dt>
								<dd>(000) 000-0000 x 0000</dd>
								<dt>Email</dt>
								<dd><a href="#">information@untitled.tld</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="#" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>
						</section>
						<p class="copyright">&copy; <?php echo Flux::config('SiteTitle') ?> | Design: <a href="https://html5up.net">HTML5 UP</a> | Integerated by <a href="https://www.facebook.com/HyvraineDesigns/"> Hyvraine Designs </a> <br/>
			All other trademarks are property of Gravity & Lee Myoungjin (Studio DTDS) and their respective owners.</p>
			<?php if ($params->get('hyvrainedebug')=="showrenderdebug"): ?>
		<div id="bottom-bar">
			<div class="footer-text">
				Page generated in <strong><?php echo round(microtime(true) - __START__, 5) ?></strong> second(s).
				Number of queries executed: <strong><?php echo (int)Flux::$numberOfQueries ?></strong>.
				<?php if (Flux::config('GzipCompressOutput')): ?>Gzip Compression: <strong>Enabled</strong>.<?php endif ?>
			</div>
			<div class="site-info">
			Powered by <a href="http://github.com/HerculesWS/FluxCP/">FluxCP</a> and <a href="http://github.com/HerculesWS/Hercules/">Hercules</a>. 
			<?php if (count(Flux::$appConfig->get('ThemeName', false)) > 1): ?>
			<span>Theme:
			<select name="preferred_theme" onchange="updatePreferredTheme(this)">
				<?php foreach (Flux::$appConfig->get('ThemeName', false) as $themeName): ?>
				<option value="<?php echo htmlspecialchars($themeName) ?>"<?php if ($session->theme == $themeName) echo ' selected="selected"' ?>><?php echo htmlspecialchars($themeName) ?></option>
				<?php endforeach ?>
			</select>
			</span>
			<?php endif ?>
			<form action="<?php echo $this->urlWithQs ?>" method="post" name="preferred_theme_form" style="display: none">
				<input type="hidden" name="preferred_theme" value="" />
			</form>
			</div>
		</div>
		<?php endif ?>
					</footer>

		
	</div>
</body>
</html>
