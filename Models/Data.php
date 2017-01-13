<?php

class Data {

    protected $_id, $_value ;//, $_lastName, $_courseID, $_international, $_photoName;

    public function __construct($dbRow) {
        $this->_id = $dbRow['Main_id'];
        $this->_value= $dbRow['TempMain_value'];
       // $this->_lastName = $dbRow['last_name'];
        //if ($dbRow['international']) $this->_international = 'yes'; else $this->_international = 'no';
        //$this->_courseID = $dbRow['courseID'];
    }

    public function getID() {
        return $this->_id;
    }

    public function getValue() {
        return $this->_value;
    }




}

