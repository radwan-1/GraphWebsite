<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// We are creating database
	$sql = "CREATE DATABASE IF NOT EXISTS db";

	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully<br>";
	} else {
	    echo "Error creating database: " . mysqli_error($conn) . "<br>";
	}

	$dbname = 'db';
	mysqli_select_db ( $conn , $dbname);

	if (!$conn) {
	    die("select db connection failed: " . mysqli_connect_error());
	}

	//create accelaration table --------------------------------------------------
	$sql = "CREATE TABLE IF NOT EXISTS `datasets` (
	  `oldYearData` VARCHAR(50) NOT NULL,
	  `newYearData` VARCHAR(50) NOT NULL,
	  `ID` INT NOT NULL AUTO_INCREMENT,
	  PRIMARY KEY (`ID`))";

	if(mysqli_query($conn, $sql)){
	    echo "Table accelaration created successfully<br>";
	} else {
	    echo "Error creating accelaration table: " . mysqli_error($conn). "<br>";
	}
			
	$query = "INSERT INTO datasets (oldYearData, newYearData) VALUES
	('1', '2'), ('4', '5') ,('3', '5'),('6', '7'),('2', '4'),('0', '3'),('3', '2')";
	
	$conn->query($query);
	mysqli_close($conn);
?>