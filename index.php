<?php
// Calculate render time ------------------------
function utime()
{
  $time = explode(' ', microtime());
  $usec = (float) $time[0];
  $sec = (float) $time[1];
  return $sec + $usec;
}
$RENDER_START = utime();
//-----------------------------------------------

// start session
session_start();

// load important resourses
include 'includes/config.php';
include 'includes/mysql.php';
include 'includes/functions.php';
include 'includes/errosnredir.php';
include 'includes/validate.php';

// Mysql connect
$MYSQL = new Mysql();

// mode
$MODE = check_mode(_get('mode', 'start'));
$MODE_PARS = validate_parameters(mode_parameters($MODE));

// check if user is logged
$LOGGED = is_logged();
$USER = $LOGGED ? true : false;

// build the layout
include 'includes/init.php';

// Ending operations
$MYSQL->close();
