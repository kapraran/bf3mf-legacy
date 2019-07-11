<?php

$MATCH = new Match();
$clan_info = $MATCH->clan_info($_SESSION['id']);
?>

<div id="main">
    <div class="mode-title">Control Panel</div>

    <?php if (get_parameter('success') == 'error'): ?>

    <div id="notification" class="error" >

        <?php display_msg('controlpanel', get_parameter('errorcode')); ?>

    </div>

    <?php elseif (get_parameter('success') == 'success'): ?>

    <div id="notification" class="success" >

        <?php display_msg('controlpanel', 0); ?>

    </div>

    <?php endif; ?>

    <div class="whiteblock">

        <div class="match-info">

            <div class="match-info-block">
                <div class="title">Edit Settings</div>

                <form action="submitcontrolpanel" method="post">

                <table id="c-p-table">
                    <tbody>
                        <tr>
                            <td class="label">Clan tag</td>
                        </tr>
                        <tr>
                            <td class="input">
                                <input type="text" value="<?php echo $clan_info[
                                  'tag'
                                ]; ?>" name="clantag" class="nice-form" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Clan logo (url)</td>
                        </tr>
                        <tr>
                            <td class="input">
                                <input type="text" value="<?php echo $clan_info[
                                  'avatar'
                                ]; ?>" name="clanlogo" class="nice-form" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Battlelog platoon (url)</td>
                        </tr>
                        <tr>
                            <td class="input">
                                <input type="text" value="<?php echo $clan_info[
                                  'battlelog'
                                ]; ?>" name="battlelog" class="nice-form" />
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Country</td>
                        </tr>
                        <tr>
                            <td class="input">
                                <select name="country" class="nice-form">
                                    <option value="none">Select a country</option>
                                    <?php foreach (
                                      $COUNTRIES
                                      as $key => $country
                                    ): ?>
                                        <option value="<?php echo $key; ?>" <?php echo $key ==
$clan_info['country']
  ? ' selected="selected" '
  : ''; ?>><?php echo $country; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <button class="y-btn">Update Settings</button>
            <input type="hidden" name="secid" value="<?php echo $_SESSION[
              'secid'
            ]; ?>" />
            </form>

        </div>

        <div class="match-clan">



        </div>


        <div class="clear"></div><!-- divider -->
    </div>

</div>