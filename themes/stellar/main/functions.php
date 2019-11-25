<?php

/* !!!!!!!!!!! WARNING !!!!!!!!!!!!!!! */
/*  This file is for developers only.  */
/* !!!!!!!!!!! WARNING !!!!!!!!!!!!!!! */
foreach($g as $g1) {
	$stellar_settings['siteNavi'] = array_merge($stellar_settings['siteNavi'],$g1);
}
	
include $this->themePath("main/castle_data.php", true);


$scroll_check = 0;

$adminMenuItems = $this->getAdminMenuItems();
$menuItems = $this->getMenuItems();

$serverNames = $this->getServerNames();
foreach (Flux::$loginAthenaGroupRegistry as $groupName => $loginAthenaGroup) {
	$server = $loginAthenaGroup->athenaServers[0];
}

$item_s = FLUX_DATA_DIR.'/tmp/Item_'.$serverNames[0].'.php';
$guild_s = FLUX_DATA_DIR.'/tmp/TGuilds_'.$serverNames[0].'.php';
$guild_g = FLUX_DATA_DIR.'/tmp/Guilds_'.$serverNames[0].'.php';
$player_s = FLUX_DATA_DIR.'/tmp/Players_'.$serverNames[0].'.php';
$tg = FLUX_DATA_DIR.'/tmp/tg'.$serverNames[0].'.php';
$cache = FLUX_DATA_DIR.'/tmp/ServerStatus.cache';

function serialize_cache ($filecache, $array = array()) {
	$fp = fopen($filecache, 'w');
	if (is_resource($fp)) {
		fwrite($fp, '<?php exit("Forbidden."); ?>');
		fwrite($fp, serialize($array));
		fclose($fp);
	}
	return unserialize(file_get_contents($filecache, null, null, 28));
}

