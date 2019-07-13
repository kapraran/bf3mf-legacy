<?php

//***************************************************************//
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
//                                    Validate user inputs                         //
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
//***************************************************************//

function valid_sregister($pars)
{
  foreach ($pars as $k => $p) {
    $pars[$k] = trim($p);
  }

  $pars['claninfo'] = htmlspecialchars($pars['claninfo']);

  if (!EmailValidation($pars['email'])) {
    redirectHTML('register/error/2');
  }

  if (
    strlen($pars['password']) < 6 ||
    strlen($pars['password']) > 20 ||
    !checklatin($pars['password'])
  ) {
    redirectHTML('register/error/3');
  }

  if ($pars['password'] != $pars['rpassword']) {
    redirectHTML('register/error/4');
  }

  if (strlen($pars['clantag']) > 4 || strlen($pars['clantag']) < 2) {
    redirectHTML('register/error/5');
  }

  if (strlen($pars['claninfo']) > 256 || strlen($pars['claninfo']) < 1) {
    redirectHTML('register/error/6');
  }

  if (
    strlen($pars['clanname']) > 100 ||
    strlen($pars['clanname']) < 5 ||
    !checklatin($pars['clanname'], true)
  ) {
    redirectHTML('register/error/8');
  }

  // disable recaptcha
  // if (!(strlen($pars['recaptcha_response_field']) > 0) || !(strlen($pars['recaptcha_challenge_field']) > 0)) {
  //     redirectHTML('register/error/9');
  // }

  return $pars;
}

function valid_slogin($pars)
{
  foreach ($pars as $k => $p) {
    $pars[$k] = trim($p);
  }

  if (!EmailValidation($pars['email'])) {
    redirectHTML('login/error/2');
  }

  if (
    strlen($pars['password']) < 6 ||
    strlen($pars['password']) > 20 ||
    !checklatin($pars['password'])
  ) {
    redirectHTML('login/error/3');
  }

  return $pars;
}

function validate_create_match($pars)
{
  global $MAP_LIST;

  // check if not numeric values
  numeric(
    array(
      $pars['start_day'],
      $pars['start_month'],
      $pars['start_year'],
      $pars['start_hour'],
      $pars['start_min'],
    ),
    'none'
  );

  // server region
  if (
    !array_search($pars['server_region'], array('ZERO_INDEX', 'US', 'EU', 'AS'))
  ) {
    redirectHTML('create/error/1');
  }

  // start day
  if (
    $pars['start_day'] == 'none' ||
    $pars['start_day'] > 31 ||
    $pars['start_day'] < 1
  ) {
    redirectHTML('create/error/2');
  }

  // start month
  if (
    $pars['start_month'] == 'none' ||
    $pars['start_month'] > 12 ||
    $pars['start_month'] < 1
  ) {
    redirectHTML('create/error/3');
  }

  // start year
  if (
    $pars['start_year'] == 'none'
  ) {
    redirectHTML('create/error/4');
  }

  // start hour
  if (
    $pars['start_hour'] == 'none' ||
    $pars['start_hour'] > 23 ||
    $pars['start_hour'] < 0
  ) {
    redirectHTML('create/error/5');
  }

  // start min
  if (
    $pars['start_min'] == 'none' ||
    $pars['start_min'] > 59 ||
    $pars['start_min'] < 0
  ) {
    redirectHTML('create/error/6');
  }

  if ($pars['start_min'] % 5 !== 0) {
    $pars['start_min'] = $pars['start_min'] - ($pars['start_min'] % 5);
  }

  // time after
  if (
    $pars['time_after'] == 'none' ||
    $pars['time_after'] > 12 ||
    $pars['time_after'] < 2
  ) {
    redirectHTML('create/error/7');
  }

  // Own server
  if ($pars['server_own'] != 'yes' && $pars['server_own'] != 'no') {
    redirectHTML('create/error/8');
  }

  // DLC
  if ($pars['dlc_own'] != 'yes' && $pars['dlc_own'] != 'no') {
    redirectHTML('create/error/9');
  }

  // preset
  if (
    !array_search($pars['preset'], array('ZERO_INDEX', 'no', 'hc', 'in', 'cu'))
  ) {
    redirectHTML('create/error/10');
  }

  // mode
  if (
    !array_search($pars['mode'], array('ZERO_INDEX', 'cq', 'rs', 'sqrs', 'tdm'))
  ) {
    redirectHTML('create/error/11');
  }

  // platform
  if (
    !array_search($pars['platform'], array('ZERO_INDEX', 'pc', 'ps3', 'x360'))
  ) {
    redirectHTML('create/error/12');
  }

  // team size
  if (
    !array_search($pars['tsize'], array('ZERO_INDEX', 4, 8, 12, 16, 24, 32))
  ) {
    redirectHTML('create/error/15');
  }

  // recommended maps
  $pars['map1'] = $pars['map1'] == 'none' ? '' : $pars['map1'];
  $pars['map2'] = $pars['map2'] == 'none' ? '' : $pars['map2'];
  $pars['map3'] = $pars['map3'] == 'none' ? '' : $pars['map3'];

  if ($pars['map1'] != '' && !array_key_exists($pars['map1'], $MAP_LIST)) {
    redirectHTML('create/error/13');
  }

  if ($pars['map2'] != '' && !array_key_exists($pars['map2'], $MAP_LIST)) {
    redirectHTML('create/error/13');
  }

  if ($pars['map3'] != '' && !array_key_exists($pars['map3'], $MAP_LIST)) {
    redirectHTML('create/error/13');
  }

  // notes
  $pars['notes'] = trim(htmlspecialchars($pars['notes']));

  // secid
  validate_secid($pars['secid']);

  return $pars;
}

