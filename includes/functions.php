<?php

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// $_GET,$_POST helpers

function _post($par, $def = false)
{
  $ret =
    isset($_POST[$par]) && $_POST[$par] !== ''
      ? addslashes($_POST[$par])
      : false;
  if ($ret !== false) {
    return $ret;
  } else {
    return $def;
  }
}

function _get($par, $def = false)
{
  $ret =
    isset($_GET[$par]) && $_GET[$par] !== '' ? addslashes($_GET[$par]) : false;
  if ($ret !== false) {
    return $ret;
  } else {
    return $def;
  }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// mode and parametes

function check_mode($mode = 'start')
{
  global $MODE_LIST;
  return array_search($mode, $MODE_LIST) ? $mode : 'start';
}

function mode_parameters($mode = 'start')
{
  global $MODE_LIST_PARAMETERS;
  $pars = $MODE_LIST_PARAMETERS[$mode];

  $return_array = array();
  foreach ($pars as $parameter => $opts) {
    if ($opts['type'] == 'get') {
      $temp = _get($parameter, false);
    } else {
      $temp = _post($parameter, false);
    }

    if ($opts['required'] && $temp === false) {
      p404('Error: The parameter ' . $parameter . ' was not given!', 'Error');
    } else {
      $return_array[$parameter] = $temp;
    }
  }
  return $return_array;
}

function validate_parameters($pars)
{
  global $MODE, $MODE_PARAMETERS_VALIDATION;

  if (array_key_exists($MODE, $MODE_PARAMETERS_VALIDATION)) {
    $pars = call_user_func($MODE_PARAMETERS_VALIDATION[$MODE], $pars);
  }

  return $pars;
}

function get_parameter($key = '', $show = false)
{
  global $MODE_PARS;
  $res = isset($MODE_PARS[$key]) ? $MODE_PARS[$key] : '';

  if (!$show) {
    return $res;
  } else {
    echo $res;
  }
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// parameters validation

// by daniweb.com
function EmailValidation($email)
{
  $email = htmlspecialchars(stripslashes(strip_tags($email))); //parse unnecessary characters to prevent exploits

  if (preg_match('#[a-z||0-9]\@[a-z||0-9].[a-z]#i', $email)) {
    //checks to make sure the email address is in a valid format
    $domain = explode('@', $email); //get the domain name
    if (@fsockopen($domain[1], 80, $errno, $errstr, 3)) {
      //if the connection can be established, the email address is probably valid
      return true;
    } else {
      return false; //if a connection cannot be established return false
    }
    return false; //if email address is an invalid format return false
  }
}

// by http://phpcentral.com/208-url-validation-in-php.html
function isValidURL($url)
{
  return preg_match(
    '|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i',
    $url
  );
}

function checklatin($u, $space = false)
{
  $validChars =
    'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890';
  $validChars .= $space ? ' ' : '';
  $len = strlen($u);

  $i = 0;
  $check = false;

  while ($i < $len && $check === false) {
    if (strpos($validChars, $u[$i]) === false) {
      $check = true;
    }
    $i++;
  }

  return $check ? false : true;
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// misc

function generate_info_btn($id, $show = true)
{
  if ($show) {
    echo '<span class="clan-profile-popup" data-plugin="jpopup" data-height="400" data-width="510" data-type="ajax" data-typevalue="ajax.php?mode=clan&cid=' .
      $id .
      '&secid=' .
      $_SESSION['secid'] .
      '">info</span>';
  } else {
    return '<span class="clan-profile-popup" data-plugin="jpopup" data-height="400" data-width="510" data-type="ajax" data-typevalue="ajax.php?mode=clan&cid=' .
      $id .
      '&secid=' .
      $_SESSION['secid'] .
      '">info</span>';
  }
}

function generate_send_msg_btn($id, $show = true)
{
  if ($show) {
    echo '<span class="clan-profile-popup" data-plugin="jpopup" data-height="310" data-width="470" data-type="ajax" data-typevalue="ajax.php?mode=msg&cid=' .
      $id .
      '&secid=' .
      $_SESSION['secid'] .
      '">send message</span>';
  } else {
    return '<span class="clan-profile-popup" data-plugin="jpopup" data-height="310" data-width="470" data-type="ajax" data-typevalue="ajax.php?mode=msg&cid=' .
      $id .
      '&secid=' .
      $_SESSION['secid'] .
      '">send message</span>';
  }
}

function generate_map_options($show = true)
{
  global $MAP_LIST;

  $html = '';
  foreach ($MAP_LIST as $key => $map) {
    $html .= '<option value="' . $key . '">' . $key . '</option>';
  }

  if ($show) {
    echo $html;
  } else {
    return $html;
  }
}

function isAjax()
{
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function is_logged()
{
  return isset($_SESSION['user']) ? true : false;
}

function login_needed($mode, $logged)
{
  $ar_login_true = array(
    'zero_index_holder',
    'find',
    'create',
    'logout',
    'submitcreate',
    'controlpanel',
    'submitcontrolpanel',
    'submitfind',
    'findresults',
    'challenge',
    'notifications',
    'deletematch',
    'declinechallenge',
    'acceptchallenge',
    'submitmessage',
    'mymatches',
  );

  if (array_search($mode, $ar_login_true) && !$logged) {
    redirectHTML('error/3');
  }
}

function zero($n)
{
  $n .= '';
  return strlen($n) > 1 ? $n : '0' . $n;
}

function load_includes($mode)
{
  switch ($mode) {
    case 'register':
      include 'recaptchalib.php';
      break;

    case 'submitregister':
      include 'recaptchalib.php';
      break;

    case 'submitcreate':
      include 'match.php';
      break;

    case 'controlpanel':
      include 'match.php';
      break;

    case 'submitfind':
      include 'match.php';
      break;

    case 'findresults':
      include 'match.php';
      break;

    case 'match':
      include 'match.php';
      break;

    case 'challenge':
      include 'match.php';
      break;

    case 'deletematch':
      include 'match.php';
      break;

    case 'declinechallenge':
      include 'match.php';
      break;

    case 'acceptchallenge':
      include 'match.php';
      break;

    case 'mymatches':
      include 'match.php';
      break;
  }
}

function random_string()
{
  $character_set_array = array();
  $character_set_array[] = array(
    'count' => 12,
    'characters' => 'abcdefghijklmnopqrstuvwxyz',
  );
  $character_set_array[] = array('count' => 4, 'characters' => '0123456789');
  $temp_array = array();
  foreach ($character_set_array as $character_set) {
    for ($i = 0; $i < $character_set['count']; $i++) {
      $temp_array[] =
        $character_set['characters'][
          rand(0, strlen($character_set['characters']) - 1)
        ];
    }
  }
  shuffle($temp_array);
  return implode('', $temp_array);
}

function get_pagination_rules($sum_pages, $current_page)
{
  $order = array();
  if ($current_page == 1) {
    $order[] = 1;
    $order[] = 2;
  } elseif ($current_page == $sum_pages) {
    $order[] = $sum_pages - 1;
    $order[] = $sum_pages;
  } else {
    $order[] = $current_page - 1;
    $order[] = $current_page;
    $order[] = $current_page + 1;
  }

  if (array_search(1, $order) === false) {
    $order[] = 1;
  }

  if (array_search($sum_pages, $order) === false) {
    $order[] = $sum_pages;
  }

  sort($order);
  return $order;
}

// returns a slated password hash
function si_encrypt($str)
{
  $md5 = md5($str);
  $sha1 = sha1($str);
  return substr($md5, 5, 15) . substr($sha1, 10, 25);
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// mysql calls

function get_clan_info($id)
{
  global $MYSQL;
  if (!is_numeric($id)) {
    redirectHTML('error/6');
  }

  $r = $MYSQL->query("SELECT * FROM clans WHERE id = {$id}", true);
  if ($r !== false && mysqli_num_rows($r) > 0) {
    return mysqli_fetch_array($r);
  } else {
    return false;
  }
}

function update_session()
{
  global $LOGGED;
  if (!$LOGGED) {
    return false;
  }

  $info = get_clan_info($_SESSION['id']);
  if (!is_array($info) && $info === false) {
    return false;
  }

  $_SESSION['user'] = $info['email'];
  $_SESSION['id'] = $info['id'];
  $_SESSION['name'] = $info['name'];
  $_SESSION['rights'] = $info['rights'];
  $_SESSION['tag'] = $info['tag'];
  $_SESSION['avatar'] = $info['avatar'];
  $_SESSION['country'] = $info['country'];
  $_SESSION['secid'] = random_string();
}

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// notifications

function add_notification($content, $f_id, $t_id, $type = 'notification')
{
  global $MYSQL, $TIME_MODIFIER;

  $to_clan = get_clan_info($t_id);
  $from_clan = get_clan_info($f_id);

  $time = time() + 3600 * $TIME_MODIFIER;
  $content = htmlspecialchars($content);
  $r = $MYSQL->query("INSERT INTO notifications
                                                (content,from_id,from_name,to_id,to_name,type,time)
                                                VALUES ('{$content}',{$f_id},'{$from_clan['name']}',{$t_id},'{$to_clan['name']}','{$type}',{$time})");
  if (!$r) {
    redirectHTML('error/1');
  } else {
    return true;
  }
}

function unread_notifications()
{
  global $MYSQL;
  $r = $MYSQL->query(
    "SELECT * FROM notifications WHERE to_id = {$_SESSION['id']} AND opened = 0"
  );
  if (!$r) {
    redirectHTML('error/1');
  } else {
    return mysqli_num_rows($r);
  }
}

function notifications_mark_read($maxid = 1, $minid = 0)
{
  global $MYSQL;
  $r = $MYSQL->query(
    "UPDATE notifications SET opened = 1 WHERE id <= {$maxid} AND id >= {$minid} AND opened = 0 AND to_id = {$_SESSION['id']}"
  );
  if (!$r) {
    redirectHTML('error/1');
  } else {
    return true;
  }
}
