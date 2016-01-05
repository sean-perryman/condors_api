<?php
	require_once('dblink.php');
	$schedule = array();

	$query = "SELECT s.game_date, s.game_time, s.home_score, s.away_score, h.name, a.name 
						FROM Schedule AS s 
						INNER JOIN Teams h ON s.home=h.id 
						INNER JOIN Teams a ON s.away=a.id 
						WHERE s.game_date BETWEEN '2015-09-01' AND '2016-08-01' 
						ORDER BY game_date ASC";

	$result = mysqli_query( $link, $query );
	$i = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($schedule, $row);
		$i++;
	}

	print_r(json_encode($schedule));
	mysqli_close($link);
?>