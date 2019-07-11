<?php

if ($LOGGED) {
  redirectHTML('error/2');
} ?>
            <div id="main">
                <div class="mode-title">Register</div>

                <?php if (get_parameter('success') == 'error'): ?>

                <div id="notification" class="error" >

                    <?php display_msg(
                      'register',
                      get_parameter('errorcode')
                    ); ?>

                </div>

                <?php elseif (get_parameter('success') == 'success'): ?>

                <div id="notification" class="success" >

                    <?php display_msg('register', 0); ?>

                </div>

                <?php endif; ?>

                <div id="form" class="login-form form">

                    <form action="/?mode=submitregister" method="post">

                        <table id="l-f-table">
                            <tr>
                                <td class="label">Email :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="text" name="email" required="required"/></td>
                            </tr>
                            <tr>
                                <td class="label">Password :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="password" name="password" required="required"/> <a href="/res/tooltip/register_password.htm?width=380" class="jTip" id="one" name="Password must follow these rules:">?</a></td>
                            </tr>
                            <tr>
                                <td class="label">Retype password :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="password" name="rpassword" required="required"/></td>
                            </tr>
                            <tr>
                                <td class="label">Clan name :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="text" name="clanname" required="required"/></td>
                            </tr>
                            <tr>
                                <td class="label">Clan tag :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="text" name="clantag" required="required"/></td>
                            </tr>
                            <tr>
                                <td class="label">Presentation :</td>
                            </tr>
                            <tr>
                                <td class="input"><textarea maxlength="256" required="required" name="claninfo" placeholder=""></textarea></td>
                            </tr>
                            <!-- <tr>
                                <td class="label">Are you a human?</td>
                            </tr> -->
                            <tr>
                                <td class="input">
                                    <?php
                                    $publickey =
                                      '6LeAnNISAAAAAAg_g-dram812VUe9Rr6s6rOr4tF';
                                    echo recaptcha_get_html($publickey);
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><button>Submit</button></td>
                            </tr>
                        </table>

                    </form>

                </div>

            </div>

            <script type="text/javascript" src="/res/tooltip/js/jtip.js"></script>
            <script type="text/javascript">
                var f = document;
            var head  = f.getElementsByTagName('head')[0];
            var link  = f.createElement('link');
            link.rel  = 'stylesheet';
            link.type = 'text/css';
            link.href = 'res/tooltip/css/global.css';
            head.appendChild(link);
            </script>