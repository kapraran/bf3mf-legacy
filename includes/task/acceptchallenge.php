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

$MATCH = new Match();

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

// reject the other open challenges and get the resource
// ( resource contains ids of clans that have been rejected )
$clan_id_res = $MATCH->reject_other_challenges_than(
  $MODE_PARS['cid'],
  $MODE_PARS['matchid']
);

// send a notification to the creator of the challenge (rejected)
$notification_content =
  '<b>' .
  $_SESSION['name'] .
  '</b> rejected your challenge for <a href="./match/' .
  $MODE_PARS['matchid'] .
  '">match #' .
  $MODE_PARS['matchid'] .
  '</a>';
while ($clan_id_array = mysqli_fetch_array($clan_id_res)) {
  add_notification(
    $notification_content,
    $_SESSION['id'],
    $clan_id_array['from_clan_id']
  );
}

// accept the challenge
$q = $MYSQL->query(
  "UPDATE challenges SET accepted = 1 WHERE id = {$challenge_info['id']}"
);
if (!$q) {
  redirectHTML('error/1');
}

// send a notification to the creator of the challenge (accepted)
$notification_content =
  '<b>' .
  $_SESSION['name'] .
  '</b> accepted your challenge for <a href="./match/' .
  $MODE_PARS['matchid'] .
  '">match #' .
  $MODE_PARS['matchid'] .
  '</a>. Contact the leader of this clan to arrange the details for this match!';
add_notification(
  $notification_content,
  $_SESSION['id'],
  $challenge_info['from_clan_id']
);

// success
redirectHTML('./match/' . $MODE_PARS['matchid'] . '/success/40');
