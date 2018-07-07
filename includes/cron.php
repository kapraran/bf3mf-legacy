<?php

include 'mysql.php';
include 'config.php';

function _log($msg)
{
    global $TIME;

    // read
    $h = fopen('includes/cron/cronlogs.txt', 'rb');
    $c = fread($h, filesize('includes/cron/cronlogs.txt'));
    fclose($h);

    // write
    $h = fopen('includes/cron/cronlogs.txt', 'w');
    fwrite($h, $c . date('[d/m/Y H:i:s]', $TIME) . " <::> " . $msg . "\r\n");
    fclose($h);
}

$MYSQL = new Mysql();
$TIME = time() + 3600 * $TIME_MODIFIER;

// include cron jobs
include 'cron/check_active_matches.php';
include 'cron/delete_notifs.php';
include 'cron/delete_challenges.php';

_log("Cron completed!");
