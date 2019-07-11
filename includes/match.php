<?php

class Match
{
  private $C_presets = array(
    'no' => 'Normal',
    'cu' => 'Custom',
    'hc' => 'Hardcore',
    'in' => 'Infantry',
  );
  private $C_modes = array(
    'cq' => 'Conquest',
    'tdm' => 'Team Deathmatch',
    'rs' => 'Rush',
    'sqrs' => 'Squad Rush',
  );
  private $C_platforms = array(
    'pc' => 'PC',
    'ps3' => 'Playstation 3',
    'x360' => 'XBOX 360',
  );

  //++++++++++++++++++++++++++ submit->create.php ++++++++++++++++++++++++++//

  // Checks if parameters provide a real date/time
  // if true, return timestamp
  public function is_real_time($day, $month, $year, $hour, $min)
  {
    $month_dates = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $month_dates[2] = $year % 4 === 0 ? 29 : 28;

    if ($day > $month_dates[$month]) {
      redirectHTML('error/4');
    }

    return mktime($hour, $min, 0, $month, $day, $year);
  }

  public function check_actives($time)
  {
    global $MYSQL;
    $r = $MYSQL->query("UPDATE matches SET active = 1
                                                    WHERE end_time < {$time}
                                                    AND clan_id = {$_SESSION['id']}");
    if (!$r) {
      redirectHTML('error/1');
    }

    return true;
  }

  public function check_active_matches()
  {
    global $MYSQL;
    $r = $MYSQL->query("SELECT * FROM matches
                                                    WHERE clan_id = {$_SESSION['id']}
                                                    AND active = 1");
    if (!$r) {
      redirectHTML('error/1');
    } elseif (mysqli_num_rows($r) >= 3) {
      redirectHTML('create/error/16');
    }

    return true;
  }

  //++++++++++++++++++++++++++ layout->match.php ++++++++++++++++++++++++++//

  public function get_match($id)
  {
    global $MYSQL;
    if (!is_numeric($id)) {
      redirectHTML('error/6');
    }

    $r = $MYSQL->query("SELECT * FROM matches WHERE id = {$id}", true);
    if ($r !== false && mysqli_num_rows($r) > 0) {
      return mysql_fetch_array($r);
    } else {
      redirectHTML('error/6');
    }
  }

  public function clan_info($id)
  {
    global $MYSQL;
    if (!is_numeric($id)) {
      redirectHTML('error/7');
    }

    $r = $MYSQL->query("SELECT * FROM clans WHERE id = {$id}", true);
    if ($r !== false && mysqli_num_rows($r) > 0) {
      return mysql_fetch_array($r);
    } else {
      redirectHTML('error/7');
    }
  }

  public function prep_team_size($s)
  {
    return $s . ' vs ' . $s;
  }

  public function prep_game_mode($m)
  {
    return $this->C_modes[$m];
  }

  public function prep_game_preset($p)
  {
    return $this->C_presets[$p];
  }

  public function prep_game_platform($p)
  {
    return $this->C_platforms[$p];
  }

  public function prep_server_region($r)
  {
    $array = array('EU' => 'Europe', 'AS' => 'Asia', 'US' => 'USA');
    return $array[$r];
  }

  public function prep_match_list($m1, $m2, $m3)
  {
    global $MAP_LIST;
    $maps = array();
    if ($m1 !== '') {
      $maps[$m1] = array(
        'name' => $MAP_LIST[$m1]['name'],
        'image' => $MAP_LIST[$m1]['img_wide'],
        'icon' => $MAP_LIST[$m1]['icon'],
      );
    }

    if ($m2 !== '') {
      $maps[$m2] = array(
        'name' => $MAP_LIST[$m2]['name'],
        'image' => $MAP_LIST[$m2]['img_wide'],
        'icon' => $MAP_LIST[$m2]['icon'],
      );
    }

    if ($m3 !== '') {
      $maps[$m3] = array(
        'name' => $MAP_LIST[$m3]['name'],
        'image' => $MAP_LIST[$m3]['img_wide'],
        'icon' => $MAP_LIST[$m3]['icon'],
      );
    }

    if (count($maps) === 0) {
      return false;
    } else {
      return $maps;
    }
  }

  public function generate_match_opponent($mid)
  {
    global $MYSQL, $COUNTRIES, $LOGGED;

    $q = $MYSQL->query(
      "SELECT from_clan_id FROM challenges WHERE match_id = {$mid} AND accepted = 1 LIMIT 0,1"
    );
    if (!$q) {
      redirectHTML('error/1');
    } elseif (mysqli_num_rows($q) < 1) {
      return '';
    }

    $clan_id = mysql_fetch_array($q);
    $clan_info = get_clan_info($clan_id['from_clan_id']);

    if ($clan_info !== false) {
      // generate html
      $HTML = '<div class="divider"><span>vs</span></div><!-- divider -->';
      $HTML .=
        '<div class="match-clan-card">
                                <div class="avatar">
                                    <img src="' .
        $clan_info['avatar'] .
        '" alt="no logo" />
                                </div>
                                <div class="match-clan-info">
                                    <div class="name">' .
        $clan_info['name'] .
        '</div>
                                    <div class="b-i"><span class="tag">[' .
        $clan_info['tag'] .
        ']</span> <span class="country"> <img src="img/flags/' .
        $clan_info['country'] .
        '.png" alt="' .
        $COUNTRIES[$clan_info['country']] .
        '"> ' .
        $COUNTRIES[$clan_info['country']] .
        '</span>';
      if ($LOGGED) {
        $HTML .=
          generate_info_btn($clan_info['id'], false) .
          generate_send_msg_btn($clan_info['id'], false);
      }

      $HTML .= '</div>
                        </div>
                        <div class="clear"></div><!-- clear -->
                    </div>';
      echo $HTML;
    }
  }

  //++++++++++++++++++++++++++ challenges ++++++++++++++++++++++++++//

  public function already_challenged($mid)
  {
    // true - if challenged
    // false - if not challenged

    global $MYSQL;

    $r = $MYSQL->query(
      " SELECT * FROM challenges WHERE match_id = {$mid} AND from_clan_id = {$_SESSION['id']} "
    );
    if (!$r) {
      redirectHTML('error/1');
    } else {
      return mysqli_num_rows($r) > 0 ? true : false;
    }
  }

  public function active_challenges()
  {
    global $MYSQL;

    $r = $MYSQL->query(
      " SELECT * FROM challenges WHERE from_clan_id = {$_SESSION['id']} "
    );
    if (!$r) {
      redirectHTML('error/1');
    } else {
      return mysqli_num_rows($r);
    }
  }

  public function create_challenge($mid)
  {
    global $MYSQL;

    // match info
    $temp = $this->get_match($mid);

    $r = $MYSQL->query("INSERT INTO challenges
                                                  (match_id,match_clan_id,match_clan_name,from_clan_id,from_clan_name)
                                                    VALUES ({$mid}, {$temp['clan_id']} , '{$temp['clan_name']}' ,{$_SESSION['id']},'{$_SESSION['name']}' )");
    if (!$r) {
      return false;
    } else {
      return true;
    }
  }

  public function challenge_status($mid, $html = false)
  {
    // challenge status (se sxesi me ton xristi)
    global $MYSQL;

    $r = $MYSQL->query("SELECT accepted,rejected FROM challenges WHERE match_id = {$mid}
                                                    AND from_clan_id = {$_SESSION['id']}");
    if (!$r) {
      redirectHTML('error/1');
    } else {
      $temp = mysql_fetch_array($r);
      if ($temp['accepted'] == 1) {
        if ($html) {
          echo '<span class="acc">ACCEPTED</span>';
        } else {
          return 'accepted';
        }
      } elseif ($temp['rejected'] == 1) {
        if ($html) {
          echo '<span class="rej">REJECTED</span>';
        } else {
          return 'rejected';
        }
      } else {
        if ($html) {
          echo '<span class="wait">WAITING</span>';
        } else {
          return 'waiting';
        }
      }
    }
  }

  public function check_if_accepted($mid)
  {
    global $MYSQL;

    $r = $MYSQL->query(
      "SELECT * FROM challenges WHERE match_id = {$mid} AND accepted = 1"
    );
    if (!$r) {
      redirectHTML('error/1');
    } else {
      return mysqli_num_rows($r) > 0 ? true : false;
    }
  }

  public function get_challenges($mid)
  {
    global $MYSQL;

    if ($this->check_if_accepted($mid)) {
      return true;
    }
    // if already accepted

    $array = array();
    $r = $MYSQL->query(
      "SELECT * FROM challenges WHERE match_id = {$mid} AND rejected = 0"
    );
    if (!$r) {
      redirectHTML('error/1');
    } else {
      while ($temp = mysql_fetch_array($r)) {
        $clan_info = $this->clan_info($temp['from_clan_id']);

        $array[$temp['from_clan_name']]['name'] = $temp['from_clan_name'];
        $array[$temp['from_clan_name']]['id'] = $temp['from_clan_id'];
        $array[$temp['from_clan_name']]['country'] = $clan_info['country'];
        $array[$temp['from_clan_name']]['tag'] = $clan_info['tag'];
        $array[$temp['from_clan_name']]['challenge'] = $temp['id'];
      }
      return $array;
    }
  }

  public function clear_challenges($mid)
  {
    global $MYSQL;

    $q = $MYSQL->query(
      "SELECT from_clan_id FROM challenges WHERE match_id = {$mid}"
    );
    if (!$q) {
      redirectHTML('error/1');
    }

    while ($notif_ar = mysql_fetch_array($q)) {
      add_notification(
        "<b>Match #{$mid}</b> deleted by <b>{$_SESSION['name']}</b>. Your challenge for <b>match #{$mid}</b> does no longer exist",
        $_SESSION['id'],
        $notif_ar['from_clan_id']
      );
    }

    $r = $MYSQL->query("DELETE FROM challenges WHERE match_id = {$mid}");
    if (!$r) {
      redirectHTML('error/1');
    }

    return true;
  }

  public function get_challenge_info($cid)
  {
    global $MYSQL;

    $q = $MYSQL->query("SELECT * FROM challenges WHERE id = {$cid}");
    if (!$q) {
      redirectHTML('error/1');
    } elseif (mysqli_num_rows($q) < 1) {
      redirectHTML('error/8');
    }

    return mysql_fetch_array($q);
  }

  public function reject_other_challenges_than($cid, $matchid)
  {
    // reject every challenge except $cid
    global $MYSQL;

    // get clan id of the rejected clans
    $q = $MYSQL->query(
      "SELECT from_clan_id FROM challenges WHERE id <> {$cid} AND match_id = {$matchid} AND rejected = 0"
    );
    if (!$q) {
      redirectHTML('error/1');
    }

    // reject challenges
    $r = $MYSQL->query(
      "UPDATE challenges SET rejected = 1 WHERE id <> {$cid} AND match_id = {$matchid} AND rejected = 0"
    );
    if (!$r) {
      redirectHTML('error/1');
    }

    // returns resource
    return $q;
  }

  //++++++++++++++++++++++++++ mymatches ++++++++++++++++++++++++++//

  public function get_number_of_matches($id)
  {
    global $MYSQL;

    $q = $MYSQL->query("SELECT id FROM matches WHERE clan_id = {$id}");
    if (!$q) {
      redirectHTML('error/1');
    }

    return mysqli_num_rows($q);
  }
}
