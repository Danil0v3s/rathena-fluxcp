<?php if (!defined('FLUX_ROOT')) exit;
$cache = FLUX_DATA_DIR . '/tmp/ServerStatus.cache';

if (file_exists($cache) && (time() - filemtime($cache)) < (Flux::config('ServerStatusCache') * 600)) {
    $serverStatus = unserialize(file_get_contents($cache));
} else {
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
$cServer = array_values(array_values($serverStatus)[0])[0];
$serverOnline = "Off";
$onlinePlayersCount = $cServer["playersOnline"];
if ($cServer["loginServerUp"] && $cServer["charServerUp"] && $cServer["mapServerUp"]) {
    $serverOnline = "On";
}
?>

<div class="statusInfo">Server: <a id="server" class="<?php echo $serverOnline; ?>" href="<?php echo $this->url('server', 'status'); ?>"><?php echo $serverOnline; ?></a></div>
<div class="statusInfo">Players: <a id="players" href="<?php echo $this->url('character', 'online'); ?>"><?php echo $onlinePlayersCount; ?></a> </div>