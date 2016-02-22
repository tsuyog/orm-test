<?php

class EntityGenerator
{
    var $envars = array();
    var $enclass = null;
    var $baseclass = 'Entity';
    var $pkeys = array();
    var $aikeys = array();
    var $tables = array();

    var $stag = "<?php";
    var $etag = "?>";
    var $tab = "\t";
    var $ds = "\$";
    var $nl = "\n";
    var $cbs = "{";
    var $cbe = "}";
    var $var = "var";

    function getEntity($table)
    {
        $dbo = Database::getInstance();
        $query = $this->prepareQuery($table);
        $dbo->executeQuery($query);
        $rows = $dbo->loadObjectList();
        $this->prepareEntity($rows);
        $this->enclass = $table;
        $code = $this->getCode();
        $this->createClassFile($code);
        $this->resetVariables();

    }
    protected function prepareQuery($table)
    {
        $query = "SHOW COLUMNS FROM $table";
        return $query;
    }
    function getAllEntities($dbname)
    {
        $dbo = Database::getInstance();
        $query = "SHOW TABLES";
        $dbo->executeQuery($query);
        $rows = $dbo->loadObjectList();
        $fieldname = 'Tables_in_'.$dbname;

        if (!empty($rows))
        {
            foreach ($rows as $row)
            {
                $this->getEntity($row[$fieldname]);

            }
        }
    }
    protected function prepareEntity($rows)
    {
        if (!empty($rows))
        {

            foreach ($rows as $row)
            {
                if($row['Extra'] == 'auto_increment')
                    array_push($this->aikeys, $row['Field']);
                if($row['Key'] == 'PRI')
                    array_push($this->pkeys, $row['Field']);
                array_push($this->envars, $row['Field']);
            }

        }
    }
    protected function getCode()
    {
        $code = $this->stag.$this->nl;
        $code .= $this->nl.$this->tab."class ".ucwords(strtolower($this->enclass))." extends ".$this->baseclass;
        $code .= $this->nl.$this->tab.$this->cbs.$this->nl;
        foreach ($this->envars as $envar)
        {
            $code .=$this->tab.$this->tab.$this->var." ".$this->ds.$envar." = null;".$this->nl;
        }
        $code .= $this->nl.$this->nl;
        $code .=$this->tab.$this->tab.$this->var." ".$this->ds."tablename"." = '".$this->enclass."';".$this->nl;
        $code .=$this->tab.$this->tab.$this->var." ".$this->ds."pkeys"." = array('".join("','",$this->pkeys)."');".$this->nl;
        $code .=$this->tab.$this->tab.$this->var." ".$this->ds."aikeys"." = array('".join("','",$this->aikeys)."');".$this->nl;
        $code .= $this->nl.$this->tab.$this->cbe.$this->nl;
        $code .= $this->nl.$this->etag.$this->nl;

        return $code;
    }
    protected function createClassFile($code)
    {
        $dirpath = '../entities';
        if(!is_dir($dirpath))
        {
            if(!mkdir($dirpath, 0777, true))
            {
                die("Failed to create directory...");
            }
        }
        $filename = "../entities/".$this->enclass.".php";
        if(!file_exists($filename))
        {
            $filehandler = fopen($filename, 'w');
            fwrite($filehandler, $code);
            fclose($filehandler);

        }
    }
    protected function resetVariables()
    {
        unset($this->envars);
        unset($this->pkeys);
        unset($this->aikeys);
        $this->enclass = null;

        $this->envars = array();
        $this->pkeys = array();
        $this->aikeys = array();
    }
}
