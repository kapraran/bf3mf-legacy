<?php

$MATCH = new Match();
$start_time = $MATCH->is_real_time(
  $MODE_PARS['start_day'],
  $MODE_PARS['start_month'],
  $MODE_PARS['start_year'],
  $MODE_PARS['start_hour'],
  $MODE_PARS['start_min']
);
$end_time = $start_time + $MODE_PARS['time_after'] * 3600;
$time = time() + $TIME_MODIFIER * 3600;

if ($time - 3600 > $start_time) {
  redirectHTML('create/error/14');
}

$MATCH->check_actives($time);
$MATCH->check_active_matches();

$r = $MYSQL->query("INSERT INTO matches (clan_name,clan_id,active,
                                     start_time,end_time,server_region,server_own,
                                     dlc_own,preset,mode,platform,tsize,
                                     map1,map2,map3,notes) VALUES
                                     ('{$_SESSION['name']}','{$_SESSION['id']}',1,
                                     {$start_time},{$end_time},'{$MODE_PARS['server_region']}','{$MODE_PARS['server_own']}',
                                     '{$MODE_PARS['dlc_own']}','{$MODE_PARS['preset']}','{$MODE_PARS['mode']}','{$MODE_PARS['platform']}',{$MODE_PARS['tsize']},
                                     '{$MODE_PARS['map1']}','{$MODE_PARS['map2']}','{$MODE_PARS['map3']}','{$MODE_PARS['notes']}')");

if (!$r) {
  redirectHTML('error/1');
} else {
  $lastid = $MYSQL->last_id();
  redirectHTML('match/' . $lastid);
}
