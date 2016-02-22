<?php

include_once ('../dal/database.php');
include_once ('../generator/entitygenerator.php');
include_once ('../config/db.config.php');


$dbhostname = $db[$dbenv]['hostname'];
$dbusername = $db[$dbenv]['username'];
$dbpassword = $db[$dbenv]['password'];
$dbname     = $db[$dbenv]['database'];

$dbo = Database::getInstance();
$dbo->connect($dbhostname, $dbusername, $dbpassword, $dbname);

$obj = new EntityGenerator();
$obj->getAllEntities($dbname);
