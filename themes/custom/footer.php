<?php if (!defined('FLUX_ROOT')) exit; ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					</div>
					</div>
					<div class="sidebarright">
						<div class="controlpanel"><?php include('main/loginpanel.php') ?></div>
						<div class="quicklinks2">
							<a href="<?php echo $this->url('account','create'); ?>"><img src="<?php echo $this->themePath('img/register_btn.png'); ?>" onmouseover='this.src="<?php echo $this->themePath('img/register_btn_hover.png'); ?>"' onmouseout='this.src="<?php echo $this->themePath('img/register_btn.png'); ?>"' /></a>
						</div>
						<div class="halloffame"><?php include('main/halloffame.php') ?></div>
					</div>
					</div>
				<div class="containerbgbottom"></div>
				<div class="clear"></div>
				<div class="footer">
					<div class="footerspacer"></div>
					<div class="footercreditsdiv">
						<div class="credits">
							<img style="margin-top: 30px;" src="<?php echo $this->themePath('img/designer.png') ?>" />
							<a href="mail:rahul_dev345@yahoo.com"><img width="90" src="<?php echo $this->themePath('img/rahul.png') ?>" title="Codedby: Rahul Dev<br/>http://ea-dev.com/"/></a>
							<div class="clear"></div>
						</div>
						<div class="copyright">
							COPYRIGHT 2012 <b>ELVAANRO</b> ALL RIGHTS RESERVERED<br/>
							ALL OTHER COPYRIGHTS AND TRADEMARKS ARE PROPERTY OF GRAVITY, AND THEIR RESPECTIVE OWNERS. 
						</div>
						<div class="footerlogo">
							<img src="<?php echo $this->themePath('img/footer_logo.png') ?>" />
						</div>
						<div class="clear"></div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>
