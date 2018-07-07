<?php
// secid validation - session validation
validate_secid($MODE_PARS['secid']);

// validate matchid
if (!is_numeric($MODE_PARS['matchid'])) {
    redirectHTML('error/6');
}

$MODE_PARS['matchid'] = number_format($MODE_PARS['matchid'], 0);

$MATCH = new Match();

// get match info
$match_info = $MATCH->get_match($MODE_PARS['matchid']);

// check if user has the right to delete the match
if ($_SESSION['id'] !== $match_info['clan_id']) {
    redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/10');
}

// clear challenges and send notifications
$MATCH->clear_challenges($MODE_PARS['matchid']);

// delete match
$q = $MYSQL->query(" DELETE FROM matches WHERE id = {$MODE_PARS['matchid']} ");
if (!$q) {
    redirectHTML('error/1');
} else {
    redirectHTML('start');
}
