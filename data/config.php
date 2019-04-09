<?php

	require_once('../common/connector/db_sqlite3.php');
	//require ("./TestPlan.db");
	
	// SQLite
	$dbtype = "SQLite3";
	//$res = new SQLite3(dirname(__FILE__)."/common/TestPlan.db");

    $res = new SQLite3('./TestPlan.db');


// PDO
	// $res = new PDO("mysql:host=localhost;dbname=scheduler", "root", "");
	// $dbtype = "PDO";

?>