<?php
	$link = mysqli_connect("localhost", "condors", "condors_mysql_password", "condors");
	if (!$link) die("<div class=\"alert alert-danger\" role=\"alert\"><p>Error connecting to database.</p></div>");
?>