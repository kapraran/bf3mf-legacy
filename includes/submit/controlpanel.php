<?php

$q = $MYSQL->query("UPDATE clans SET
                                                tag = '{$MODE_PARS['clantag']}',
                                                avatar = '{$MODE_PARS['clanlogo']}',
                                                battlelog = '{$MODE_PARS['battlelog']}',
                                                country = '{$MODE_PARS['country']}'
                                                WHERE id = {$_SESSION['id']}");
if (!$q) {
  redirectHTML('error/1');
} else {
  update_session();
  redirectHTML('controlpanel/success');
}
