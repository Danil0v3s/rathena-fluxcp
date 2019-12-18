<?php if ($items) : ?>
    <p><?php echo htmlspecialchars(sprintf(Flux::message('AccountViewStorageCount'), $account->userid, count($items))) ?></p>
    <table class="vertical-table">
        <tr>
            <th><?php echo htmlspecialchars(Flux::message('ItemIdLabel')) ?></th>
            <th colspan="2"><?php echo htmlspecialchars(Flux::message('ItemNameLabel')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemAmountLabel')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemIdentifyLabel')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemBrokenLabel')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemCard0Label')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemCard1Label')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemCard2Label')) ?></th>
            <th><?php echo htmlspecialchars(Flux::message('ItemCard3Label')) ?></th>
            <th>Extra</th>
            </th>
        </tr>
        <?php foreach ($items as $item) : ?>
            <?php $icon = $this->iconImage($item->nameid) ?>
            <tr>
                <td align="right">
                    <?php if ($auth->actionAllowed('item', 'view')) : ?>
                        <?php echo $this->linkToItem($item->nameid, $item->nameid) ?>
                    <?php else : ?>
                        <?php echo htmlspecialchars($item->nameid) ?>
                    <?php endif ?>
                </td>
                <?php if ($icon) : ?>
                    <td><img src="<?php echo htmlspecialchars($icon) ?>" /></td>
                <?php endif ?>
                <td<?php if (!$icon) echo ' colspan="2"' ?><?php if ($item->cardsOver) echo ' class="overslotted' . $item->cardsOver . '"';
                                                            else echo ' class="normalslotted"' ?>>
                    <?php if ($item->refine > 0) : ?>
                        +<?php echo htmlspecialchars($item->refine) ?>
                    <?php endif ?>
                    <?php if ($item->card0 == 255 && intval($item->card1 / 1280) > 0) : ?>
                        <?php $itemcard1 = intval($item->card1 / 1280); ?>
                        <?php for ($i = 0; $i < $itemcard1; $i++) : ?>
                            Very
                        <?php endfor ?>
                        Strong
                    <?php endif ?>
                    <?php if ($item->card0 == 254 || $item->card0 == 255) : ?>
                        <?php if ($item->char_name) : ?>
                            <?php if ($auth->actionAllowed('character', 'view') && ($isMine || (!$isMine && $auth->allowedToViewCharacter))) : ?>
                                <?php echo $this->linkToCharacter($item->char_id, $item->char_name, $session->serverName) . "'s" ?>
                            <?php else : ?>
                                <?php echo htmlspecialchars($item->char_name . "'s") ?>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>'s
                        <?php endif ?>
                    <?php endif ?>
                    <?php if ($item->card0 == 255 && array_key_exists($item->card1 % 1280, $itemAttributes)) : ?>
                        <?php echo htmlspecialchars($itemAttributes[$item->card1 % 1280]) ?>
                    <?php endif ?>
                    <?php if ($item->name_japanese) : ?>
                        <span class="item_name"><?php echo htmlspecialchars($item->name_japanese) ?></span>
                    <?php else : ?>
                        <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('UnknownLabel')) ?></span>
                    <?php endif ?>
                    <?php if ($item->slots) : ?>
                        <?php echo htmlspecialchars(' [' . $item->slots . ']') ?>
                    <?php endif ?>
                    </td>
                    <td><?php echo number_format($item->amount) ?></td>
                    <td>
                        <?php if ($item->identify) : ?>
                            <span class="identified yes"><?php echo htmlspecialchars(Flux::message('YesLabel')) ?></span>
                        <?php else : ?>
                            <span class="identified no"><?php echo htmlspecialchars(Flux::message('NoLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->attribute) : ?>
                            <span class="broken yes"><?php echo htmlspecialchars(Flux::message('YesLabel')) ?></span>
                        <?php else : ?>
                            <span class="broken no"><?php echo htmlspecialchars(Flux::message('NoLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->card0 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256) : ?>
                            <?php if (!empty($cards[$item->card0])) : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card0, $cards[$item->card0]) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($cards[$item->card0]) ?>
                                <?php endif ?>
                            <?php else : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card0, $item->card0) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($item->card0) ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->card1 && ($item->type == 4 || $item->type == 5) && $item->card0 != 255 && $item->card0 != -256) : ?>
                            <?php if (!empty($cards[$item->card1])) : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card1, $cards[$item->card1]) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($cards[$item->card1]) ?>
                                <?php endif ?>
                            <?php else : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card1, $item->card1) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($item->card1) ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->card2 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256) : ?>
                            <?php if (!empty($cards[$item->card2])) : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card2, $cards[$item->card2]) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($cards[$item->card2]) ?>
                                <?php endif ?>
                            <?php else : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card2, $item->card2) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($item->card2) ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->card3 && ($item->type == 4 || $item->type == 5) && $item->card0 != 254 && $item->card0 != 255 && $item->card0 != -256) : ?>
                            <?php if (!empty($cards[$item->card3])) : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card3, $cards[$item->card3]) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($cards[$item->card3]) ?>
                                <?php endif ?>
                            <?php else : ?>
                                <?php if ($auth->actionAllowed('item', 'view')) : ?>
                                    <?php echo $this->linkToItem($item->card3, $item->card3) ?>
                                <?php else : ?>
                                    <?php echo htmlspecialchars($item->card3) ?>
                                <?php endif ?>
                            <?php endif ?>
                        <?php else : ?>
                            <span class="not-applicable"><?php echo htmlspecialchars(Flux::message('NoneLabel')) ?></span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($item->bound == 1) : ?>
                            Account Bound
                        <?php elseif ($item->bound == 2) : ?>
                            Guild Bound
                        <?php elseif ($item->bound == 3) : ?>
                            Party Bound
                        <?php elseif ($item->bound == 4) : ?>
                            Character Bound
                        <?php else : ?>
                            <span class="not-applicable">None</span>
                        <?php endif ?>
                    </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else : ?>
    <p><?php echo htmlspecialchars(Flux::message('AccountViewNoStorage')) ?></p>
<?php endif ?>