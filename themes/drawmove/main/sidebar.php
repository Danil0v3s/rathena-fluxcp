<?php
if (!defined('FLUX_ROOT')) exit;
$adminMenuItems = $this->getAdminMenuItems();
$menuItems = $this->getMenuItems();
?>

<?php if (!empty($adminMenuItems) && !Flux::config('AdminMenuNewStyle')): ?>
<table id="admin_sidebar">
	<tr>
		<th class="menuitem"><strong>Admin Menu</strong></td>
	</tr>
	<?php foreach ($adminMenuItems as $menuItem): ?>
	<tr>
		<td class="menuitem">
			<a href="<?php echo $this->url($menuItem['module'], $menuItem['action']) ?>"<?php
				if ($menuItem['module'] == 'account' && $menuItem['action'] == 'logout')
					echo ' onclick="return confirm(\'Are you sure you want to logout?\')"' ?>>
				<span><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></span>
			</a>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php endif ?>

<?php if (!empty($menuItems)): ?>
<table id="user_sidebar">
	<?php foreach ($menuItems as $menuCategory => $menus): ?>
	<?php if (!empty($menus)): ?>
	<tr>
		<th class="menuitem"><strong><?php echo htmlspecialchars(Flux::message($menuCategory)) ?></strong></th>
	</tr>
	<?php foreach ($menus as $menuItem):  ?>
	<tr>
		<td class="menuitem">
			<a href="<?php echo $menuItem['url'] ?>"<?php
				if ($menuItem['module'] == 'account' && $menuItem['action'] == 'logout')
					echo ' onclick="return confirm(\'Are you sure you want to logout?\')"' ?>>
				<span><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></span>
			</a>
		</td>
	</tr>
	<?php endforeach ?>
	<?php endif ?>
	<?php endforeach ?>
</table>
<?php endif ?>