<?php

// Delete notifications that are 8 days old and readed
//----------------------------------------------------

$time_5d = $TIME - ((3600 * 24) * 5);
$dn = $MYSQL->query("DELETE FROM notifications WHERE time < {$time_5d} AND opened = 1 ");
if (!$dn) {
    _log('Error: delete_notifs.php');
    die();
}
