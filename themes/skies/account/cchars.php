<?php foreach ($characters as $serverName => $chars) : $zeny = 0; ?>
    <?php if ($chars) : ?>
        <table class="vertical-table">
            <tr>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewSlotLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewCharLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewClassLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewLvlLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewJlvlLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewZenyLabel')) ?></th>
                <th colspan="2"><?php echo htmlspecialchars(Flux::message('AccountViewGuildLabel')) ?></th>
                <th><?php echo htmlspecialchars(Flux::message('AccountViewStatusLabel')) ?></th>
                <?php if (($isMine || $auth->allowedToModifyCharPrefs) && $auth->actionAllowed('character', 'prefs')) : ?>
                    <th><?php echo htmlspecialchars(Flux::message('AccountViewPrefsLabel')) ?></th>
                <?php endif ?>
            </tr>
            <?php foreach ($chars as $char) : $zeny += $char->zeny; ?>
                <tr>
                    <td align="right"><?php echo $char->char_num + 1 ?></td>
                    <td>
                        <?php if ($auth->actionAllowed('character', 'view') && ($isMine || (!$isMine && $auth->allowedToViewCharacter))) : ?>
                            <?php echo $this->linkToCharacter($char->char_id, $char->name, $serverName) ?>
                        <?php else : ?>
                            <?php echo htmlspecialchars($char->name) ?>
                        <?php endif ?>
                    </td>
                    <td><?php echo htmlspecialchars($this->jobClassText($char->class)) ?></td>
                    <td><?php echo (int) $char->base_level ?></td>
                    <td><?php echo (int) $char->job_level ?></td>
                    <td><?php echo number_format((int) $char->zeny) ?></td>
                    <?php if ($char->guild_name) : ?>
                        <?php if ($char->guild_emblem_len) : ?>
                            <td><img src="<?php echo $this->emblem($char->guild_id) ?>" /></td>
                        <?php endif ?>
                        <td<?php if (!$char->guild_emblem_len) echo ' colspan="2"' ?>>
                            <?php if ($auth->actionAllowed('guild', 'view')) : ?>
                                <?php echo $this->linkToGuild($char->guild_id, $char->guild_name) ?>
                            <?php else : ?>
                                <?php echo htmlspecialchars($char->guild_name) ?>
                            <?php endif ?>
                            </td>
                        <?php else : ?>
                            <td colspan="2" align="center"><span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span></td>
                        <?php endif ?>
                        <td>
                            <?php if ($char->online) : ?>
                                <span class="online"><?php echo htmlspecialchars(Flux::message('OnlineLabel')) ?></span>
                            <?php else : ?>
                                <span class="offline"><?php echo htmlspecialchars(Flux::message('OfflineLabel')) ?></span>
                            <?php endif ?>
                        </td>
                        <?php if (($isMine || $auth->allowedToModifyCharPrefs) && $auth->actionAllowed('character', 'prefs')) : ?>
                            <td>
                                <a href="<?php echo $this->url('character', 'prefs', array('id' => $char->char_id)) ?>" class="block-link">
                                    <?php echo htmlspecialchars(Flux::message('CharModifyPrefsLink')) ?>
                                </a>
                            </td>
                        <?php endif ?>
                </tr>
            <?php endforeach ?>
        </table>
        <p>Total Zeny: <strong><?php echo number_format($zeny) ?></strong></p>
    <?php else : ?>
        <p><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewNoChars'), $serverName)) ?></p>
    <?php endif ?>
<?php endforeach ?>