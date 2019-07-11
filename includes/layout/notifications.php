<?php

// check current page
$CURRENT_PAGE = 1;
$temp_page = 0;
if (is_numeric(get_parameter('page'))) {
  $temp_page = number_format(get_parameter('page'), 0);
}

// get notifications
$query = "SELECT * FROM notifications WHERE to_id = {$_SESSION['id']}";
$q = $MYSQL->query($query);
if (!$q) {
  redirectHTML('error/1');
}

// calculate num of result pages
$rows = mysqli_num_rows($q);

if ($rows > 0) {
  $PAGES_SUM = number_format($rows / $NOTIFICATIONS_PER_PAGE, 0);
  $rem = $rows % $NOTIFICATIONS_PER_PAGE;
  $PAGES_SUM = $rem === 0 ? $PAGES_SUM : $PAGES_SUM + 1;

  // set current page
  if ($temp_page > 0 && $temp_page < $PAGES_SUM) {
    $CURRENT_PAGE = $temp_page;
  }

  // new query
  $query .=
    ' ORDER BY time DESC LIMIT ' .
    ($CURRENT_PAGE - 1) * $NOTIFICATIONS_PER_PAGE .
    ',' .
    $NOTIFICATIONS_PER_PAGE;
  $display_q = $MYSQL->query($query);
  if (!$display_q) {
    redirectHTML('error/1');
  }
}

// mark read helper
$MAX_ID = 0;
$MIN_ID = 0;
?>
<div id="main">
    <div class="mode-title">Notifications</div>

    <?php if ($rows > 0): ?>



            <table id="table-notifs">

                <tbody>
                    <tr class="head">
                        <td class="read center">New</td>
                        <td class="message">Content</td>
                        <td class="by center">sent by</td>
                        <td class="time center">Date/Time</td>
                    </tr>

                    <?php
                    while ($notifs = mysql_fetch_array($display_q)): ?>

                    <tr class="notif<?php echo $notifs['opened'] == 0
                      ? ' unread'
                      : ''; ?>"  >
                        <td class="read"><?php echo $notifs['opened'] == 0
                          ? '<div class="unread"></div>'
                          : ''; ?></td>
                        <td class="message"><?php echo htmlspecialchars_decode(
                          $notifs['content']
                        ); ?></td>
                        <td class="by"><?php echo $notifs['from_name']; ?></td>
                        <td class="time"><?php echo date(
                          'j F Y, H:i',
                          $notifs['time']
                        ); ?></td>
                    </tr>

                    <?php
                    $MIN_ID = $notifs['id'];
                    $MAX_ID = $MAX_ID === 0 ? $notifs['id'] : $MAX_ID;
                    endwhile;

                    notifications_mark_read($MAX_ID, $MIN_ID);
                    ?>

                </tbody>

            </table>



    <?php else: ?>

        <div style="padding:8px 0 15px;font-size:19px;text-align:center">There are no notifications for you</div>

    <?php endif; ?>

</div>