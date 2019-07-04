<?php

function display_msg($type, $code = 1)
{
    if ($type == 'register') {

        switch ($code) {
            case 0:
                echo "Your registration completed successfully. You can now login";
                break;

            case 1:
                echo "There was a database error, please try again";
                break;

            case 2:
                echo "The email address you provided is not valid";
                break;

            case 3:
                echo "The password you provided is not valid. It must be between 6-20 ,only-latin, characters";
                break;

            case 4:
                echo "The passwords you provided do not match";
                break;

            case 5:
                echo "The Clan Tag you provided is not valid. It must be between 2-4 ,only-latin, characters";
                break;

            case 6:
                echo "The contact info you provided is not valid. It must be between 10-256 ,only-latin, characters";
                break;

            case 7:
                echo "The email or the Clan name you provided, is already in use";
                break;

            case 8:
                echo "The Clan name you provided, is not valid. It must be between 5-100 ,only-latin, characters";
                break;

            case 9:
                echo "reCaptcha fields are empty...";
                break;

            case 10:
                echo "reCaptcha validation failed. Are you sure a human? :P";
                break;
        }

    } elseif ($type == 'login') {

        switch ($code) {
            case 0:
                echo "Your are now logged in!";
                break;

            case 1:
                //echo "There was a database error, please try again";
                break;

            case 2:
                echo "The email address you provided is not valid";
                break;

            case 3:
                echo "The password you provided is not valid";
                break;

            case 4:
                echo "The email address you provided, does not match any email in our database";
                break;

            case 5:
                echo "The email address and the password do not match";
                break;

        }

    } elseif ($type == 'error') {

        switch ($code) {
            case 1:
                echo "There's a database error... please try again";
                break;

            case 2:
                echo "You have no access. You are already logged on";
                break;

            case 3:
                echo "You have no access. You need to login first";
                break;

            case 4:
                echo "The date you inserted is invalid";
                break;

            case 5:
                echo "Session error. Check if another user is logged in the same browser";
                break;

            case 6:
                echo "The given id does not exist";
                break;

            case 7:
                echo "The given id does not exist (clan)";
                break;

            case 8:
                echo "The given id does not exist (challenge)";
                break;
        }

    } elseif ($type == 'create') {

        switch ($code) {
            case 0:
                echo "Match created successfully";
                break;

            case 1:
                echo "Filter error : Server region";
                break;

            case 2:
                echo "Filter error : Day value";
                break;

            case 3:
                echo "Filter error : Month value";
                break;

            case 4:
                echo "Filter error : Year value";
                break;

            case 5:
                echo "Filter error : Hour value";
                break;

            case 6:
                echo "Filter error : Minute value";
                break;

            case 7:
                echo "Filter error : Time after value";
                break;

            case 8:
                echo "Filter error : 'Own server' question error ";
                break;

            case 9:
                echo "Filter error : 'Enable Premium/DLC' question error ";
                break;

            case 10:
                echo "Filter error : Invalid preset value";
                break;

            case 11:
                echo "Filter error : Invalid mode value";
                break;

            case 12:
                echo "Filter error : Invalid platform value";
                break;

            case 13:
                echo "Filter error : Invalid map name";
                break;

            case 14:
                echo "The Date/Time you gave as a starting point has already passed. Be aware, server's Date/Time values are in CET";
                break;

            case 15:
                echo "Filter error : Invalid team size value";
                break;

            case 16:
                echo "Error : 3 of your matches are still active. Wait until they expire or delete one";
                break;
        }

    } elseif ($type == 'controlpanel') {

        switch ($code) {

            case 0:
                echo "Your changes saved successfully";
                break;

            case 1:
                echo "The clan tag you provided is not valid";
                break;

            case 2:
                echo "The clan logo url you provided is not valid";
                break;

            case 3:
                echo "The battlelog url you provided is not valid";
                break;

            case 4:
                echo "The country code you provided does not exist";
                break;

        }

    } elseif ($type == 'match') {

        switch ($code) {

            case 0:
                echo "Challenge sent!";
                break;

            case 1:
                echo "This match is not available for challenges right now";
                break;

            case 2:
                echo "You can't challenge yourself...";
                break;

            case 3:
                echo "You already have sent a challenge for this match";
                break;

            case 4:
                echo "The mach id is not a valid number";
                break;

            case 5:
                echo "You have already accepted 10 challenges, try to delete some of them";
                break;

            case 6:
                echo "There was a Database error, try again in a minute";
                break;

            case 10:
                echo "You have no right to delete this match";
                break;

            case 11:
                //echo "The email address you provided, does not match any email in our database";
                break;

            case 12:
                echo "You have no access to decline this challenge";
                break;

            case 13:
                echo "You already have accepted/rejected this challenge";
                break;

            case 14:
                echo "You have no access to decline this challenge";
                break;

            case 15:
                echo "This challenge is not connected to the current match";
                break;

            case 16:
                echo "The opponent for this match has been decided";
                break;

            case 30:
                echo "Challenge declined!";
                break;

            case 40:
                echo 'Challenge accepted! <img src="http://i.imgur.com/cJjcH.png" height="25" /> ';
                break;
        }

    }
}

// Terminates the script
// and throws a custom 404 error page
function p404($msg = false, $title = false)
{
    $title = ($title === false) ? '404 error' : $title;
    $msg = ($msg === false) ? '404 error' : $msg;

    $html = "<html>
                        <head>
                            <title>{$title}</title>
                            <style type='text/css'>
                                h1 {
                                    font-family:arial;
                                    font-size:31px;
                                    color:#343434;
                                    padding:30px
                                }
                            </style>
                        </head>
                        <body>

                            <h1>{$msg}</h1>

                        </body>
                    </html>";
    die($html);
}

// stupid function i know!
function redirectAJAX($msg)
{
    die($msg);
}

function redirectHTML($link)
{
    global $DIR;

    $html = "<html>
                        <head>
                            <meta HTTP-EQUIV='REFRESH' content='0; url=/{$link}'>
                            <title>Redirecting...</title>
                            <style type='text/css'>
                                h1 {
                                    font-family:arial;
                                    font-size:12px;
                                    color:white;
                                    padding:30px
                                }
                            </style>
                        </head>
                        <body style='background:url(img/bg.jpg) center top black'>

                            <h1>Loading...</h1>
                            <script type='text/javascript'>
                                window.location = '/{$link}';
                            </script>
                        </body>
                    </html>";
    die($html);
}

function redirect($type, $success = true, $extra = 0)
{
    global $DIR;

    switch ($type) {
        case 'register':
            $redir = ($success) ? 'register/success' : 'register/error/' . $extra;
            header('Location: ' . $DIR . $redir);
            break;

        case 'login':
            $redir = ($success) ? 'login/success' : 'login/error/' . $extra;
            header('Location: ' . $DIR . $redir);
            break;

        default:
            break;
    }
}
