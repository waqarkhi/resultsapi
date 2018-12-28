<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<ul class="list-group" id="res">
					<li class="list-group-item">
						<form method="post">
							<div class="form-group">
								<label>Roll Number</label>
								<input class="form-control" type="text" name="num" placeholder="Enter here...">
							</div>
								<button type="submit" class="btn btn-success btn-block">Get Result</button>
						</form>
					</li>
				</ul>
				<div id="showRes">
					<table class="table table-striped"></table>					
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	var msg = '<div id="msg"></div>';
	$('#showRes').before(msg);
	$('#showRes').before('<h1 id="loader"></h1>');
	$('#res form').on('submit', function () {
		$('#loader').html('Searching...');
		$('#showRes table').html('');
		$('#msg').html('');
		var input = $('input[name="num"]');
		var roll = input.val();
		if (roll == '') {
			alert('Please Enter Roll Number');
		} else {
			$.ajax({
				url: '<?= base_url();?>find/biek/?r='+roll,
				type: 'get',
				success: function (data) {
					console.log(data);
					setTimeout(function () {
						if (data != null) {
							var table = $('#showRes table');
							var tbody = '<tbody><tr id="roll"><td>Roll Number</td><th><strong></strong></th></tr>'
								+'<tr id="total_marks"><td>Total Marks:</td><th><strong></strong></th></tr>'
								+'<tr id="obtained_marks"><td>Marks Secured:</td><th><strong></strong></th></tr>'
								+'<tr id="percentage"><td>Percent</td><th><strong></strong></th></tr>'
								+'<tr id="grade"><td>Grade</td><th><strong></strong></th></tr>'
								+'<tr id="cleared"><td>Cleared</td><th><strong></strong></th></tr></tbody>';
							table.html(tbody);
							table.show();
							input.val('');

							if( data.grade == "") { $('#grade').remove();}
							if( data.cleared == "") { $('#cleared').remove(); }

							$("#roll strong").html(data.roll);
							$("#total_marks strong").html(data.total_marks);
							$("#obtained_marks strong").html(data.obtained_marks);
							$("#percentage strong").html(data.percentage);
							$("#grade strong").html(data.grade);
							$("#cleared strong").html(data.cleared);

						} else {
							$('#msg').html('<p class="alert alert-danger">Result Not Found!</p>');
						}
						$('#loader').html('');
					}, 2000)
				}
			})

		}
		return false;
	})
</script>
</body>
</html>
