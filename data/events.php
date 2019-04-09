<?php
	require_once('../common/connector/scheduler_connector.php');
	include('config.php');

	$scheduler = new schedulerConnector($res, $dbtype);
	$scheduler->render_table("events","id","start_date,end_date,text,subject");
?>