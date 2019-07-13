<?php

if ($LOGGED) {
  redirectHTML('error/2');
} ?>


            <div id="main">
                <div class="mode-title">Login</div>

                <?php if (get_parameter('success') == 'error'): ?>

                <div id="notification" class="error" >

                    <?php display_msg('login', get_parameter('errorcode')); ?>

                </div>

                <?php elseif (get_parameter('success') == 'success'): ?>

                <div id="notification" class="success" >

                    <?php display_msg('login', 0); ?>

                </div>

                <?php endif; ?>

                <div id="form" class="login-form form">

                    <form action="/?mode=submitlogin" method="post">

                        <table id="l-f-table">
                            <tr>
                                <td class="label">Email :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="text" name="email" value="<?php get_parameter(
                                  'email',
                                  true
                                ); ?>"/></td>
                            </tr>
                            <tr>
                                <td class="label">Password :</td>
                            </tr>
                            <tr>
                                <td class="input"><input type="password" name="password" value="<?php get_parameter(
                                  'password',
                                  true
                                ); ?>"/></td>
                            </tr>
                            <tr>
                                <td><button>Submit</button></td>
                            </tr>
                        </table>

                    </form>

                </div>

            </div>