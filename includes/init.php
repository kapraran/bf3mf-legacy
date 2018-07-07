<?php

$layout = true;
switch ($MODE) {
    case 'start':
        $load = 'start';
        break;

    case 'login':
        $load = 'login';
        break;

    case 'register':
        $load = 'register';
        break;

    case 'error':
        $load = 'error';
        break;

    case 'submitregister':
        $load = 'includes/submit/register.php';
        $layout = false;
        break;

    case 'submitlogin':
        $load = 'includes/submit/login.php';
        $layout = false;
        break;

    case 'logout':
        $load = 'includes/task/logout.php';
        $layout = false;
        break;

    case 'find':
        $load = 'find';
        break;

    case 'create':
        $load = 'create';
        break;

    case 'submitcreate':
        $load = 'includes/submit/create.php';
        $layout = false;
        break;

    case 'match':
        $load = 'match';
        break;

    case 'controlpanel':
        $load = 'controlpanel';
        break;

    case 'submitcontrolpanel':
        $load = 'includes/submit/controlpanel.php';
        $layout = false;
        break;

    case 'submitfind':
        $load = 'includes/submit/find.php';
        $layout = false;
        break;

    case 'findresults':
        $load = 'findresults';
        break;

    case 'challenge':
        $load = 'includes/submit/challenge.php';
        $layout = false;
        break;

    case 'notifications':
        $load = 'notifications';
        break;

    case 'deletematch':
        $load = 'includes/task/deletematch.php';
        $layout = false;
        break;

    case 'acceptchallenge':
        $load = 'includes/task/acceptchallenge.php';
        $layout = false;
        break;

    case 'declinechallenge':
        $load = 'includes/task/declinechallenge.php';
        $layout = false;
        break;

    case 'submitmessage':
        $load = 'includes/submit/message.php';
        $layout = false;
        break;

    case 'mymatches':
        $load = 'mymatches';
        break;

    default:
        $load = 'start';
        break;
}

load_includes($MODE);
login_needed($MODE, $LOGGED);

if ($layout) {
    // load the header
    include 'includes/layout/head.php';
    // load the body
    include 'includes/layout/' . $load . '.php';
    // load the footer
    include 'includes/layout/foot.php';
} else {
    include $load;
}
