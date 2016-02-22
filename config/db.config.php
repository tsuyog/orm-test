<?php
/* database configurations */


$dbenv = 'production';

//for production environment

$db['production']['hostname'] = 'localhost';
$db['production']['username'] = 'root';
$db['production']['password'] = 'root';
$db['production']['database'] = 'vanila';
$db['production']['dbdriver'] = 'mysql';

//for test environment

$db['test']['hostname'] = 'localhost';
$db['test']['username'] = 'root';
$db['test']['password'] = 'root';
$db['test']['database'] = 'vanila';
$db['test']['dbdriver'] = 'mysql';