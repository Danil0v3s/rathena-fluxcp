<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2><?php echo htmlspecialchars(Flux::message('CMSNewsHeader')) ?></h2>
<?php if ($news) : ?>
	<div class="newsDiv">
		<?php foreach ($news as $nrow) : ?>
			<div class="newsCont">
				<div class="news-title">
					<h3><?php echo $nrow->title ?></h3>
					<span class="newsDate"><small>by <?php echo $nrow->author ?> on <?php echo date(Flux::config('DateFormat'), strtotime($nrow->created)) ?></small></span>
				</div>

				<p><?php echo $nrow->body ?></p>
				<?php if ($nrow->created != $nrow->modified && Flux::config('CMSDisplayModifiedBy')) : ?>
					<small><?php echo htmlspecialchars(Flux::message('CMSModifiedLabel')) ?> : <?php echo date(Flux::config('DateFormat'), strtotime($nrow->modified)) ?></small>
				<?php endif; ?>
				<?php if ($nrow->link) : ?>
					<a class="news_link" href="<?php echo $nrow->link ?>"><small><?php echo htmlspecialchars(Flux::message('CMSNewsLink')) ?></small></a>
					<div class="clear"></div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<p>
		<?php echo htmlspecialchars(Flux::message('CMSNewsEmpty')) ?><br /><br />
	</p>
<?php endif ?>