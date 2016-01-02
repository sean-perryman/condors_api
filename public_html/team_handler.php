<?php
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