
<?php

$RENDER_END = utime();
$RENDER_DIF = $RENDER_END - $RENDER_START;

?>
        <div id="render-time" style="color:white;padding:10px 0 5px;font-size:11px"> Time to render <?php echo number_format($RENDER_DIF, 3); ?>s, <?php echo $MYSQL->queries; ?> queries in total</div>
        </div><!-- container -->

        <div id="feedback-btn" data-plugin="jpopup" data-height="250" data-width="400" data-type="ajax" data-typevalue="res/html/feedback.html" ></div>

        <!-- jpopup -->
        <div id="jpopup-ov" style="display:none"></div>
        <div id="jpopup-content" style="display:none">
            <div id="jpopup-content-handler">
                <div id="closebtn" title="Close this popup!"></div>
            </div>
            <div id="jpopup-content-raw">

            </div>
        </div>

        <!-- notifications -->
        <div id="jnotification">

        </div>

        <script type="text/javascript">
            var jp  = $('#jpopup-ov');
            var jpC = $('#jpopup-content');
            var jpR = $("#jpopup-content-raw");
            var jpH = $("#jpopup-content-handler");

            $('[data-plugin=jpopup]').live('click',function(){
                jpopupDisplay({
                    'height' 		: $(this).attr('data-height'),
                    'width'  		: $(this).attr('data-width'),
                    'type'      : $(this).attr('data-type'),
                    'typeValue' : $(this).attr('data-typevalue')
                });
            });

            jp.live('click',jpopupHide);
            $('#jpopup-content-handler #closebtn ').live('click',jpopupHide);

            function jpopupDisplay(g){
                jpopupHide();
                var def = {
                    'height'		: 'auto',
                    'width'  		: 'auto',
                    'type'   		: 'text',
                    'typeValue' : 'Example'
                }
                var opts = $.extend({},def,g);

                // display background
                jp.show();

                // insert content
                if( opts.type == 'text' ){
                    jpR.html(opts.typeValue);
                }else if( opts.type == 'ajax' ){
                    $.ajax({
                        url : opts.typeValue,
                        success : function( d ){
                            jpR.html(d);
                        }
                    })
                }else if( opts.type == 'div' ){
                    jpR.html( $( opts.typeValue ).html() );
                }

                // calculate dimensions
                if( opts.height == 'auto' ){
                    h = 0;
                }else{
                    h = parseFloat( opts.height );
                }

                if( opts.width == 'auto' ){
                    w = 0;
                }else{
                    w = parseFloat( opts.width );
                }

                // aply dimensions,margins
                jpC.css({
                    'width'				: w,
                    'height'			: h + 24, // 24px for the handler
                    'margin-left' : - ( (w/2) + 1 ),
                    'margin-top'  : - ( (h/2) + 1 )
                })

                // display jpopup
                jpC.fadeIn(300);

            }

            function jpopupHide(){
                jpR.html('');
                jpC.hide();
                jp.hide();
            }

            //---> Notifications
            var jnotif = $('#jnotification');
            var jnotif_int = setTimeout();
            function notif(msg){
                jnotif.html('').slideUp(350,function(){
                    clearTimeout(jnotif_int);
                    jnotif.html(msg);
                    showNotif();
                });
            }

            function showNotif(){
                jnotif.slideDown(350);
                jnotif_int = setTimeout(hideNotif,7000);
            }

            function hideNotif(){
                jnotif.html('').slideUp(350);
            }

        </script>
    </body>
</html>