<?php
	require_once('dblink.php');

	$query = "SELECT * FROM Schedule 
						WHERE `game_date`
						BETWEEN '2015-09-01'
						AND '2016-08-01'
						ORDER BY `game_date` ASC
						LIMIT 1";

	$result = mysqli_query( $query, $link );
	$rows = mysqli_fetch_array($result, MYSQLI_NUM);
	mysqli_close($link);

	foreach ($row in $rows) {
		print_r(json_encode($row));
	}
?>