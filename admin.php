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
	require_once('dblink.php');

	if (isset($_POST['teamCity']) &&
			isset($_POST['teamName']) &&
			isset($_FILES['teamLogoFile'])) 
	{
		//Replace all whitespace with _
		$city = preg_replace('/\s+/', '_', $city);
		$name = preg_replace('/\s+/', '_', $name);

		//Handle and bad stuff (hopefully, haha)
		$city = mysqli_real_escape_string($link, $_POST['teamCity']);
		$name = mysqli_real_escape_string($link, $_POST['teamName']);

		//Grab file extension of uploaded file
		$t_name = $_FILES["teamLogoFile"]["name"];
		$t_ext = end((explode(".", $t_name)));

		$target_dir = "teamLogos/";
		$target_file = $target_dir . basename($city . "-" . $name . "." . $t_ext);
		$uploadOk = 1;
	
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["teamLogoFile"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    }
		}

		if($t_ext != "jpg" &&
			 $t_ext != "png" &&
			 $t_ext != "jpeg" &&
			 $t_ext != "gif" ) 
		{
	    echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Sorry, only JPG, JPEG, PNG & GIF files are allowed. You uploaded a ". $t_ext . "</p></div>";
	    $uploadOk = 0;
		} 

		if ($uploadOk == 0) echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Sorry, your team logo was not uploaded. Please try again.</p></div>";
		else {
			if (move_uploaded_file($_FILES["teamLogoFile"]["tmp_name"], $target_file)) {
      	//File uploaded
    		$insert_query = "INSERT INTO Teams (city, name, logo) VALUES ('" . $city . "','" . $name . "','" . $target_file ."')";
    		if (mysqli_query($link, $insert_query)) {
    			echo "<div class=\"alert alert-success\" role=\"alert\"><p>Success.</p></div>";
    		}	else {
    			echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Failure.</p></div>";
    		}
    	} else {
        echo "<div class=\"alert alert-danger\" role=\"alert\"><p>Sorry, your logo could not be uploaded.</p></div>";
    	}
		}
	}
?>
		  <section id="header">  
		    <h1>Condors API Test!</h1>

		    <p>This is a project to bring a mobile app for the AHL Bakersfield Condors to fruition.</p>
		    <p>All scores, schedules, and news are entered manually.</p>

		    <?php 
			   	$header_result = mysqli_query( $link, "SELECT * FROM Teams ORDER BY name ASC" );
			  	
			  	while($row = mysql_fetch_assoc($header_result)) {
			  		echo "<img class='team_logos' src='." . $row['logo'] . "'' />";
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
							  	$ht_result = mysqli_query( $link, "SELECT name FROM Teams ORDER BY name ASC" );
							  	$ht_rows = mysqli_fetch_array($ht_result, MYSQLI_NUM);
							  	foreach ($ht_rows as $ht_row) {
							  		echo "<option>". $ht_row[0] . "</option>";
							  	}
							  ?>
					  	</select>
					  </div>
					  <div class="form-group">
					    <label for="awayTeam">Away Team</label>
					    <select class="form-control" id="awayTeam">
					    	<option>Click to select away team</option>
							  <?php
							  	$at_result = mysqli_query( $link, "SELECT name FROM Teams ORDER BY name ASC" );
							  	$at_rows = mysqli_fetch_array($at_result, MYSQLI_NUM);
							  	foreach ($at_rows as $at_row) {
							  		echo "<option>". $at_row[0] . "</option>";
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
					  <button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</section>

			<!-- News Form -->

	    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>	
	  </div>
  </body>
</html>