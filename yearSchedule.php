<?php
	require_once('dblink.php');
	$schedule = array();
	$result = mysqli_query( $link, "SELECT * FROM Schedule WHERE game_date BETWEEN '2015-09-01'	AND '2016-08-01' ORDER BY game_date ASC" );
	$i = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($schedule, $row);
		$i++;
	}
	print_r(json_encode($schedule));
	mysqli_close($link);
?>