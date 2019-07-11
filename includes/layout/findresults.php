<?php

$MATCH = new Match();
$start_time = $MATCH->is_real_time(
  $MODE_PARS['start_day'],
  $MODE_PARS['start_month'],
  $MODE_PARS['start_year'],
  $MODE_PARS['start_hour'],
  $MODE_PARS['start_min']
);
$end_time = $MATCH->is_real_time(
  $MODE_PARS['end_day'],
  $MODE_PARS['end_month'],
  $MODE_PARS['end_year'],
  $MODE_PARS['end_hour'],
  $MODE_PARS['end_min']
);
$time = time() + $TIME_MODIFIER * 3600;

if ($end_time < $start_time) {
  redirectHTML('find/error/10');
}

if ($time - 3600 > $start_time) {
  redirectHTML('find/error/8');
}

if ($end_time - $start_time > 259200 /* 72 hours in seconds */) {
  redirectHTML('find/error/9');
}

// Create query
$query = "SELECT * FROM matches WHERE active = 1 AND  ( ( start_time < {$end_time} AND start_time > {$start_time} ) OR ( end_time > {$start_time} AND end_time < {$end_time} ) )";

// server region
if ($MODE_PARS['server_region'] != 'all') {
  $query .= " AND server_region = '{$MODE_PARS['server_region']}' ";
}

// preset
if ($MODE_PARS['preset'] != 'all') {
  $query .= " AND preset = '{$MODE_PARS['preset']}' ";
}

// mode
if ($MODE_PARS['mode'] != 'all') {
  $query .= " AND mode = '{$MODE_PARS['mode']}' ";
}

// platform
if ($MODE_PARS['platform'] != 'all') {
  $query .= " AND platform = '{$MODE_PARS['platform']}' ";
}

// team size
if ($MODE_PARS['tsize'] != 'all') {
  $query .= " AND tsize = {$MODE_PARS['tsize']} ";
}

// Run query
$result = $MYSQL->query($query);

if (!$result) {
  redirectHTML('error/1');
}

// Show results
$P_start_time = date('j F Y, H:i', $start_time);
$P_end_time = date('j F Y, H:i', $end_time);
$P_server_region =
  $MODE_PARS['server_region'] !== 'all'
    ? $MATCH->prep_server_region($MODE_PARS['server_region'])
    : 'All';
$P_mode =
  $MODE_PARS['mode'] !== 'all'
    ? $MATCH->prep_game_mode($MODE_PARS['mode'])
    : 'All';
$P_preset =
  $MODE_PARS['preset'] !== 'all'
    ? $MATCH->prep_game_preset($MODE_PARS['preset'])
    : 'All';
$P_size =
  $MODE_PARS['tsize'] !== 'all'
    ? $MATCH->prep_team_size($MODE_PARS['tsize'])
    : 'All';
$P_platform =
  $MODE_PARS['platform'] !== 'all'
    ? $MATCH->prep_game_platform($MODE_PARS['platform'])
    : 'All';

$M_num_mysql_results = mysqli_num_rows($result);

