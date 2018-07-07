<?php
print_r($MODE_PARS);

$MATCH = new Match();
$start_time = $MATCH->is_real_time($MODE_PARS['start_day'], $MODE_PARS['start_month'], $MODE_PARS['start_year'], $MODE_PARS['start_hour'], $MODE_PARS['start_min']);
$end_time = $MATCH->is_real_time($MODE_PARS['end_day'], $MODE_PARS['end_month'], $MODE_PARS['end_year'], $MODE_PARS['end_hour'], $MODE_PARS['end_min']);
$time = time() + $TIME_MODIFIER * 3600;

if (($time - 3600) > $start_time) {
    redirectHTML('find/error/8');
}

if (($end_time - $start_time) > 432000/* 5 days in seconds */) {
    redirectHTML('find/error/9');
}

// Create query
$query = "SELECT * FROM matches WHERE active = 1 AND  ( ( start_time < {$end_time} AND start_time > {$start_time} ) OR ( end_time > {$start_time} AND end_time < {$end_time} ) )";

// server region
if ($MODE_PARS['server_region'] != 'all') {
    $query .= " AND server_region = '{$MODE_PARS['server_region']}' ";
}

// preset
if ($MODE_PARS['preset'] != 'all') {
    $query .= " AND preset = '{$MODE_PARS['preset']}' ";
}

// mode
if ($MODE_PARS['mode'] != 'all') {
    $query .= " AND mode = '{$MODE_PARS['mode']}' ";
}

// platform
if ($MODE_PARS['platform'] != 'all') {
    $query .= " AND platform = '{$MODE_PARS['platform']}' ";
}

// team size
if ($MODE_PARS['tsize'] != 'all') {
    $query .= " AND tsize = {$MODE_PARS['tsize']} ";
}

// Run query
$result = $MYSQL->query($query);

if (!$result) {
    redirectHTML('error/1');
} else {
    echo '<hr /><br />';
    echo mysql_num_rows($result);
}