function time_check ($time, $filecache) {
	return (time() - strtotime($time,filemtime($filecache)) < 0 ? true : false);
}

			if (in_array($params->get('module'), array('main'))) {
		$info  = array(
				'accounts'   => 0,
				'characters' => 0,
				'guilds'     => 0,
				'parties'    => 0,
				'zeny'       => 0,
		);

		// Accounts.
		$sql = "SELECT COUNT(account_id) AS total FROM {$server->loginDatabase}.login ";
		if (Flux::config('HideTempBannedStats')) {
			$sql .= "WHERE unban_time <= UNIX_TIMESTAMP()";
		}
		if (Flux::config('HidePermBannedStats')) {
			if (Flux::config('HideTempBannedStats')) {
				$sql .= " AND state != 5";
			} else {
				$sql .= "WHERE state != 5";
			}
		}
		$sth = $server->connection->getStatement($sql);
		$sth->execute();
		$info['accounts'] += $sth->fetch()->total;

		// Characters.
		$sql = "SELECT COUNT(`char`.char_id) AS total FROM {$server->charMapDatabase}.`char` ";
		if (Flux::config('HideTempBannedStats')) {
			$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
			$sql .= "WHERE login.unban_time <= UNIX_TIMESTAMP()";
		}
		if (Flux::config('HidePermBannedStats')) {
			if (Flux::config('HideTempBannedStats')) {
				$sql .= " AND login.state != 5";
			} else {
				$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
				$sql .= "WHERE login.state != 5";
			}
		}
		$sth = $server->connection->getStatement($sql);
		$sth->execute();
		$info['characters'] += $sth->fetch()->total;

		// Guilds.
		$sql = "SELECT COUNT(guild_id) AS total FROM {$server->charMapDatabase}.guild";
		$sth = $server->connection->getStatement($sql);
		$sth->execute();
		$info['guilds'] += $sth->fetch()->total;

		// Parties.
		$sql = "SELECT COUNT(party_id) AS total FROM {$server->charMapDatabase}.party";
		$sth = $server->connection->getStatement($sql);
		$sth->execute();
		$info['parties'] += $sth->fetch()->total;

		// Zeny.
		$bind = array();
		$sql  = "SELECT SUM(`char`.zeny) AS total FROM {$server->charMapDatabase}.`char` ";
		if ($hideGroupLevel=Flux::config('InfoHideZenyGroupLevel')) {
			$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
			
			$groups = AccountLevel::getGroupID($hideGroupLevel, '<');
			if(!empty($groups)) {
				$ids   = implode(', ', array_fill(0, count($groups), '?'));
				$sql  .= "WHERE login.group_id IN ($ids) ";
				$bind  = array_merge($bind, $groups);
			}
		}
		if (Flux::config('HideTempBannedStats')) {
			if ($hideGroupLevel) {
				$sql .= " AND unban_time <= UNIX_TIMESTAMP()";
			} else {
				$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
				$sql .= "WHERE unban_time <= UNIX_TIMESTAMP()";
			}
		}
		if (Flux::config('HidePermBannedStats')) {
			if ($hideGroupLevel || Flux::config('HideTempBannedStats')) {
				$sql .= " AND state != 5";
			} else {
				$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = `char`.account_id ";
				$sql .= "WHERE state != 5";
			}
		}

		$sth = $server->connection->getStatement($sql);
		$sth->execute($hideGroupLevel ? $bind : array());
		$info['zeny'] += $sth->fetch()->total;

	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/** WOE PARSER **/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$dayNames  = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
	$groupD = array();
	$castleNames = Flux::config('CastleNames')->toArray();
	foreach ($WoEdayTimes as $castname => $time_) {
		$time_[4] = $castname;
	if ($time_[4] === "") $time_[4] = "NOT SPECIFIED";
		$wTi[] = array (
			'startingTime' => strtotime($dayNames[$time_[0]]." ".$time_[1]),
			'endingTime' => strtotime($dayNames[$time_[2]]." ".$time_[3]),
			'map' => $time_[4],
		);
		$groupD[$dayNames[$time_[0]]][] = array (
			'startingTime' => $dayNames[$time_[0]]." ".$time_[1],
			'endingTime' => $dayNames[$time_[2]]." ".$time_[3],
			'map' => $time_[4],
		);
	}
	sort($wTi);
		foreach ($wTi as $ti) {

		if ($ti['startingTime'] > time()) {
			$startingTime = $ti['startingTime'];
			$cas = $ti['map'];
			$status = 0;
			break;
		}
		elseif ($ti['startingTime'] < time() && $ti['endingTime'] > time()) {
			$startingTime = $ti['endingTime'];
			$status = 1;
			$cas = $ti['map'];
			break;
		}
		}
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/** SERVER STATUS **/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (file_exists($cache) && (time() - filemtime($cache)) < (Flux::config('ServerStatusCache') * 60)) {
	$serverStatus = unserialize(file_get_contents($cache));
}
else {
	$pn = 0;
	
	$serverStatus = array();
	foreach (Flux::$loginAthenaGroupRegistry as $groupName => $loginAthenaGroup) {
		if (!array_key_exists($groupName, $serverStatus)) {
			$serverStatus[$groupName] = array();
		}

		$loginServerUp = $loginAthenaGroup->loginServer->isUp();

		foreach ($loginAthenaGroup->athenaServers as $athenaServer) {
			$serverName = $athenaServer->serverName;

			$sql = "SELECT COUNT(char_id) AS players_online FROM {$athenaServer->charMapDatabase}.char WHERE online > 0";
			$sth = $loginAthenaGroup->connection->getStatement($sql);
			$sth->execute();
			$res = $sth->fetch();

			$serverStatus[$groupName][$serverName] = array(
				'loginServerUp' => $loginServerUp,
				 'charServerUp' => $athenaServer->charServer->isUp(),
				  'mapServerUp' => $athenaServer->mapServer->isUp(),
				'playersOnline' => intval($res ? $res->players_online : 0)
			);
		}
	}
	
	$fp = fopen($cache, 'w');
	if (is_resource($fp)) {
		fwrite($fp, serialize($serverStatus));
		fclose($fp);
	}
}
	foreach ($serverStatus[$session->loginAthenaGroup->serverName][$serverNames[0]] as $scol => $sdata) $ss[] = $sdata;
	

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**TOP GUILD **/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (file_exists($guild_s) && time_check('+1 hour', $guild_s)) {
	$guild_s = unserialize(file_get_contents($guild_s, null, null, 28));
}
else {
$castleNames = Flux::config('CastleNames')->toArray();
$ids  = implode(',', array_fill(0, count($castleNames), '?'));
$bind = array_keys($castleNames);

$col  = "g.guild_id, g.name, g.master, g.guild_lv, g.average_lv, g.emblem_len, ";
$col .= "GREATEST(g.exp, (SELECT SUM(exp) FROM {$server->charMapDatabase}.guild_member WHERE guild_member.guild_id = g.guild_id)) AS exp, ";
$col .= "(SELECT COUNT(char_id) FROM {$server->charMapDatabase}.`char` WHERE `char`.guild_id = g.guild_id) AS members, ";
$col .= "(SELECT COUNT(castle_id) FROM {$server->charMapDatabase}.guild_castle WHERE guild_castle.guild_id = g.guild_id AND castle_id IN ($ids)) AS castles";

$sql  = "SELECT $col FROM {$server->charMapDatabase}.guild AS g ";
$sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS ch ON ch.char_id = g.char_id ";
$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";

$groups = AccountLevel::getGroupID((int)Flux::config('RankingHideGroupLevel'), '<');
if(!empty($groups)) {
	$ids   = implode(', ', array_fill(0, count($groups), '?'));
	$sql  .= "WHERE login.group_id IN ($ids) ";
	$bind  = array_merge($bind, $groups);
}
$sql .= "ORDER BY castles DESC ";
$sql .= "LIMIT 1";
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);
$castles_ = $sth->fetchAll();
	$guildies = array();
	foreach ($castles_ as $castle_) {
		$guildies[] = array(
				'guild_id' => $castle_->guild_id,
				'guild_name'    => $castle_->name,
				'emblem_len'   => $castle_->emblem_len,
				'master'		=> $castle_->master,
				'guild_leader'	=> $castle_->master,
			);
	}
	$guild_s = serialize_cache($guild_s,$guildies);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/** PLAYER RANKING**/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (file_exists($player_s) && time_check('+0 minutes', $player_s)) {
	$player_s = unserialize(file_get_contents($player_s, null, null, 28));
}
else {
$classes  = Flux::config('JobClasses')->toArray();
$jobClass = $params->get('jobclass');
$bind     = array();

if (trim($jobClass) === '') {
	$jobClass = null;
}

if (!is_null($jobClass) && !array_key_exists($jobClass, $classes)) {
	$this->deny();
}

$col  = "ch.char_id, ch.name AS char_name, ch.class AS char_class, ch.base_level, ch.base_exp, ch.job_level, ch.job_exp, ";
$col .= "ch.guild_id, guild.name AS guild_name, guild.emblem_len AS guild_emblem_len";

$sql  = "SELECT $col FROM {$server->charMapDatabase}.`char` AS ch ";
$sql .= "LEFT JOIN {$server->charMapDatabase}.guild ON guild.guild_id = ch.guild_id ";
$sql .= "LEFT JOIN {$server->loginDatabase}.login ON login.account_id = ch.account_id ";
$sql .= "WHERE 1=1 ";

if (Flux::config('HidePermBannedCharRank')) {
	$sql .= "AND login.state != 5 ";
}
if (Flux::config('HideTempBannedCharRank')) {
	$sql .= "AND (login.unban_time IS NULL OR login.unban_time = 0) ";
}

$groups = AccountLevel::getGroupID((int)Flux::config('RankingHideGroupLevel'), '<');
if(!empty($groups)) {
	$ids   = implode(', ', array_fill(0, count($groups), '?'));
	$sql  .= "AND login.group_id IN ($ids) ";
	$bind  = array_merge($bind, $groups);
}

if ($days=Flux::config('CharRankingThreshold')) {
	$sql    .= 'AND TIMESTAMPDIFF(DAY, login.lastlogin, NOW()) <= ? ';
	$bind[]  = $days * 24 * 60 * 60;
}

if (!is_null($jobClass)) {
	$sql .= "AND ch.class = ? ";
	$bind[] = $jobClass;
}

$sql .= "ORDER BY ch.base_level DESC, ch.base_exp DESC, ch.job_level DESC, ch.job_exp DESC, ch.char_id ASC ";
$sql .= "LIMIT ".(int)Flux::config('CharRankingLimit');
$sth  = $server->connection->getStatement($sql);

$sth->execute($bind);

$char_ns_ = $sth->fetchAll();
	
		for ($i = 0; $i<7; $i++) {
		if (isset($char_ns_[$i])) {
		$char_n = $char_ns_[$i];
		$guildies[$i] = array(
				'pvpkpts'	=> $char_n->pvpkpts,
				'pvpdpts'	=> $char_n->pvpdpts,
				'char_id'	=> $char_n->char_id,
                'char_name' => $char_n->char_name,
                'char_class' => $char_n->char_class,
				'char_sex'	=> $char_n->char_sex,
                'base_level' => $char_n->base_level,
                'base_exp' => $char_n->base_exp,
                'job_level' => $char_n->job_level,
                'job_exp' => $char_n->job_exp,
                'guild_id' => $char_n->guild_id,
                'guild_name' => $char_n->guild_name,
                'guild_emblem_len' => $char_n->guild_emblem_len,
			);
		}
	}
	$player_s = serialize_cache($player_s,$guildies);
}

?>
