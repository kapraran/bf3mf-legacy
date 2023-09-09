<?php
// secid validation - session validation
validate_secid($MODE_PARS['secid']);

// validate matchid
if (!is_numeric($MODE_PARS['matchid'])) {
  redirectHTML('error/6');
}

// validate challenge id
if (!is_numeric($MODE_PARS['cid'])) {
  redirectHTML('error/6');
}

$MODE_PARS['matchid'] = number_format($MODE_PARS['matchid'], 0);
$MODE_PARS['cid'] = number_format($MODE_PARS['cid'], 0);

$MATCH = new CMatch();

// get match info
$match_info = $MATCH->get_match($MODE_PARS['matchid']);

// check if current user is the creator of current match
if ($match_info['clan_id'] != $_SESSION['id']) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/12');
}

// get challenge info
$challenge_info = $MATCH->get_challenge_info($MODE_PARS['cid']);

// check if already accepted,rejected
if ($challenge_info['accepted'] == 1 || $challenge_info['rejected'] == 1) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/13');
}

// check if this challenge is for current user
if ($challenge_info['match_clan_id'] != $_SESSION['id']) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/14');
}

// check if this challenge is for current match
if ($challenge_info['match_id'] != $MODE_PARS['matchid']) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/15');
}

// send a notification to the creator of the challenge
$notification_content =
  '<b>' .
  $_SESSION['name'] .
  '</b> rejected your challenge for <a href="./match/' .
  $MODE_PARS['matchid'] .
  '">match #' .
  $MODE_PARS['matchid'] .
  '</a>';
add_notification(
  $notification_content,
  $_SESSION['id'],
  $challenge_info['from_clan_id']
);

// reject the (fucking) challenge
$q = $MYSQL->query(
  "UPDATE challenges SET rejected = 1 WHERE id = {$challenge_info['id']}"
);
if (!$q) {
  redirectHTML('error/1');
}

// success
redirectHTML('./match/' . $MODE_PARS['matchid'] . '/success/30');
