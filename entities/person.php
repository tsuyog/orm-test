<?php

class Person extends Entity
{
    var $id = null;
    var $name = null;
    var $age = null;
    var $citizenship = null;


    var $tablename = 'person';
    var $pkeys = array('id');
    var $aikeys = array('id');

}

