<?php
// secid validation - session validation
validate_secid($MODE_PARS['secid']);

// validate matchid
if (!is_numeric($MODE_PARS['matchid'])) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/4');
}

$MODE_PARS['matchid'] = number_format($MODE_PARS['matchid'], 0);

$MATCH = new Match();

// update active matches
$MATCH->check_actives(time() + 3600 * $TIME_MODIFIER);

// get match info
$match_info = $MATCH->get_match($MODE_PARS['matchid']);

if ($match_info['active'] === 0) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/1');
}

// check if not the same clan
if ($_SESSION['id'] === $match_info['clan_id']) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/2');
}

// check if already challenged
if ($MATCH->already_challenged($MODE_PARS['matchid'])) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/3');
}

// check if already accepted
if ($MATCH->check_if_accepted($MODE_PARS['matchid'])) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/16');
}

// check active challenges
if ($MATCH->active_challenges() > 10) {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/5');
}

// create the challenge
$cr = $MATCH->create_challenge($MODE_PARS['matchid']);

if ($cr === true) {
  add_notification(
    '<b>' .
      $_SESSION['name'] .
      '</b> sent you a challenge for <a href="/match/' .
      $MODE_PARS['matchid'] .
      '">this match [#' .
      $MODE_PARS['matchid'] .
      ']</a>',
    $_SESSION['id'],
    $match_info['clan_id']
  );
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/success');
} else {
  redirectHTML('match/' . $MODE_PARS['matchid'] . '/error/6');
}
