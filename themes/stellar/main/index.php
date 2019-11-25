<?php if (!defined('FLUX_ROOT')) exit; ?>

						<!-- Introduction -->
							<section id="intro" class="main">
								<div class="spotlight">
									<div class="content">
										<header class="major">
											<h2>Ipsum sed adipiscing</h2>
										</header>
										<p>Edit this file at  <?php echo __FILE__ ?></p>
										<ul class="actions">
											<li><a href="#" class="button">Learn More</a></li>
										</ul>
									</div>
									<span class="image"><img src="<?php echo $this->themePath('images/pic01.jpg')?>" alt="" /></span>
								</div>
							</section>

						<!-- Ranking Section -->
							<section id="ranking" class="main special">
								<header class="major">
									<h2>Ranking</h2>
								</header>
								<ul class="features">
									<li>
										<span class="bcodec" title="Based on FluxCP's Character Ranking"><span class="bcode fa-pvp"><!-- add inline background style for the next span --><span></span></span></span>
										<h3>Top Player</h3>
										<p><strong><?php echo $player_s[0]['char_name'] ?></strong> <br/>
										Level: <?php echo $player_s[0]['base_level'] ?>/
										<?php echo $player_s[0]['job_level'] ?>
										<br/>
										<?php echo $player_s[0]['guild_name'] ?>
										</p>
									</li>
									<li>
										<span class="bcodec"><span class="bcode fa-emp"></span></span>
										<h3>War of Emperium</h3>
										<p>Next castle is <strong><?php echo htmlspecialchars($castleNames[$cas])?></strong><br/> 
										<?php echo ($status) ? "Ending in" : "Starting in"  ?> <span class="woe_time"></span></p>
									</li>
									<li>
										<span class="bcodec" title="Based on number of castles owned."><span class="bcode fa-woe"><span style="background: url('<?php echo $this->emblem($guild_s[0]['guild_id']) ?>') no-repeat center;"></span></span></span>
										<h3>Top Guild</h3>
										<p><strong><?php echo $guild_s[0]['guild_name'] ?></strong> <br/>
										<span title="Guild Leader"><?php echo $guild_s[0]['master'] ?></span></p>
									</li>
								</ul>
								<footer class="major">
									<ul class="actions">
										<li><a href="<?php echo $this->url("ranking","character") ?>" class="button">Go to Rankings Page</a></li>
									</ul>
								</footer>
							</section>

						<!-- Server Information -->
							<section id="server" class="main special">
								<header class="major">
									<h2>Server Information</h2>
									<p>Donec imperdiet consequat consequat. Suspendisse feugiat congue<br />
									posuere. Nulla massa urna, fermentum eget quam aliquet.</p>
								</header>
								<ul class="statistics">
									<li class="style1">
										<strong><?php echo $info['accounts'] ?></strong> Accounts
									</li>
									<li class="style2">
										<strong><?php echo $info['characters'] ?></strong> Characters
									</li>
									<li class="style3">
										<strong><?php echo $info['guilds'] ?></strong> Guilds
									</li>
									<li class="style4">
										<strong><?php echo $info['parties'] ?></strong> Parties
									</li>
									<li class="style5">
										<strong><?php echo $info['zeny'] ?></strong> Zeny
									</li>
								</ul>
								
								<p class="content">Nam elementum nisl et mi a commodo porttitor. Morbi sit amet nisl eu arcu faucibus hendrerit vel a risus. Nam a orci mi, elementum ac arcu sit amet, fermentum pellentesque et purus. Integer maximus varius lorem, sed convallis diam accumsan sed. Etiam porttitor placerat sapien, sed eleifend a enim pulvinar faucibus semper quis ut arcu. Ut non nisl a mollis est efficitur vestibulum. Integer eget purus nec nulla mattis et accumsan ut magna libero. Morbi auctor iaculis porttitor. Sed ut magna ac risus et hendrerit scelerisque. Praesent eleifend lacus in lectus aliquam porta. Cras eu ornare dui curabitur lacinia.</p>
								<footer class="major">
									<ul class="actions">
										<li><a href="#" class="button">Learn More</a></li>
									</ul>
								</footer>
							</section>

						<!-- Get Started -->
							<section id="gs" class="main special">
								<header class="major">
									<h2>Get Started</h2>
									<p>Donec imperdiet consequat consequat. Suspendisse feugiat congue<br />
									posuere. Nulla massa urna, fermentum eget quam aliquet.</p>
								</header>
								<footer class="major">
									<ul class="actions">
										<li><a href="#" class="button special">Download</a></li>
										<?php if(!$session->isLoggedIn()): ?>
										<li><a href="<?php echo $this->url('account','login')?>" class="button">Login</a></li>
										<?php endif ?>
									</ul>
								</footer>
							</section>
