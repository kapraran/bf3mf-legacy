<?php

$MATCH = new Match();
$match_info = $MATCH->get_match($MODE_PARS['id']);
$clan_info = $MATCH->clan_info($match_info['clan_id']);

// Game settings
$V_team_size = $MATCH->prep_team_size($match_info['tsize']);
$V_mode = $MATCH->prep_game_mode($match_info['mode']);
$V_preset = $MATCH->prep_game_preset($match_info['preset']);
$V_platform = $MATCH->prep_game_platform($match_info['platform']);
$V_maps_list = $MATCH->prep_match_list(
  $match_info['map1'],
  $match_info['map2'],
  $match_info['map3']
);

// Time/Region settings
$V_time_start = date('j F Y, H:i', $match_info['start_time']);
$V_time_end = date('j F Y, H:i', $match_info['end_time']);
$V_server_region = $MATCH->prep_server_region($match_info['server_region']);
$V_server_own = ucfirst($match_info['server_own']);
$V_premium = ucfirst($match_info['dlc_own']);
?>
<div id="main">
    <div class="mode-title">Match info</div>

    <?php if (get_parameter('success') == 'error'): ?>

    <div id="notification" class="error" >

        <?php display_msg('match', get_parameter('errorcode')); ?>

    </div>

    <?php elseif (get_parameter('success') == 'success'): ?>

    <div id="notification" class="success" >

        <?php display_msg(
          'match',
          get_parameter('errorcode') === '' ? 0 : get_parameter('errorcode')
        ); ?>

    </div>

    <?php endif; ?>

    <div class="whiteblock">

        <div class="match-info">

            <div class="match-info-block">
                <div class="title">Game settings</div>

                <table class="match-table">
                    <tbody>
                        <tr class="label">
                            <td>Team size</td>
                            <td>Mode</td>
                        </tr>
                        <tr class="values">
                            <td><?php echo $V_team_size; ?></td>
                            <td><?php echo $V_mode; ?></td>
                        </tr>
                        <tr class="label">
                            <td>Platform</td>
                            <td>Preset</td>
                        </tr>
                        <tr class="values">
                            <td><?php echo $V_platform; ?></td>
                            <td><?php echo $V_preset; ?></td>
                        </tr>
                        <tr class="label">
                            <td colspan="2">Notes</td>
                        </tr>
                        <tr class="values">
                            <td colspan="2">
                                <div class="match-notes">
                                    <?php echo strlen($match_info['notes']) > 0
                                      ? $match_info['notes']
                                      : 'There are no extra notes'; ?>
                                </div>
                            </td>
                        </tr>
                        <tr class="label">
                            <td colspan="2">Recommended maps</td>
                        </tr>
                        <tr class="values">
                            <td colspan="2">
                                <?php if ($V_maps_list === false): ?>
                                <div class="rec-map">
                                    <div class="no-map">No Recommendations...</div>
                                </div>
                                <?php else: ?>

                                    <?php foreach ($V_maps_list as $array): ?>
                                    <div class="rec-map">
                                        <div class="map-bg" style="background:url( <?php echo $array[
                                          'image'
                                        ]; ?> )"></div>
                                        <div class="map-name"><span><?php echo $array[
                                          'name'
                                        ]; ?></span></div>
                                    </div>
                                    <?php endforeach; ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>



            </div>

            <div class="match-info-block">
                <div class="title">TIME/REGION SETTINGS</div>

                <table class="match-table">
                    <tbody>
                        <tr class="label">
                            <td colspan="2">Team is available between <a href="res/tooltip/time_date.htm?width=280" class="jTip" id="one" name="Date/Time info:">?</a></td>
                        </tr>
                        <tr class="values">
                            <td><?php echo $V_time_start; ?></td>
                            <td><?php echo $V_time_end; ?></td>
                        </tr>
                        <tr class="label">
                            <td>Server region</td>
                            <td>Server Owner</td>
                        </tr>
                        <tr class="values">
                            <td><?php echo $V_server_region; ?></td>
                            <td><?php echo $V_server_own; ?></td>
                        </tr>
                        <tr class="label">
                            <td>Premium content enabled</td>
                            <td></td>
                        </tr>
                        <tr class="values">
                            <td><?php echo $V_premium; ?></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
        <div class="match-clan">

            <div class="match-clan-card">

                <div class="avatar">

                    <img src="<?php echo $clan_info[
                      'avatar'
                    ]; ?>" alt="no logo" />

                </div>

                <div class="match-clan-info">

                    <div class="name"><?php echo $clan_info['name']; ?></div>
                    <div class="b-i"><span class="tag">[<?php echo $clan_info[
                      'tag'
                    ]; ?>]</span> <span class="country"> <img src="img/flags/<?php echo $clan_info[
  'country'
]; ?>.png" alt="<?php echo $COUNTRIES[
  $clan_info['country']
]; ?>"> <?php echo $COUNTRIES[$clan_info['country']]; ?></span></div>

                </div>

                <div class="clear"></div><!-- clear -->
            </div>

            <div class="divider"></div><!-- divider -->

            <table id="clan-table">
                <tbody>
                    <tr>
                        <td class="label">Presentation</td>
                    </tr>
                    <tr>
                        <td class="value">
                            <?php
