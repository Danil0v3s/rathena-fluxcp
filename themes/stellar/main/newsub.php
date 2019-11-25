<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php $menus = array() ?>
<?php if (!empty($pageMenuItems)): ?>
	<?php foreach ($pageMenuItems as $menuItemName => $menuItemLink): ?>
	
		<?php $menus[] = sprintf('<a href="%s" class="page-menu-item">%s</a>', $menuItemLink, htmlspecialchars($menuItemName)) ?>
	<?php endforeach ?>
<?php endif ?>
<?php $subMenuItems = $this->getSubMenuItems();?>
<?php if (!empty($subMenuItems)): ?>
	<?php foreach ($subMenuItems as $menuItem): ?>
		<?php $menus[] = sprintf('<a href="%s" class="sub-menu-item%s">%s</a>',
			$this->url($menuItem['module'], $menuItem['action']),
			$params->get('module') == $menuItem['module'] && $params->get('action') == $menuItem['action'] ? ' current-sub-menu' : '',
			htmlspecialchars($menuItem['name'])) ?>
	<?php endforeach ?>
	<?php if (!empty($menus)):?>
						<div id="submenu" class="small_navi">
	<?php echo implode('&nbsp;&nbsp;•&nbsp;&nbsp;', $menus) ?>
						</div>
<?php endif ?>
<?php endif ?>