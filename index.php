<?php

include_once ('dal/database.php');
include_once ('orm/entity.php');
include_once ('config/db.config.php');
include_once ('entities/person.php');

$dbhostname = $db[$dbenv]['hostname'];
$dbusername = $db[$dbenv]['username'];
$dbpassword = $db[$dbenv]['password'];
$dbname     = $db[$dbenv]['database'];

$dbo = Database::getInstance();
$dbo->connect($dbhostname, $dbusername, $dbpassword, $dbname);

// Demo Inserting Data

$person = new Person();
$data = array('name'=>'Sam Worthington','age'=>'23','citizenship'=>'American');
$person->bind($data);
$person->add();

/*

// Demo Selecting

$person = new Person();
$person->age = '23';

$personlist = $person->loadMultiple();
foreach ($personlist as $person)
{
    echo "{$person->name} {$person->age} {$person->citizenship} \r\n";
}



 // Method chaining for selecting

$dbo->select('id','name','age')->from('person')->where('age=23')->limit(3)->result();
$personlist = $dbo->loadObjectList();
foreach ($personlist as $person)
{
    echo "{$person['name']} {$person['age']} {$person['id']} \r\n";
}

// For Updating
$person = new Person();
$person->age = '23';
$person->load();
$data = array('name'=>'Amy Jackson','age'=>'26','citizenship'=>'american');
$person->bind($data);
$person->update();

//For Deleting
$person = new Person();
$person->id = '2';
$person->remove();
*/

