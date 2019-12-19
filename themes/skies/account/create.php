<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('AccountCreateHeading')) ?></h2>
<p><?php printf(htmlspecialchars(Flux::message('AccountCreateInfo')), '<a href="' . $this->url('service', 'tos') . '">' . Flux::message('AccountCreateTerms') . '</a>') ?></p>
<?php if (Flux::config('RequireEmailConfirm')) : ?>
	<p><strong>Note:</strong> You will need to provide a working e-mail address to confirm your account before you can log-in.</p>
<?php endif ?>
<p><strong>Note:</strong> <?php echo sprintf("Your password must be between %d and %d characters.", Flux::config('MinPasswordLength'), Flux::config('MaxPasswordLength')) ?></p>
<?php if (Flux::config('PasswordMinUpper') > 0) : ?>
	<p><strong>Note:</strong> <?php echo sprintf(Flux::message('PasswordNeedUpper'), Flux::config('PasswordMinUpper')) ?></p>
<?php endif ?>
<?php if (Flux::config('PasswordMinLower') > 0) : ?>
	<p><strong>Note:</strong> <?php echo sprintf(Flux::message('PasswordNeedLower'), Flux::config('PasswordMinLower')) ?></p>
<?php endif ?>
<?php if (Flux::config('PasswordMinNumber') > 0) : ?>
	<p><strong>Note:</strong> <?php echo sprintf(Flux::message('PasswordNeedNumber'), Flux::config('PasswordMinNumber')) ?></p>
<?php endif ?>
<?php if (Flux::config('PasswordMinSymbol') > 0) : ?>
	<p><strong>Note:</strong> <?php echo sprintf(Flux::message('PasswordNeedSymbol'), Flux::config('PasswordMinSymbol')) ?></p>
<?php endif ?>
<?php if (!Flux::config('AllowUserInPassword')) : ?>
	<p><strong>Note:</strong> <?php echo Flux::message('PasswordContainsUser') ?></p>
<?php endif ?>
<?php if (isset($errorMessage)) : ?>
	<p class="red" style="font-weight: bold"><?php echo htmlspecialchars($errorMessage) ?></p>
<?php endif ?>
<form action="<?php echo $this->url ?>" method="post" class="form-horizontal" style="margin-top: 20px">
	<?php if (count($serverNames) === 1) : ?>
		<input type="hidden" name="server" value="<?php echo htmlspecialchars($session->loginAthenaGroup->serverName) ?>">
	<?php endif ?>

	<div class="form-group">
		<label for="register_username" class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountUsernameLabel')) ?></label>
		<div class="col-sm-3">
			<input type="text" name="username" class="form-control" id="register_username" value="<?php echo htmlspecialchars($params->get('username')) ?>" />
		</div>
	</div>

	<div class="form-group">
		<label for="register_password" class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountPasswordLabel')) ?></label>
		<div class="col-sm-3">
			<input type="password" name="password" id="register_password" class="form-control" />
		</div>
	</div>

	<div class="form-group">
		<label for="register_confirm_password" class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountPassConfirmLabel')) ?></label>
		<div class="col-sm-3">
			<input type="password" name="confirm_password" id="register_confirm_password" class="form-control" />
		</div>
	</div>

	<div class="form-group">
		<label for="register_email_address" class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountEmailLabel')) ?></label>
		<div class="col-sm-3">
			<input type="email" name="email_address" id="register_email_address" value="<?php echo htmlspecialchars($params->get('email_address')) ?>" class="form-control" />
		</div>
	</div>

	<div class="form-group hidden">
		<label for="register_email_address" class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountEmailLabel2')) ?></label>
		<div class="col-sm-3">
			<input type="text" name="email_address2" id="register_email_address2" value="<?php echo htmlspecialchars($params->get('email_address')) ?>" class="form-control" />
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountGenderLabel')) ?></label>
		<div class="col-sm-3">
			<label class="checkbox-inline"><input type="radio" name="gender" id="register_gender_m" value="M" <?php if ($params->get('gender') === 'M') echo ' checked="checked"' ?> /> <?php echo $this->genderText('M') ?></label>
			<label class="checkbox-inline"><input type="radio" name="gender" id="register_gender_f" value="F" <?php if ($params->get('gender') === 'F') echo ' checked="checked"' ?> /> <?php echo $this->genderText('F') ?></label>
			<strong title="<?php echo htmlspecialchars(Flux::message('AccountCreateGenderInfo')) ?>">?</strong>
		</div>
	</div>

	<div class="form-group hidden">
		<label class="col-sm-2 control-label"><?php echo htmlspecialchars(Flux::message('AccountBirthdateLabel')) ?></label>
		<div class="col-sm-3">
			<?php echo $this->dateField('birthdate', null, 0) ?>
		</div>
	</div>

	<div style="margin-bottom: 15px">
		<?php printf(htmlspecialchars(Flux::message('AccountCreateInfo2')), '<a href="' . $this->url('service', 'tos') . '">' . Flux::message('AccountCreateTerms') . '</a>') ?>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default"><?php echo htmlspecialchars(Flux::message('AccountCreateButton')) ?></button>
		</div>
	</div>


</form>