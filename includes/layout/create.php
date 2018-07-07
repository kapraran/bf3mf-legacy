
<div id="main">
    <div class="mode-title">Create a Match</div>


    <?php if (get_parameter('success') == 'error'): ?>

    <div id="notification" class="error" >

        <?php display_msg('create', get_parameter('errorcode'));?>

    </div>

    <?php elseif (get_parameter('success') == 'success'): ?>

    <div id="notification" class="success" >

        <?php display_msg('create', 0);?>

    </div>

    <?php endif;?>

    <form action="./submitcreate" method="post">

    <div class="whiteblock">

        <div class="setts-block time">
            <div class="title">TIME/REGION SETTINGS</div>

            <div class="label">Date/Time range</div>
                <div class="input">
                    <div class="inlabel">From</div> <select name="start_day">
                                 <option value="none">D</option>
                                 <?php for ($i = 1; $i <= 31; $i++): ?>
                                 <option value="<?php echo $i; ?>"><?php echo zero($i); ?></option>
                                 <?php endfor;?>
                             </select>
                             <select name="start_month">
                                 <option value="none">M</option>
                                 <?php for ($i = 1; $i <= 12; $i++): ?>
                                 <option value="<?php echo $i; ?>"><?php echo zero($i); ?></option>
                                 <?php endfor;?>
                             </select>
                             <select name="start_year">
                                 <option value="none">Y</option>
                                 <option value="2012">2012</option>
                                 <option value="2013">2013</option>
                             </select>
                             <select name="start_hour">
                                 <option value="none">Hr</option>
                                 <?php for ($i = 0; $i <= 23; $i++): ?>
                                 <option value="<?php echo $i; ?>"><?php echo zero($i); ?></option>
                                 <?php endfor;?>
                             </select> :
                             <select name="start_min">
                                 <option value="none">Mi</option>
                                 <?php for ($i = 0; $i <= 59; $i = $i + 5): ?>
                                 <option value="<?php echo $i; ?>"><?php echo zero($i); ?></option>
                                 <?php endfor;?>
                             </select>
                </div>

                <div class="input">
                    <div class="inlabel">Until</div> <select name="time_after">
                                 <option value="none">Hours after</option>
                                 <?php for ($i = 2; $i <= 12; $i++): ?>
                                 <option value="<?php echo $i; ?>"><?php echo zero($i); ?> hours after</option>
                                 <?php endfor;?>
                             </select>
                </div>

                <div class="divider"></div> <!-- divider -->

                <div class="label">Server region</div>
                <div class="input"><input type="radio" name="server_region" value="US" checked="checked"/> USA</div>
                <div class="input"><input type="radio" name="server_region" value="EU" /> Europe</div>
                <div class="input"><input type="radio" name="server_region" value="AS" /> Asia</div>

                <div class="divider"></div> <!-- divider -->

                <div class="label">Do you own a server?</div>
                <div class="input"><input type="radio" name="server_own" value="yes" checked="checked"/> Yes</div>
                <div class="input"><input type="radio" name="server_own" value="no" /> No</div>

                <div class="divider"></div> <!-- divider -->

                <div class="label">Enable Premium/DLC maps?</div>
                <div class="input"><input type="radio" name="dlc_own" value="yes" checked="checked"/> Yes</div>
                <div class="input"><input type="radio" name="dlc_own" value="no" /> No</div>

        </div>

        <div class="setts-block game">
            <div class="title">GAME SETTINGS</div>

            <div class="row">

                <div class="b3">

                    <div class="label">Preset</div>
                    <div class="input"><input type="radio" name="preset" value="no" checked="checked"/> Normal</div>
                    <div class="input"><input type="radio" name="preset" value="hc" /> Hardcore</div>
                    <div class="input"><input type="radio" name="preset" value="in" /> Infrantry</div>
                    <div class="input"><input type="radio" name="preset" value="cu" /> Custom</div>

                </div>
                <div class="b3">

                    <div class="label">Mode</div>
                    <div class="input"><input type="radio" name="mode" value="cq" checked="checked"/> Conquest</div>
                    <div class="input"><input type="radio" name="mode" value="rs" /> Rush</div>
                    <div class="input"><input type="radio" name="mode" value="sqrs" /> Squad rush</div>
                    <div class="input"><input type="radio" name="mode" value="tdm" /> Team Deathmatch</div>

                </div>
                <div class="b3">

                    <div class="label">Platform</div>
                    <div class="input"><input type="radio" name="platform" value="pc" checked="checked"/> PC</div>
                    <div class="input"><input type="radio" name="platform" value="ps3" /> PS3</div>
                    <div class="input"><input type="radio" name="platform" value="x360" /> XBOX 360</div>

                </div>

                <div class="clear"></div> <!-- clear -->
            </div>

            <div class="divider"></div> <!-- divider -->

            <div class="row">

                <div class="b3">
                    <div class="label">Team size</div>
                    <div class="input"><input type="radio" name="tsize" value="4" checked="checked"/> 4</div>
                    <div class="input"><input type="radio" name="tsize" value="8" /> 8</div>
                    <div class="input"><input type="radio" name="tsize" value="12" /> 12</div>
                </div>
                <div class="b3">
                    <div class="label">&nbsp;</div>
                    <div class="input"><input type="radio" name="tsize" value="16" /> 16</div>
                    <div class="input"><input type="radio" name="tsize" value="24" /> 24</div>
                    <div class="input"><input type="radio" name="tsize" value="32" /> 32</div>
                </div>

                <div class="clear"></div> <!-- clear -->
            </div>

            <div class="divider"></div> <!-- divider -->

            <?php

// generate map options html
$map_options = generate_map_options(false);

?>

            <div class="row">
                <div class="b3">
                    <div class="label">Recommend maps <span class="opt">(Optional)</span></div>
                    <div class="input">
                        <select name="map1">
                            <option value="none">Map 1</option>
                            <?php echo $map_options; ?>
                        </select>
                    </div>
                </div>
                <div class="b3">
                    <div class="label">&nbsp;</div>
                    <div class="input">
                        <select name="map2">
                            <option value="none">Map 2</option>
                            <?php echo $map_options; ?>
                        </select>
                    </div>
                </div>
                <div class="b3">
                    <div class="label">&nbsp;</div>
                    <div class="input">
                        <select name="map3">
                            <option value="none">Map 3</option>
                            <?php echo $map_options; ?>
                        </select>
                    </div>
                </div>

                <div class="clear"></div> <!-- clear -->
            </div>

            <div class="divider"></div><!-- divider -->

            <div class="row">
                <div class="label">Notes <span class="opt">(Optional)</span></div>
                <textarea name="notes" placeholder="Extra rules,banned weapons etc" class="nice-form" style="width:500px"></textarea>
            </div>

        </div>

        <div class="clear"></div> <!-- clear -->

        <button class="y-btn" style="margin: 20px 0 0">Submit</button>

    </div>


    <!-- HIDDEN FORM ELEMENTS -->
    <input type="hidden" name="secid" value="<?php echo $_SESSION['secid']; ?>" />
    </form>

</div>