<?php

if ($LOGGED) {
    redirectHTML('error/2');
}

if (!$MYSQL->unique(get_parameter('email'), 'email') || !$MYSQL->unique(strtolower(get_parameter('clanname')), 'name_down')) {
    redirectHTML('register/error/7');
}

// check reCaptcha
$privatekey = "6LeAnNISAAAAAEEUE6FDRC4zBR-KudApmodkqlUp";
$resp = recaptcha_check_answer($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $MODE_PARS["recaptcha_challenge_field"],
    $MODE_PARS["recaptcha_response_field"]);

if (!$resp->is_valid) {
    redirectHTML('register/error/10');
}

$MODE_PARS['password'] = si_encrypt($MODE_PARS['password']);
$name_down = strtolower($MODE_PARS['clanname']);

$q = $MYSQL->query("INSERT INTO clans (name,name_down,tag,email,password,coninfo) VALUES ('{$MODE_PARS['clanname']}','$name_down','{$MODE_PARS['clantag']}','{$MODE_PARS['email']}','{$MODE_PARS['password']}','{$MODE_PARS['claninfo']}')");
if (!$q) {
    redirect('register', false, 1);
} else {
    redirect('register', true);
}
