<?php
	require_once('dblink.php');

	$query = "SELECT * FROM Schedule 
						WHERE game_date
						BETWEEN '2015-09-01'
						AND '2016-08-01'
						ORDER BY game_date ASC";

	$result = mysqli_query( $query, $link );
	while ($row = mysqli_fetch_assoc($result)) {
		print_r(json_encode($row));
	}

	mysqli_close($link);
?>