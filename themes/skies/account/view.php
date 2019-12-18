<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('AccountViewHeading')) ?></h2>
<?php if (!empty($errorMessage)) : ?>
	<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<?php if ($account) : ?>
	<?php if (Flux::config('PincodeEnabled') && $session->account->pincode == NULL) : ?>
		<p class="red">There is no pincode set! Please login via the game client now to secure your account.</p>
	<?php endif ?>
	<!-- Dados da Conta -->

	<!-- Nav tabs -->
	<ul class="nav nav-pills" role="tablist">
		<li role="presentation" class="active"><a href="#details" aria-controls="details" role="tab" data-toggle="tab"><?php echo htmlspecialchars(Flux::message('AccountViewDetails')) ?></a></li>
		<li role="presentation"><a href="#chars" aria-controls="chars" role="tab" data-toggle="tab"><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewCharSubHead'), $serverName)) ?></a></li>
		<li role="presentation"><a href="#storage" aria-controls="storage" role="tab" data-toggle="tab"><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewStorage'), $account->userid)) ?></a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content" style="padding-top: 16px">
		<div role="tabpanel" class="tab-pane active" id="details">
			<?php include $this->themePath('account/cdetails.php', true) ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="chars">
			<?php include $this->themePath('account/cchars.php', true) ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="storage">
			<?php include $this->themePath('account/cstorage.php', true) ?>
		</div>
	</div>

<?php else : ?>
	<p>
		<?php echo htmlspecialchars(Flux::message('AccountViewNotFound')) ?>
		<a href="javascript:history.go(-1)"><?php echo htmlspecialchars(Flux::message('GoBackLabel')) ?></a>
	</p>
<?php endif ?>