function validate_update_settings($pars)
{
  global $COUNTRIES;

  // clan tag
  if (strlen($pars['clantag']) > 4 || strlen($pars['clantag']) < 2) {
    redirectHTML('controlpanel/error/1');
  }

  // clan logo
  if (
    isset($pars['clanlogo']) &&
    strlen(trim($pars['clanlogo'])) > 0 &&
    !isValidURL($pars['clanlogo'])
  ) {
    redirectHTML('controlpanel/error/2');
  }

  // battlelog profile url
  $b_log_url =
    strlen(trim($pars['battlelog'])) > 0
      ? parse_url($pars['battlelog'])
      : array('host' => 'error');
  if (
    strlen(trim($pars['battlelog'])) > 0 &&
    (!isValidURL($pars['battlelog']) ||
      $b_log_url['host'] !== 'battlelog.battlefield.com')
  ) {
    redirectHTML('controlpanel/error/3');
  }

  // country
  if (!array_key_exists($pars['country'], $COUNTRIES)) {
    redirectHTML('controlpanel/error/4');
  }

  validate_secid($pars['secid']);

  return $pars;
}

function validate_find_match($pars)
{
  // check if not numeric values
  numeric(
    array(
      $pars['start_day'],
      $pars['start_month'],
      $pars['start_year'],
      $pars['start_hour'],
      $pars['start_min'],
      $pars['end_day'],
      $pars['end_month'],
      $pars['end_year'],
      $pars['end_hour'],
      $pars['end_min'],
    ),
    'none'
  );

  // server region
  if (
    $pars['server_region'] != 'all' &&
    !array_search($pars['server_region'], array('ZERO_INDEX', 'US', 'EU', 'AS'))
  ) {
    redirectHTML('find/error/1');
  }

  // start day
  if (
    $pars['start_day'] == 'none' ||
    $pars['start_day'] > 31 ||
    $pars['start_day'] < 1
  ) {
    redirectHTML('find/error/2');
  }

  // start month
  if (
    $pars['start_month'] == 'none' ||
    $pars['start_month'] > 12 ||
    $pars['start_month'] < 1
  ) {
    redirectHTML('find/error/2');
  }

  // start year
  if (
    $pars['start_year'] == 'none'
  ) {
    redirectHTML('find/error/2');
  }

  // start hour
  if (
    $pars['start_hour'] == 'none' ||
    $pars['start_hour'] > 23 ||
    $pars['start_hour'] < 0
  ) {
    redirectHTML('find/error/2');
  }

  // start min
  if (
    $pars['start_min'] == 'none' ||
    $pars['start_min'] > 59 ||
    $pars['start_min'] < 0
  ) {
    redirectHTML('find/error/2');
  }

  if ($pars['start_min'] % 5 !== 0) {
    $pars['start_min'] = $pars['start_min'] - ($pars['start_min'] % 5);
  }

  // end day
  if (
    $pars['end_day'] == 'none' ||
    $pars['end_day'] > 31 ||
    $pars['end_day'] < 1
  ) {
    redirectHTML('find/error/3');
  }

  // end month
  if (
    $pars['end_month'] == 'none' ||
    $pars['end_month'] > 12 ||
    $pars['end_month'] < 1
  ) {
    redirectHTML('find/error/3');
  }

  // end year
  if (
    $pars['end_year'] == 'none'
  ) {
    redirectHTML('find/error/3');
  }

  // end hour
  if (
    $pars['end_hour'] == 'none' ||
    $pars['end_hour'] > 23 ||
    $pars['end_hour'] < 0
  ) {
    redirectHTML('find/error/3');
  }

  // end min
  if (
    $pars['end_min'] == 'none' ||
    $pars['end_min'] > 59 ||
    $pars['end_min'] < 0
  ) {
    redirectHTML('find/error/3');
  }

  if ($pars['start_min'] % 5 !== 0) {
    $pars['start_min'] = $pars['start_min'] - ($pars['start_min'] % 5);
  }

  // preset
  if (
    $pars['preset'] != 'all' &&
    !array_search($pars['preset'], array('ZERO_INDEX', 'no', 'hc', 'in', 'cu'))
  ) {
    redirectHTML('find/error/4');
  }

  // mode
  if (
    $pars['mode'] != 'all' &&
    !array_search($pars['mode'], array('ZERO_INDEX', 'cq', 'rs', 'sqrs', 'tdm'))
  ) {
    redirectHTML('find/error/5');
  }

  // platform
  if (
    $pars['platform'] != 'all' &&
    !array_search($pars['platform'], array('ZERO_INDEX', 'pc', 'ps3', 'x360'))
  ) {
    redirectHTML('find/error/6');
  }

  // team size
  if (
    $pars['tsize'] != 'all' &&
    !array_search($pars['tsize'], array('ZERO_INDEX', 4, 8, 12, 16, 24, 32))
  ) {
    redirectHTML('find/error/7');
  }

  // secid
  validate_secid($pars['secid']);

  return $pars;
}

//--> validate secid
function validate_secid($s)
{
  if (isset($_SESSION['secid']) && $_SESSION['secid'] != $s) {
    redirectHTML('error/5');
  }
}

//--> validate numerics
function numeric($n, $not = false)
{
  foreach ($n as $num) {
    if (!is_numeric($num) && $not !== $num) {
      redirectHTML('error/7');
    }
  }
}
