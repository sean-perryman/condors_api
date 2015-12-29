<?php
	require_once('dblink.php');

	$query = "SELECT * FROM Schedule 
						WHERE game_date >= CURDATE() 
						AND game_time > CURTIME() 
						ORDER BY game_date DESC
						LIMIT 1";

	$result = mysqli_query( $query, $link );
	$row = mysqli_fetch_array($result, MYSQLI_NUM);
	mysqli_close($link);

	if (isset($row[0]))	return json_encode($row[0]);
	else return "No results.";
?>