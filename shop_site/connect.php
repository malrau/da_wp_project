<?php
	/*
	*** Script to perform connection to a MySQL server by retrieving data ***
	*** from '.ini' configuration file				      ***
	*/

	/* the following line allows me to report connection errors, otherwise
	   a blank page would occur in case of errors */
	mysqli_report(MYSQLI_REPORT_ERROR);

	/********************
	 ****** STEP 1 ******
	 ********************/
	# return settings from configuration file into an associative array
	$config = parse_ini_file('config.ini');

	/********************
	 ****** STEP 2 ******
	 ********************/
	/* get parameters to access MySQL from associative array and assign them
	   to PHP variables */
	$servername     = $config['servername'];
	$username 	= $config['username'];
	$password 	= $config['password'];
	$dbname 	= $config['dbname'];

	/********************
	 ****** STEP 3 ******
	 ********************/
	# create and check connection to MySQL by using the above defined PHP variables
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if(!$conn) {
		echo "<h4>Cannot connect to MySQL: </h4>" . mysqli_connect_error();
		echo "</br></br>";
		echo "<a href = '../index.php'><button>Back to the main page</button></a>";
		exit;
	} else {
		echo "<section id = 'products'>";
                if ($_SERVER['SCRIPT_FILENAME'] == '/var/www/html/marvel/marvel.php') {
                    echo "<h3>Marvel Comics</h3>";
                } elseif ($_SERVER['SCRIPT_FILENAME'] == '/var/www/html/dc/dc.php') {
                    echo "<h3>DC Comics</h3>";
                } elseif ($_SERVER['SCRIPT_FILENAME'] == '/var/www/html/bonelli/bonelli.php') {
                    echo "<h3>Sergio Bonelli Editore</h3>";
                }
	}

?>