// If has results
if ($M_num_mysql_results > 0) {
  $pags = number_format($M_num_mysql_results / $MATCHES_PER_PAGE, 0);
  $rem = $M_num_mysql_results % $MATCHES_PER_PAGE;
  $M_pages_sum = $rem === 0 ? $pags : $pags + 1;

  $get_page = get_parameter('page');
  if ($get_page === '' || !is_numeric($get_page)) {
    $M_current_page = 1;
  } else {
    $get_page = number_format($get_page, 0);
    $M_current_page =
      ($get_page > 0) & ($get_page <= $M_pages_sum) ? $get_page : 1;
  }

  // Create query (final)
  $query .=
    ' ORDER BY start_time ASC LIMIT ' .
    ($M_current_page - 1) * $MATCHES_PER_PAGE .
    ',' .
    $MATCHES_PER_PAGE;

  // Run query (final)
  $results_display = $MYSQL->query($query);

  if (!$results_display) {
    redirectHTML('error/1');
  }
}
?>
<div id="main">
    <div class="mode-title">Match results</div>

    <div class="whiteblock">

        <div class="setts-block" style="float:none;min-height:145px">
            <div class="title">FILTERS</div>

                <div class="label">Date/Time range</div>
                <div class="input">
                    <div class="inlabel">From</div>
                    <span class="results-time"><?php echo $P_start_time; ?></span>
                </div>
                <div class="input">
                    <div class="inlabel">Until</div>
                    <span class="results-time"><?php echo $P_end_time; ?></span>
                </div>

                <div class="divider"></div> <!-- divider -->

                <table id="table-findmatch">
                    <tbody>
                        <tr class="label">
                            <td>Server region</td>
                            <td>Mode</td>
                            <td>Preset</td>
                            <td>Platform</td>
                            <td>Team size</td>
                        </tr>
                        <tr class="input results">

                            <td>
                                <?php echo $P_server_region; ?>
                            </td>

                            <td>
                                <?php echo $P_mode; ?>
                            </td>

                            <td>
                                <?php echo $P_preset; ?>
                            </td>

                            <td>
                                <?php echo $P_platform; ?>
                            </td>

                            <td>
                                <?php echo $P_size; ?>
                            </td>

                        </tr>
                    </tbody>
                </table>

        </div>

    </div>

    <div style="margin-top:20px">

        <?php if ($M_num_mysql_results === 0): ?>

            <div id="no-results">
                No matches found...
            </div>

        <?php else: ?>

            <div id="match-results" style="margin-bottom: 15px">
                <div id="result_count"><?php echo $M_num_mysql_results; ?> results found</div>

                <table id="match_results">

                    <tbody>

                    <tr class="head">
                        <td title="Platform" class="pl" >Pla.</td>
                        <td title="Clan info" colspan='2' ></td>
                        <td title="Server Region" class="sr">S.R.</td>
                        <td title="Mode" class="mode">Mode</td>
                        <td title="Preset" class="preset">Preset</td>
                        <td title="Team size" class="ts">Team size</td>
                        <td title="Date/Time range" class="dt">Date/Time range</td>
                        <td title="Recommended maps" class="rm">Recommended maps</td>
                        <td title="More info" class="mi"></td>
                    </tr>

                    <?php while (
                      $match_info = mysqli_fetch_array($results_display)
                    ):
                      $this_match_clan = $MATCH->clan_info(
                        $match_info['clan_id']
                      ); ?>

                        <tr class="res" data-id="<?php echo '\/match\/' .
                          $match_info[
                            'id'
                          ]; ?>" onclick="//link('<?php echo '\/match\/' .
  $match_info['id']; ?>')">

                            <td class="center"><?php echo strtoupper(
                              $match_info['platform']
                            ); ?></td>
                            <td class="clan"><img src="<?php echo $this_match_clan[
                              'avatar'
                            ]; ?>" style="width:42px;height:42px;background:#f2f2f2;border:none" /></td>
                            <td class="td-clan">
                                <div id="td-clan">
                                    <div class="td-clan-name"><?php echo $match_info[
                                      'clan_name'
                                    ]; ?></div>
                                    <div class="td-clan-info">
                                        <img style="position:relative;top:1px" src="img/flags/<?php echo $this_match_clan[
                                          'country'
                                        ]; ?>.png" alt="" />
                                        <span class="td-clan-tag">[<?php echo $this_match_clan[
                                          'tag'
                                        ]; ?>]</span>
                                        <?php if (
                                          $LOGGED &&
                                          $this_match_clan['id'] !=
                                            $_SESSION['id']
                                        ): ?>
                                        <span class="td-clan-interact">
                                            <?php
                                            generate_info_btn(
                                              $this_match_clan['id']
                                            );
                                            generate_send_msg_btn(
                                              $this_match_clan['id']
                                            );
                                            ?>
                                        </span>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="center" title="<?php echo $MATCH->prep_server_region(
                          $match_info['server_region']
                        ); ?>"><?php echo strtoupper(
  $match_info['server_region']
); ?></td>
                        <td class="center"><?php echo $MATCH->prep_game_mode(
                          $match_info['mode']
                        ); ?></td>
                        <td class="center"><?php echo $MATCH->prep_game_preset(
                          $match_info['preset']
                        ); ?></td>
                        <td class="center"><?php echo $MATCH->prep_team_size(
                          $match_info['tsize']
                        ); ?></td>
                        <td class="center" style="text-align:left">
                            <div id="td-time">
                                <div><span>from:</span> <b><?php echo date(
                                  'j F Y, H:i',
                                  $match_info['start_time']
                                ); ?></b></div>
                                <div><span>until:</span> <b><?php echo date(
                                  'j F Y, H:i',
                                  $match_info['end_time']
                                ); ?></b></div>
                            </div>
                        </td>
                        <td class="center">
                            <?php
                            $maps_list_icon = $MATCH->prep_match_list(
                              $match_info['map1'],
                              $match_info['map2'],
                              $match_info['map3']
                            );
                            if (
                              !is_array($maps_list_icon) &&
                              $maps_list_icon === false
                            ): ?>
                                NONE
                            <?php else: ?>

                                <?php foreach ($maps_list_icon as $this_map): ?>

                                    <img title="<?php echo $this_map[
                                      'name'
                                    ]; ?>" src="<?php echo $this_map[
  'icon'
]; ?>" height="25px"/>

                                <?php endforeach; ?>

                            <?php endif;
                            ?>
                        </td>
                        <td title="More info"> <img src="img/moreinfo.png" width="20px" alt="" /> </td>

                    </tr>

                    <?php
                    endwhile; ?>

                    </tbody>

                </table>


                <?php if ($M_num_mysql_results > 10): ?>

                    <div id="pagination">

                        <form action="./findresults" id="pagination_form" method="post">
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'start_day'
                            ]; ?>" name="start_day" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'start_month'
                            ]; ?>" name="start_month" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'start_year'
                            ]; ?>" name="start_year" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'start_hour'
                            ]; ?>" name="start_hour" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'start_min'
                            ]; ?>" name="start_min" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'end_day'
                            ]; ?>" name="end_day" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'end_month'
                            ]; ?>" name="end_month" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'end_year'
                            ]; ?>" name="end_year" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'end_hour'
                            ]; ?>" name="end_hour" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'end_min'
                            ]; ?>" name="end_min" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'server_region'
                            ]; ?>" name="server_region" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'preset'
                            ]; ?>" name="preset" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'mode'
                            ]; ?>" name="mode" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'platform'
                            ]; ?>" name="platform" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'tsize'
                            ]; ?>" name="tsize" />
                            <input type="hidden" value="<?php echo $MODE_PARS[
                              'secid'
                            ]; ?>" name="secid" />
                    <?php
                    $pagination_order = get_pagination_rules(
                      $M_pages_sum,
                      $M_current_page
                    );

                    $previous_page = 0;
                    foreach ($pagination_order as $number): ?>

                            <?php
                            if ($number !== $previous_page + 1): ?>

                                <span class="divider">..</span>

                            <?php endif;
                            $previous_page = $number;
                            ?>

                                <button <?php echo $M_current_page == $number
                                  ? 'class="active" onclick="return false" '
                                  : ' onclick="before_submit(' .
                                    $number .
                                    ')" '; ?> ><?php echo $number; ?></button>

                    <?php endforeach;
                    ?>

                        </form><!-- pagination_form -->
                    </div>

                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<script type="text/javascript">

    function link(l){
        window.open(l,'_newtab');
    }
    function before_submit(n){
        var form = document.getElementById("pagination_form");
        form.setAttribute('action','./findresults/' + n);
        return true;
    }

    var can_click = true;
    $(document).ready(function(){
        $('tr.res').click(function(){
            if(can_click)
                link($(this).attr('data-id'));
        });
        $('span.td-clan-interact').hover(function(){
            can_click = false;
        },function(){
            can_click = true;
        });
    });

</script>

