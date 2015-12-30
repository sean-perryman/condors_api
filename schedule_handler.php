<?php
	if (isset($_POST['homeTeam']) &&
			isset($_POST['awayTeam']) &&
			isset($_POST['gameDate']) &&
			isset($_POST['gameTime']) &&
			isset($_POST['homeScore']) &&
			isset($_POST['awayScore']))
	{
		$homeTeam = mysqli_real_escape_string($link, $_POST['homeTeam']);
		$awayTeam = mysqli_real_escape_string($link, $_POST['awayTeam']);
		$gameDate = mysqli_real_escape_string($link, $_POST['gameDate']);
		$gameTime = mysqli_real_escape_string($link, $_POST['gameTime']);
		$homeScore = mysqli_real_escape_string($link, $_POST['homeScore']);
		$awayScore = mysqli_real_escape_string($link, $_POST['awayScore']);

		//Query for home team ID
		$home_query = "SELECT id FROM Teams WHERE name ='" . $homeTeam . "'";
		if ($home_result = mysqli_query($link, $home_query)) {
			while ($row = mysqli_fetch_assoc($home_result)) {
				$homeTeam = $row['id'];
			}
		} else die("Unable to pull home team id");

		//Query for away team ID
		$away_query = "SELECT id FROM Teams WHERE name ='" . $awayTeam . "'";
		if ($away_result = mysqli_query($link, $away_query)) {
			while ($row = mysqli_fetch_assoc($away_result)) {
				$awayTeam = $row['id'];
			}
		} else die("Unable to pull away team id");

		//Convert game time to 24h format
		$gameTime = date("H:i:s", strtotime($gameTime));

		$insert_query = "INSERT INTO Schedule 
										(home, away, game_date, game_time, home_score, away_score) VALUES 
										('" . $homeTeam . "', '" . $awayTeam . "', '" . $gameDate . "', '" . $gameTime . "', '" . $homeScore . "', '" . $awayScore . "')";
		
		echo( "Insert Query: " . $insert_query);								

		/*
		if ($result = mysqli_query($link, $insert_query)) echo "<div class=\"alert alert-success\" role=\"alert\">Success.</div>";
		else echo "<div class=\"alert alert-danger\" role=\"alert\">Failure.</div>";
		*/
	}
?>