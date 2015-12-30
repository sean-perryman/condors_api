<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Condors API Test!</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="container">

<?php
	require('dblink.php');
	require('team_handler.php');
	require('schedule_handler.php');
?>
		  <section id="header">  
		    <h1>Condors API Test!</h1>

		    <p>This is a project to bring a mobile app for the AHL Bakersfield Condors to fruition.</p>
		    <p>All scores, schedules, and news are entered manually.</p>

		    <?php 
		    	$logo_query = "SELECT * FROM Teams ORDER BY name ASC";
			   	if ($header_result = mysqli_query( $link, $logo_query )) {
				  	
				  	while($row = mysqli_fetch_assoc($header_result)) {
				  		echo "<img class='team_logos' src='" . $row['logo'] . "'' />";
				  	}
				  }
		    ?>
		  </section>

	    <section id="team">
		    <!-- Teams Form -->
			  <div class="row">
			    <form method="post" enctype="multipart/form-data">
					  <div class="form-group">
					    <label for="teamCity">Team City</label>
					    <input type="text" class="form-control" name="teamCity" id="teamCity" placeholder="E.g. Bakersfield">
					  </div>
					  <div class="form-group">
					    <label for="teamName">Team Name</label>
					    <input type="text" class="form-control" name="teamName" id="teamName" placeholder="E.g. Condors">
					  </div>
					  <div class="form-group">
					    <label for="teamLogoFile">Team Logo</label>
					    <input type="file" name="teamLogoFile" id="teamLogoFile">
					  </div>
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</section>

			<section id="schedule">
				<!-- Schedule Form-->
				<div class="row">
					<form method="post">
						<div class="form-group">
					    <label for="homeTeam">Home Team</label>
					    <select class="form-control" id="homeTeam">
					    	<option>Click to select home team</option>
							  <?php
							  	$result = mysqli_query( $link, "SELECT name FROM Teams ORDER BY name ASC" );
							  	while ($row = mysqli_fetch_assoc($result)) {
							  		echo "<option>". $row['name'] . "</option>";
							  	}
							  ?>
					  	</select>
					  </div>
					  <div class="form-group">
					    <label for="awayTeam">Away Team</label>
					    <select class="form-control" id="awayTeam">
					    	<option>Click to select away team</option>
							  <?php
							  	$result = mysqli_query( $link, "SELECT name FROM Teams ORDER BY name ASC" );
							  	while ($row = mysqli_fetch_array($result)) {
							  		echo "<option>". $row['name'] . "</option>";
							  	}
							  ?>
					  	</select>
					  </div>
					  <div class="form-group">
					    <label for="gameDate">Game Date</label>
					    <input type="date" id="gameDate">
					  </div>
					  <div class="form-group">
					    <label for="gameTime">Game Time</label>
					    <input type="time" id="gameTime">
					  </div>
					  <div class="form-group">
					    <label for="homeScore">Home Score</label>
					    <input type="number" id="homeScore" placeholder="0">
					  </div>
					  <div class="form-group">
					    <label for="awayScore">Away Score</label>
					    <input type="number" id="awayScore" placeholder="0">
					  </div>

					  <!-- Date Picker Test -->
					  <p id="datepairExample">
					    <input type="text" class="date start" />
					    <input type="text" class="time start" /> to
					    <input type="text" class="time end" />
					    <input type="text" class="date end" />
						</p>

					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</section>

			<!-- News Form -->

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>	

	    <script type="text/javascript" src="datepair.js"></script>
			<script type="text/javascript" src="jquery.datepair.js"></script>
			<script>
		    // initialize input widgets first
		    $('#datepairExample .time').timepicker({
        	'showDuration': true,
	        'timeFormat': 'g:ia'
		    });

		    $('#datepairExample .date').datepicker({
        	'format': 'yyyy-m-d',
	        'autoclose': true
		    });

		    // initialize datepair
		    $('#datepairExample').datepair();
			</script>
	  </div>
  </body>
</html>