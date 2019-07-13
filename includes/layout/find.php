<div id="main">
  <div class="mode-title">Find a Match</div>


  <?php if (get_parameter('success') == 'error') : ?>

  <div id="notification" class="error">

    <?php display_msg('create', get_parameter('errorcode')); ?>

  </div>

  <?php elseif (get_parameter('success') == 'success') : ?>

  <div id="notification" class="success">

    <?php display_msg('create', 0); ?>

  </div>

  <?php endif; ?>

  <form action="/findresults" method="post">

    <div class="whiteblock">

      <div class="setts-block" style="float:none;min-height:175px">
        <div class="title">FILTERS</div>

        <div class="label">Date/Time range</div>
        <div class="input">
          <div class="inlabel">From</div> <select name="start_day">
            <option value="none">D</option>
            <?php for ($i = 1; $i <= 31; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select>
          <select name="start_month">
            <option value="none">M</option>
            <?php for ($i = 1; $i <= 12; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select>
          <select name="start_year">
            <option value="none">Y</option>
            <?php for ($y = 0; $y < 2; $y++): ?>
            <?php $year = intval(date('Y')) + $y; ?>
            <option value="<?php echo $year ?>"><?php echo $year ?></option>
            <?php endfor; ?>
          </select>
          <select name="start_hour">
            <option value="none">Hr</option>
            <?php for ($i = 0; $i <= 23; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select> :
          <select name="start_min">
            <option value="none">Mi</option>
            <?php for ($i = 0; $i <= 59; $i = $i + 5) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <div class="input">
          <div class="inlabel">Until</div> <select name="end_day">
            <option value="none">D</option>
            <?php for ($i = 1; $i <= 31; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero($i); ?></option>
            <?php endfor; ?>
          </select>
          <select name="end_month">
            <option value="none">M</option>
            <?php for ($i = 1; $i <= 12; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select>
          <select name="end_year">
            <option value="none">Y</option>
            <?php for ($y = 0; $y < 2; $y++) : ?>
            <?php $year = intval(date('Y')) + $y; ?>
            <option value="<?php echo $year ?>"><?php echo $year ?></option>
            <?php endfor; ?>
          </select>
          <select name="end_hour">
            <option value="none">Hr</option>
            <?php for ($i = 0; $i <= 23; $i++) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select> :
          <select name="end_min">
            <option value="none">Mi</option>
            <?php for ($i = 0; $i <= 59; $i = $i + 5) : ?>
            <option value="<?php echo $i; ?>"><?php echo zero(
                                                                    $i
                                                                ); ?></option>
            <?php endfor; ?>
          </select>
        </div>

        <div class="divider"></div> <!-- divider -->

        <table id="table-findmatch">
          <tr class="label">
            <td>Server region</td>
            <td>Mode</td>
            <td>Preset</td>
            <td>Platform</td>
            <td>Team size</td>
          </tr>
          <tr class="input">

            <td>
              <select name="server_region">
                <option value="all">All</option>
                <option value="US">USA</option>
                <option value="EU">Europe</option>
                <option value="AS">Asia</option>
              </select>
            </td>

            <td>
              <select name="mode">
                <option value="all">All</option>
                <option value="cq">Conquest</option>
                <option value="rs">Rush</option>
                <option value="sqrs">Squad rush</option>
                <option value="tdm">Team Deathmatch</option>
              </select>
            </td>

            <td>
              <select name="preset">
                <option value="all">All</option>
                <option value="no">Normal</option>
                <option value="hc">Hardcore</option>
                <option value="in">Infrantry</option>
                <option value="cu">Custom</option>
              </select>
            </td>

            <td>
              <select name="platform">
                <option value="all">All</option>
                <option value="pc">PC</option>
                <option value="ps3">PS3</option>
                <option value="x360">XBOX 360</option>
              </select>
            </td>

            <td>
              <select name="tsize">
                <option value="all">All</option>
                <option value="4">4</option>
                <option value="8">8</option>
                <option value="12">12</option>
                <option value="16">16</option>
                <option value="24">24</option>
                <option value="32">32</option>
              </select>
            </td>

          </tr>
        </table>

      </div>

      <div class="clear"></div> <!-- clear -->

      <button class="y-btn" style="margin: 20px 0 0">Submit</button>

    </div>


    <!-- HIDDEN FORM ELEMENTS -->
    <input type="hidden" name="secid" value="<?php echo $_SESSION['secid']; ?>" />
  </form>

</div>