<?php
	require_once('dblink.php');
	$schedule = array();

	$query = "SELECT Schedule.home, Schedule.away, Schedule.game_date FROM Schedule AS s
						INNER JOIN Teams AS t ON s.home=t.id
						AND s.away=t.id						
						WHERE game_date BETWEEN '2015-09-01'
						AND '2016-08-01' 
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