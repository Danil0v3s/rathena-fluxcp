<?php if (!defined('FLUX_ROOT')) exit; ?>

<?php if (!defined('FLUX_ROOT')) exit; ?>

<nav class="navbar navbar-default center" role="navigation">
	<div class="navbar-inner">
		<ul class="nav navbar-nav">
			<?php $menuItems = $this->getMenuItems(); ?>
			<?php if (!empty($menuItems)) : ?>
				<?php foreach ($menuItems as $menuCategory => $menus) : ?>
					<?php if (!empty($menus)) : ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlspecialchars(Flux::message($menuCategory)) ?> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php foreach ($menus as $menuItem) :  ?>
									<li>
										<a href="<?php echo $menuItem['url'] ?>"><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></a>
									</li>
								<?php endforeach ?>
							</ul>
						</li>
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>


			<?php $adminMenuItems = $this->getAdminMenuItems(); ?>
			<?php if (!empty($adminMenuItems) && Flux::config('AdminMenuNewStyle')) : ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin Menu <b class="caret"></b></a>
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