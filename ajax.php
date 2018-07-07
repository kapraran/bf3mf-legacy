<?php
include 'includes/functions_ajax.php';
if (!isAjax()) {
    die('Error #1');
}

include 'includes/mysql.php';
$MYSQL = new Mysql();

$MODE = _get('mode', '');
$MODE_array = array('zero_index', 'clan', 'msg');
if (!array_search($MODE, $MODE_array)) {
    die('Error #2');
}

if ($MODE == 'clan') {
    $CID = _get('cid', 1);

    if (!is_numeric($CID)) {
        die('Error #3');
    } else {
        $CID = number_format($CID, 0);
    }

    $CLAN_info = get_clan_info($CID);

    $secid = _get('secid', false);
    if ($secid === false) {
        die('Error #6');
    }

} elseif ($MODE == 'msg') {
    $CID = _get('cid', 1);

    if (!is_numeric($CID)) {
        die('Error #3');
    } else {
        $CID = number_format($CID, 0);
    }

    $CLAN_info = get_clan_info($CID);

    $secid = _get('secid', false);
    if ($secid === false) {
        die('Error #6');
    }

}

?>

<?php if ($MODE == 'clan'): ?>

	<div id="ajax-c-i" style="width:470px;padding:20px;;font-family:arial,sans-serif">

		<div id="ajax-c-i-n-o" >

			<div id="ajax-c-i-avatar" style="float:left;padding-right:15px">
				<img src="<?php echo $CLAN_info['avatar']; ?>" height="90px" />
			</div>

			<div id="ajax-c-i-name-t-o-cont" style="float:left;padding:5px 0 0 0">
				<div id="ajax-c-i-name" style="color:#343434;font-size:24px;"><?php echo $CLAN_info['name']; ?></div>
				<div id="ajax-c-i-ri" style="color:#5C5C5C;font-size:14px" >
					[<?php echo $CLAN_info['tag']; ?>]
					<span class="ajax-country-i" style="margin-left:10px;"><img src="img/flags/<?php echo $CLAN_info['country']; ?>.png" /></span>
					<span class="ajax-country"><?php echo $COUNTRIES[$CLAN_info['country']]; ?></span>
					<span class="clan-profile-popup" data-plugin="jpopup" data-height="310" data-width="470" data-type="ajax" data-typevalue="ajax.php?mode=msg&cid=<?php echo $CID; ?>&secid=<?php echo $secid; ?>">send message</span>
				</div>
			</div>

			<div style="clear:both"></div><!-- clear -->
		</div>

		<div id="ajax-divi-der" style="margin:20px 0;height:1px;background:#f2f2f2;width:100%"></div>

		<table id="ajax-c-i">
			<tbody>

			<tr>
				<td style="padding:0 0 3px 0;color:#919191;font-size:12px;font-weight:bold">Presentation</td>
			</tr>
			<tr>
				<td style="font-size:15px;padding-bottom:12px">
				<?php echo $CLAN_info['coninfo']; ?>
				</td>
			</tr>
			<tr>
				<td style="padding:0 0 3px 0;color:#919191;font-size:12px;font-weight:bold">Battlelog</td>
			</tr>
			<tr>
				<td style="font-size:15px;padding-bottom:12px">
					<input style="margin:0;border:1px solid #E8E8E8;padding:4px 2px;font-size:15px;color:#343434;width:468px" type="text" readonly="readonly" value="<?php echo $CLAN_info['battlelog']; ?>" />
				</td>
			</tr>
			<tr>
				<td style="padding:0 0 3px 0;color:#919191;font-size:12px;font-weight:bold">Website</td>
			</tr>
			<tr>
				<td style="font-size:15px;padding-bottom:12px">
					<input style="margin:0;border:1px solid #E8E8E8;padding:4px 2px;font-size:15px;color:#343434;width:468px" type="text" readonly="readonly" value="<?php echo $CLAN_info['battlelog']; ?>" />
				</td>
			</tr>

			</tbody>
		</table>

	</div>

<?php elseif ($MODE == 'msg'): ?>
	<div id="ajax-send-m" style="font-family:Arial,sans-serif;padding:20px;width:430px">

		<!-- <form action="./submitmessage" method="post"> -->
		<table id="ajax-send-m-f">
			<tbody>
				<tr>
					<td style="font-weight:bold;font-size:12px;color:#919191;padding-bottom:2px">Send to</td>
				</tr>
				<tr>
					<td style="color:#1c1c1c;padding-bottom:5px">
						<?php echo $CLAN_info['name']; ?>
						<input type="hidden" name="clanid" value="<?php echo $CLAN_info['id']; ?>"/>
						<input type="hidden" name="secid" value="<?php echo $secid; ?>"/>
					</td>
				</tr>
				<tr>
					<td style="font-weight:bold;font-size:12px;color:#919191;padding-bottom:2px">Message</td>
				</tr>
				<tr>
					<td style="padding-bottom:5px">
						<textarea name="message" style="border:1px solid #ccc;font-family:arial;color:#1c1c1c;width:400px;height:150px;padding:5px;resize:none;font-size:14px;color:#343434"></textarea>
					</td>
				</tr>
				<tr>
					<td><button style="border-radius:3px;border:1px solid #FBBE29;background:#FCCF52;cursor:pointer;font-size:12px;font-weight:bold;margin:0;padding:3px 7px">Send message</button></td>
				</tr>
			</tbody>
		</table>
		<!-- </form> -->

		<script type="text/javascript">
			$('button').click(sendMsgAjax);
			function sendMsgAjax(){
				$.ajax({
					url : './submitmessage',
					type : 'post',
					data : 'clanid=<?php echo $CLAN_info['id']; ?>&secid=<?php echo $secid; ?>&message=' + $('textarea[name=message]').val(),
					success : function (d){
						if( $.trim(d) == 'sent' ){
							notif('Message sent!');
							jpopupHide();
						}else{
							notif('<b>Error: </b> Message did not sent!');
						}
					}
				});
			}
		</script>

	</div>
<?php endif;?>