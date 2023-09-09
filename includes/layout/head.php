<?php

if ($LOGGED && $_SESSION['country'] == 'none') {
    $c_code = 'GR';
} elseif ($LOGGED) {
    var_dump($_SESSION);
    $c_code = $_SESSION['country'];
} ?>
<!DOCTYPE HTML>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Battlefield 3 : Quick match | Make your life in battlefield easier and funnier!</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Russo+One' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="/res/style.css" />
  <link rel="shortcut icon" href="/img/fav.png">
</head>

<body>
  <div id="container">

    <header>

      <div id="logo"><a href="/"></a></div>

    </header>

    <div id="banner-links">

      <div class="banner-cont">
        <div class="banner big">
          <div class="bg" style="background-image:url(/img/1.jpg)"></div>
          <div class="hl" style="background-image:url(/img/1t.png)"></div>

          <div class="title" style="right:0">Find a match</div>
          <a href="/find"></a>
        </div>
      </div>
      <div class="banner-cont">
        <div class="banner big">
          <div class="bg" style="background-image:url(/img/2.jpg)"></div>
          <div class="hl" style="background-image:url(/img/2t.png)"></div>

          <div class="title" style="right:0">Create a match</div>
          <a href="/create"></a>
        </div>
      </div>
      <div class="banner-cont last">

        <?php if ($LOGGED) : ?>

        <div class="banner big no-cur" style="background-image:url(/img/5.jpg)">

          <div id="b-i">

            <div id="avatar" style="background-image:url(<?php echo $_SESSION['avatar']; ?>)"></div>

            <div id="q-i">
              <div id="clan-name"><?php echo $_SESSION['name']; ?></div>
              <div id="clan-r-i">
                <span class="tag">[<?php echo $_SESSION['tag']; ?>]
                </span> 
                <span class="country"> <img src="img/flags/<?php echo $c_code; ?>.png"
                    title="<?php echo $COUNTRIES[$c_code]; ?>" /> <?php echo $COUNTRIES[$c_code]; ?></span>
              </div>
            </div>

            <div class="clear"></div>

          </div>

          <div class="clear"></div>

          <div id="menu">
            <div class="button">
              <a href="/controlpanel"></a>
            </div>
            <div class="button" style="background-position: -75px 0">
              <a href="/notifications"></a>
              <?php
                                $nav_notif_count = unread_notifications();
                                if ($nav_notif_count > 0) : ?>
              <div class="nav-notif-count"><?php echo $nav_notif_count; ?> new</div>
              <?php endif;
                                ?>
            </div>
            <div class="button" style="background-position: -150px 0">
              <a href="/mymatches"></a>
            </div>
            <div class="button" style="background-position: -225px 0">
              <a href="/logout"></a>
            </div>
          </div>

        </div>

        <?php else : ?>

        <div class="banner small top" style="background-image:url(/img/3.jpg)">
          <div class="title" style="bottom:0;right:0">Login</div>
          <a href="/?mode=login"></a>
        </div>
        <div class="banner small" style="background-image:url(/img/4.jpg)">
          <div class="title" style="bottom:0;right:0">Register</div>
          <a href="/?mode=register"></a>
        </div>

        <?php endif; ?>

      </div>

      <div class="clear"></div><!-- clear -->

    </div>