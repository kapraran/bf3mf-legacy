<?php

// Check match statuses
//----------------------------------------------------

$cm = $MYSQL->query("UPDATE matches SET active = 0 WHERE end_time < {$TIME}");
if (!$cm) {
    _log('Error: check_active_matches.php #update');
    die();
}

// Delete inactive matches
//----------------------------------------------------

$im = $MYSQL->query('DELETE FROM matches WHERE active = 0');
if (!$im) {
    _log('Error: check_active_matches.php #delete');
    die();
}
