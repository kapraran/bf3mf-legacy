<html>
	<head>
		<script type="text/javascript" src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>
	</head>
	<body style="margin:0">

		<div class="ready" style="height:30px;padding:10px;background:#f2f2f2">
			<button>Load</button> extra url <input type="text" id="extra" />
		</div>

		<div class="cont">

		</div>
		<script type="text/javascript">
			$('button').click(a);
			function a(){
				var r = $('#extra').val();
				$.ajax({
					url : 'ajax.php?' + r,
					success : function(d){
						$('.cont').html(d);
					}
				});
			}
		</script>
	</body>
</html>
