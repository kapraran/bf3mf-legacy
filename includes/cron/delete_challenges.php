<?php

// Delete challenges when match has been deleted
//----------------------------------------------------

$dc = $MYSQL->query('DELETE FROM challenges
                       WHERE NOT EXISTS (
                            SELECT * FROM matches WHERE
                            id = challenges.match_id
                       )');
if (!$dc) {
  _log('Error: delete_challenges.php');
  die();
}
