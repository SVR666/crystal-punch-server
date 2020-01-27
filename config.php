<?php
//get environmental variable and connect to the DB
$conn = pg_connect(getenv("DATABASE_URL"));

//localhost
// $DB_HOST   = "localhost";
// $DB_USERNAME = "postgres";
// $DB_PASSWORD = "hell";
// $DB_DATABASE = "crystal";
// $conn = pg_connect("host=$DB_HOST dbname=$DB_DATABASE user=$DB_USERNAME password=$DB_PASSWORD");

if(!$conn){
	die("ERROR : " .  pg_last_error($conn) );
}
?>
