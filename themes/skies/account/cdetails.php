<table class="vertical-table">
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('UsernameLabel')) ?></th>
        <td><?php echo htmlspecialchars($account->userid) ?></td>
        <th><?php echo htmlspecialchars(Flux::message('AccountIdLabel')) ?></th>
        <td>
            <?php if ($auth->allowedToSeeAccountID) : ?>
                <?php echo $account->account_id ?>
            <?php else : ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NotApplicableLabel')) ?></span>
            <?php endif ?>
        </td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('EmailAddressLabel')) ?></th>
        <td>
            <?php if ($account->email) : ?>
                <?php if ($auth->actionAllowed('account', 'index')) : ?>
                    <?php echo $this->linkToAccountSearch(array('email' => $account->email), $account->email) ?>
                <?php else : ?>
                    <?php echo htmlspecialchars($account->email) ?>
                <?php endif ?>
            <?php else : ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
            <?php endif ?>
        </td>
        <th><?php echo htmlspecialchars(Flux::message('AccountGroupIDLabel')) ?></th>
        <td><?php echo (int) $account->group_id ?></td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('GenderLabel')) ?></th>
        <td>
            <?php if ($gender = $this->genderText($account->sex)) : ?>
                <?php echo $gender ?>
            <?php else : ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>
            <?php endif ?>
        </td>
        <th><?php echo htmlspecialchars(Flux::message('AccountStateLabel')) ?></th>
        <td>
            <?php if (!$account->confirmed && $account->confirm_code) : ?>
                <span class="account-state state-pending">
                    <?php echo htmlspecialchars(Flux::message('AccountStatePending')) ?>
                </span>
            <?php elseif (($state = $this->accountStateText($account->state)) && !$account->unban_time) : ?>
                <?php echo $state ?>
            <?php elseif ($account->unban_time) : ?>
                <span class="account-state state-banned">
                    <?php printf(htmlspecialchars(Flux::message('AccountStateTempBanned')), date(Flux::config('DateTimeFormat'), $account->unban_time)) ?>
                </span>
            <?php else : ?>
                <span class="account-state state-unknown"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>
            <?php endif ?>
        </td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('LoginCountLabel')) ?></th>
        <td><?php echo number_format((int) $account->logincount) ?></td>
        <th><?php echo htmlspecialchars(Flux::message('CreditBalanceLabel')) ?></th>
        <td>
            <?php echo number_format((int) $account->balance) ?>
            <?php if ($auth->allowedToDonate && $isMine) : ?>
                <a href="<?php echo $this->url('donate') ?>"><?php echo htmlspecialchars(Flux::message('AccountViewDonateLink')) ?></a>
            <?php endif ?>
        </td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('AccountBirthdateLabel')) ?></th>
        <td><?php echo $account->birthdate ?></td>
        <th><?php echo htmlspecialchars(Flux::message('VIPStateLabel')) ?></th>
        <td>
            <?php echo $vipexpires ?>
        </td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('LastLoginDateLabel')) ?></th>
        <td colspan="3">
            <?php if (!$account->lastlogin || $account->lastlogin <= '1000-01-01 00:00:00') : ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NeverLabel')) ?></span>
            <?php else : ?>
                <?php echo $this->formatDateTime($account->lastlogin) ?>
            <?php endif ?>
        </td>
    </tr>
    <tr>
        <th><?php echo htmlspecialchars(Flux::message('LastUsedIpLabel')) ?></th>
        <td colspan="3">
            <?php if ($account->last_ip) : ?>
                <?php if ($auth->actionAllowed('account', 'index')) : ?>
                    <?php echo $this->linkToAccountSearch(array('last_ip' => $account->last_ip), $account->last_ip) ?>
                <?php else : ?>
                    <?php echo htmlspecialchars($account->last_ip) ?>
                <?php endif ?>
            <?php else : ?>
                <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
            <?php endif ?>
        </td>
    </tr>
    <?php $banconfirm = htmlspecialchars(str_replace("'", "\\'", Flux::message('AccountBanConfirm'))) ?>
    <?php if ($showTempBan) : ?>
        <tr>
            <th><?php echo htmlspecialchars(Flux::message('AccountViewTempBanLabel')) ?></th>
            <td colspan="3">
                <form action="<?php echo $this->urlWithQs ?>" method="post">
                    <input type="hidden" name="tempban" value="1" />
                    <label><?php echo htmlspecialchars(Flux::message('AccountBanReasonLabel')) ?><br /><textarea name="reason" class="block reason"></textarea></label>
                    <label><?php echo htmlspecialchars(Flux::message('AccountBanUntilLabel')) ?></label>
                    <?php echo $this->dateTimeField('tempban', date('H:i:s')); ?>
                    <input type="submit" value="<?php echo htmlspecialchars(Flux::message('AccountTempBanButton')) ?>" onclick="return confirm('<?php echo $banconfirm ?>')" />
                </form>
            </td>
        </tr>
    <?php endif ?>
    <?php if ($showPermBan) : ?>
        <tr>
            <th><?php echo htmlspecialchars(Flux::message('AccountViewPermBanLabel')) ?></th>
            <td colspan="3">
                <form action="<?php echo $this->urlWithQs ?>" method="post">
                    <input type="hidden" name="permban" value="1" />
                    <label><?php echo htmlspecialchars(Flux::message('AccountBanReasonLabel')) ?><br /><textarea name="reason" class="block reason"></textarea></label>
                    <input type="submit" value="<?php echo htmlspecialchars(Flux::message('AccountPermBanButton')) ?>" onclick="return confirm('<?php echo $banconfirm ?>')" />
                </form>
            </td>
        </tr>
    <?php endif ?>
    <?php if ($showUnban) : ?>
        <tr>
            <th><?php echo htmlspecialchars(Flux::message('AccountViewUnbanLabel')) ?></th>
            <td colspan="3">
                <form action="<?php echo $this->urlWithQs ?>" method="post">
                    <input type="hidden" name="unban" value="1" />
                    <?php if ($tempBanned && $auth->allowedToTempUnbanAccount) : ?>
                        <label><?php echo htmlspecialchars(Flux::message('AccountBanReasonLabel')) ?><br /><textarea name="reason" class="block reason"></textarea></label>
                        <input type="submit" value="<?php echo htmlspecialchars(Flux::message('AccountTempUnbanButton')) ?>" />
                    <?php elseif ($permBanned && $auth->allowedToPermUnbanAccount) : ?>
                        <label><?php echo htmlspecialchars(Flux::message('AccountBanReasonLabel')) ?><br /><textarea name="reason" class="block reason"></textarea></label>
                        <input type="submit" value="<?php echo htmlspecialchars(Flux::message('AccountPermUnbanButton')) ?>" />
                    <?php endif ?>
                </form>
            </td>
        </tr>
    <?php endif ?>
</table>