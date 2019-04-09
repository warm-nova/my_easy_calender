<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/9
 * Time: 11:34
 */
require("codebase/connector/grid_connector.php");
require("codebase/connector/db_sqlite.php");
require_once("codebase/connector/scheduler_connector.php");
if (!$db = sqlite_open('TestPlan', 0777, $sqliteerror)) {
    die($sqliteerror);
}

//$gridConn = new GridConnector($db,"SQLite");

$schedulerConn = new SchedulerConnector($res,"SQLite");

$schedulerConn->render_table("events","id","start_date,end_date,text","subject")

?>