//echo htmlspecialchars($clan_info['coninfo']);
?>
                            <?php echo $clan_info['coninfo']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Battlelog url</td>
                    </tr>
                    <tr>
                        <td class="value">
                            <input type="text" readonly="readonly" value="<?php echo $clan_info[
                              'battlelog'
                            ]; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Website url</td>
                    </tr>
                    <tr>
                        <td class="value">
                            <input type="text" readonly="readonly" value="<?php echo $clan_info[
                              'battlelog'
                            ]; ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"><?php echo $LOGGED
                          ? 'Match tools'
                          : ''; ?></td>
                    </tr>
                    <tr>
                        <td class="value">
                            <?php if (
                              $LOGGED &&
                              $_SESSION['id'] == $clan_info['id']
                            ): ?>

                                <form action='/deletematch/<?php echo $MODE_PARS[
                                  'id'
                                ]; ?>' method="post" onsubmit="return conf()">
                                        <input type="hidden" name="secid" value="<?php echo $_SESSION[
                                          'secid'
                                        ]; ?>" />
                                        <button class="y-btn" style="margin:5px 0" >Delete Match</button>
                                </form>

                            <?php elseif ($LOGGED): ?>

                                <?php if (
                                  $MATCH->already_challenged($MODE_PARS['id'])
                                ): ?>

                                    <div class="td-row">
                                        <span class="text"><b>You already have sent a challenge for this match!</b></span>
                                    </div>
                                    <div class="td-row">
                                        <span class="text">Acceptance status: </span> <?php $MATCH->challenge_status(
                                          $MODE_PARS['id'],
                                          true
                                        ); ?>
                                    </div>

                                <?php else: ?>
                                    <form action='/challenge/<?php echo $MODE_PARS[
                                      'id'
                                    ]; ?>' method="post" onsubmit="return conf()">
                                        <input type="hidden" name="secid" value="<?php echo $_SESSION[
                                          'secid'
                                        ]; ?>" />
                                        <button class="y-btn" style="margin:5px 0 0">Send a challenge</button>
                                    </form>


                                <?php endif; ?>

                            <?php endif; ?>
                        </td>
                    </tr>

                    <?php if (
                      $LOGGED &&
                      $_SESSION['id'] == $clan_info['id']
                    ): ?>
                    <tr>
                        <td class="label">Challenges sent for this match</td>
                    </tr>
                    <tr>
                        <td>

                            <div class="match-info-block inside-td">

                                    <?php
                                    $challenge_list = $MATCH->get_challenges(
                                      $MODE_PARS['id']
                                    );
                                    if (
                                      !is_array($challenge_list) &&
                                      $challenge_list === true
                                    ) {
                                      $CHALLENGES_STATUS = 'accepted';
                                    } elseif (count($challenge_list) === 0) {
                                      $CHALLENGES_STATUS = 'nochallenges';
                                    } else {
                                      $CHALLENGES_STATUS = 'haschallenges';
                                    }
                                    ?>

                                     <?php if (
                                       $CHALLENGES_STATUS === 'accepted'
                                     ): ?>

                                             YOU HAVE ACCEPTED A CLAN TO PLAY THIS MATCH

                                     <?php elseif (
                                       $CHALLENGES_STATUS === 'nochallenges'
                                     ): ?>

                                            NO CHALLENGES SENT YET

                                     <?php else: ?>

                                             <table>
                                                <tbody>

                                                    <?php foreach (
                                                      $challenge_list
                                                      as $key => $chall_info
                                                    ): ?>

                                                        <tr>
                                                            <td class="clan">
                                                                <div class="name"><?php echo $chall_info[
                                                                  'name'
                                                                ]; ?></div>
                                                                <div class="info"><img src="img/flags/<?php echo $chall_info[
                                                                  'country'
                                                                ]; ?>.png" title=""> [<?php echo $chall_info[
  'tag'
]; ?>]</div>
                                                            </td>
                                                            <td class="accept">
                                                                <form method="post" action="/acceptchallenge/<?php echo $MODE_PARS[
                                                                  'id'
                                                                ]; ?>/<?php echo $chall_info[
  'challenge'
]; ?>" onsubmit="return conf()">
                                                                    <input type="hidden" name="secid" value="<?php echo $_SESSION[
                                                                      'secid'
                                                                    ]; ?>" />
                                                                    <button class="y-btn">Accept</button>
                                                                </form>
                                                            </td>
                                                            <td class="decline">
                                                                <form method="post" action="/declinechallenge/<?php echo $MODE_PARS[
                                                                  'id'
                                                                ]; ?>/<?php echo $chall_info[
  'challenge'
]; ?>" onsubmit="return conf()">
                                                                    <input type="hidden" name="secid" value="<?php echo $_SESSION[
                                                                      'secid'
                                                                    ]; ?>" />
                                                                    <button class="y-btn">Decline</button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>

                                                 </tbody>
                                             </table>

                                     <?php endif; ?>

                                </div>

                        </td>
                    </tr>
                    <?php endif; ?>

                </tbody>
            </table><!-- END OF CLAN INFO TABLE -->

            <?php // Generates the whole html!
// Generates the whole html!
?>$MATCH->generate_match_opponent($MODE_PARS['id']); ?>

        </div>

        <div class="clear"></div><!-- clear -->


    </div>

</div>


<script type="text/javascript" src="res/tooltip/js/jtip.js"></script>
<script type="text/javascript">
    var f = document;
  var head  = f.getElementsByTagName('head')[0];
  var link  = f.createElement('link');
  link.rel  = 'stylesheet';
  link.type = 'text/css';
  link.href = 'res/tooltip/css/global.css';
  head.appendChild(link);
</script>
<script type="text/javascript">
    function conf(){
        return confirm('Are you sure?');
    }
</script>

