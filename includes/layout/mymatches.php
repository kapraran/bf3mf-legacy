<?php

$MATCH = new CMatch(); ?>
<div id="main">
    <div class="mode-title">My matches</div>

    <div class="whiteblock">


            <?php if ($MATCH->get_number_of_matches($_SESSION['id']) > 0): ?>

                <table class="mymatches-matches">
                    <tbody>

                        <tr class="white">
                            <td colspan="3" class="mm-title"> <a href="#">Match #1</a> </td>
                            <td rowspan="3" class="mm-ch-num"> <span>3</span> </td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Mode">M:</span> Conquest </td>
                            <td class="mm-i"> <span title="Preset">P:</span> Normal</td>
                            <td class="mm-i time"> <span title="From">from:</span> 17/6/12 20:00</td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Team size">S:</span> 12v12</td>
                            <td class="mm-i"> <span title="Platform">Pl:</span> PS3</td>
                            <td class="mm-i time"> <span title="To" style="padding-right:15px">to:</span> 17/6/12 22:00</td>
                        </tr>

                    </tbody>
                </table>

                <table class="mymatches-matches">
                    <tbody>

                        <tr class="white">
                            <td colspan="3" class="mm-title"> <a href="#">Match #1</a> </td>
                            <td rowspan="3" class="mm-ch-num"> <span>3</span> </td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Mode">M:</span> Conquest </td>
                            <td class="mm-i"> <span title="Preset">P:</span> Normal</td>
                            <td class="mm-i time"> <span title="From">from:</span> 17/6/12 20:00</td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Team size">S:</span> 12v12</td>
                            <td class="mm-i"> <span title="Platform">Pl:</span> PS3</td>
                            <td class="mm-i time"> <span title="To" style="padding-right:15px">to:</span> 17/6/12 22:00</td>
                        </tr>

                    </tbody>
                </table>

                <table class="mymatches-matches">
                    <tbody>

                        <tr class="white">
                            <td colspan="3" class="mm-title"> <a href="#">Match #1</a> </td>
                            <td rowspan="3" class="mm-ch-num"> <span>3</span> </td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Mode">M:</span> Conquest </td>
                            <td class="mm-i"> <span title="Preset">P:</span> Normal</td>
                            <td class="mm-i time"> <span title="From">from:</span> 17/6/12 20:00</td>
                        </tr>
                        <tr class="white">
                            <td class="mm-i"> <span title="Team size">S:</span> 12v12</td>
                            <td class="mm-i"> <span title="Platform">Pl:</span> PS3</td>
                            <td class="mm-i time"> <span title="To" style="padding-right:15px">to:</span> 17/6/12 22:00</td>
                        </tr>

                    </tbody>
                </table>

            <?php else: ?>
                You have no matches
            <?php endif; ?>



        <div class="clear"></div><!-- clear -->
    </div>

</div>