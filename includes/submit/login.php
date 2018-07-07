<?php

if ($LOGGED) {
    redirectHTML('error/2');
}

$q = $MYSQL->query("SELECT * FROM clans WHERE email = '{$MODE_PARS['email']}'");
if (!$q) {
    redirectHTML('error/1');
} elseif (mysql_num_rows($q) < 1) {
    redirectHTML('login/error/4');
} else {
    $ar = mysql_fetch_array($q);

    if ($ar['password'] === si_encrypt(get_parameter('password'))) {

        // Operations to login
        $_SESSION['user'] = $ar['email'];
        $_SESSION['id'] = $ar['id'];
        $_SESSION['name'] = $ar['name'];
        $_SESSION['rights'] = $ar['rights'];
        $_SESSION['tag'] = $ar['tag'];
        $_SESSION['avatar'] = $ar['avatar'];
        $_SESSION['country'] = $ar['country'];
        $_SESSION['secid'] = random_string();

        redirectHTML('');

    } else {
        redirectHTML('login/error/5');
    }

}
