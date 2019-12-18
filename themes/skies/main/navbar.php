<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php
$menuIcons = array(
	// Generic/Misc.
	'MainMenuLabel'	=> 'ic-main',
	'AccountLabel'	=> 'ic-account',
	'InformationLabel'	=> 'ic-info',
	'DatabaseLabel'	=> 'ic-db',
	'NewsLabel' => 'ic-news',
	'DownloadsLabel' => 'ic-downloads'
)
?>
<nav class="navbar navbar-default center" role="navigation">
	<div class="navbar-inner">
		<ul class="nav navbar-nav">
			<?php $menuItems = $this->getMenuItems(); ?>
			<?php if (!empty($menuItems)) : ?>
				<?php foreach ($menuItems as $menuCategory => $menus) : ?>
					<?php if (!empty($menus)) : ?>
						<?php if ($menuCategory == 'AccountLabel' && !$session->isLoggedIn()) : ?>

						<?php else : ?>
							<?php if (count($menus) == 1) : ?>
								<li class="dropdown ro-dropdown">
									<a href="<?php echo $menus[0]['url'] ?>" class="dropdown-toggle">
										<div class="ro-icon <?php echo $menuIcons[$menuCategory] ?>"></div>
										<span class="menu-item"><?php echo htmlspecialchars(Flux::message($menuCategory)) ?></span>
									</a>
								</li>
							<?php else : ?>
								<li class="dropdown ro-dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<div class="ro-icon <?php echo $menuIcons[$menuCategory] ?>"></div>
										<span class="menu-item"><?php echo htmlspecialchars(Flux::message($menuCategory)) ?></span>
									</a>
									<ul class="dropdown-menu ro-dropdown">
										<?php foreach ($menus as $menuItem) :  ?>
											<li class="ro-dropdown-li">
												<a href="<?php echo $menuItem['url'] ?>"><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></a>
											</li>
										<?php endforeach ?>
									</ul>
								</li>
							<?php endif ?>
						<?php endif ?>
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>


			<?php $adminMenuItems = $this->getAdminMenuItems(); ?>
			<?php if (!empty($adminMenuItems) && Flux::config('AdminMenuNewStyle')) : ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<div class="ro-icon ic-admin"></div>
						<span class="menu-item">Admin Menu</span>
					</a>
					<ul class="dropdown-menu">
						<?php foreach ($adminMenuItems as $menuItem) : ?>
							<li>
								<a href="<?php echo $this->url($menuItem['module'], $menuItem['action']) ?>"><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></a>
							</li>
						<?php endforeach ?>
					</ul>
				</li>
			<?php endif ?>
		</ul>
	</div>
</nav>