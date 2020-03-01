<?php
//get environmental variable and connect to the DB
$conn = pg_connect(getenv("DATABASE_URL"));

if(!$conn)
{
	die("Connection fail");
}
?>
