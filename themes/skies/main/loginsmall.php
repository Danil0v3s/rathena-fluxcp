<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php $serverNames = $this->getServerNames(); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><img src="<?php echo $this->themePath('img/account.gif') ?>">&nbsp;&nbsp;Entrar</h3>
	</div>
	<div class="panel-body container-fluid">
		<form action="<?php echo $this->url('account', 'login', array('return_url' => $params->get('return_url'))) ?>" method="post">
			<?php if (count($serverNames) === 1) : ?>
				<input class="form-control" type="hidden" name="server" value="<?php echo htmlspecialchars($session->loginAthenaGroup->serverName) ?>">
			<?php endif ?>
			<div class="form-group input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"><img src="<?php echo $this->themePath('img/rune-a.gif') ?>" height="100%"></span>
				<input class="form-control" placeholder="<?php echo htmlspecialchars(Flux::message('AccountUsernameLabel')) ?>" type="text" name="username" id="login_username" value="<?php echo htmlspecialchars($params->get('username')) ?>" />
			</div>
			<div class="form-group input-group input-group-sm">
				<span class="input-group-addon" id="sizing-addon3"><img src="<?php echo $this->themePath('img/rune-b.gif') ?>" height="100%"></span>
				<input class="form-control" placeholder="<?php echo htmlspecialchars(Flux::message('AccountPasswordLabel')) ?>" type="password" name="password" id="login_password" />
			</div>
			<?php if ($auth->actionAllowed('account', 'create')) : ?>
				<p><?php printf(Flux::message('LoginPageMakeAccount'), $this->url('account', 'create')); ?></p>
			<?php endif ?>
			<div class="form-group input-group-sm">
				<input class="btn btn-primary mb-2 pull-left" type="submit" value="<?php echo htmlspecialchars(Flux::message('LoginButton')) ?>" />
				<img src="<?php echo $this->themePath('img/kafra.gif') ?>" class="pull-right" />
			</div>
		</form>

	</div>
</div>

<script type="text/javascript">
	jQuery.fn.placeholder();
</script>