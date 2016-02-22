<?php

class Student extends Entity
{
    var $id = null;
    var $sno = null;
    var $name = null;
    var $address = null;


    var $tablename = 'student';
    var $pkeys = array('id','sno');
    var $aikeys = array('id');

}

