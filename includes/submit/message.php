<?php

// secid validation - session validation
validate_secid($MODE_PARS['secid']);

// validate parameters
$MODE_PARS['message'] = htmlspecialchars($MODE_PARS['message']);

// validate matchid
if (!is_numeric($MODE_PARS['clanid'])) {
  redirectHTML('/error/7');
} else {
  $MODE_PARS['clanid'] = number_format($MODE_PARS['clanid'], 0);
}

// get clan_info
$clan_info = get_clan_info($MODE_PARS['clanid']);

// check if user not equal to receiver
if ($_SESSION['id'] == $MODE_PARS['clanid']) {
  redirectHTML('/error/9');
}

// send message as notification
$content =
  '<b>' .
  $_SESSION['name'] .
  '</b> send you this message: ' .
  $MODE_PARS['message'];
add_notification($content, $_SESSION['id'], $MODE_PARS['clanid'], 'message');

if (!isAjax()) {
  redirectHTML('start');
} else {
  redirectAjax('sent');
}
