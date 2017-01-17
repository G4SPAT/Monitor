<?php
class Data {
    protected $_id, $_value, $_time, $timeChanged, $setPointChanged, $temperatureValue, $userId ;//, $_lastName, $_courseID, $_international, $_photoName;
    public function __construct($dbRow) {
        $this->_id = $dbRow['AirTempM_id'];
        $this->_value= $dbRow['AirTempM_value'];
        $this->_time= $dbRow['Date_time'];
        $this->timeChanged = $dbRow['TimeChanged'];
        $this->setPointChanged = $dbRow['SetPointChanged'];
        $this->temperatureValue = $dbRow['TemperatureValue'];
        $this->userId = $dbRow['UserID'];

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

    public function getTime(){
        return $this->_time;
    }

    public function getTimeChanged(){
        return $this->timeChanged;
    }

    public function getSetPointChanged(){
        return $this->setPointChanged;
    }

    public function getTemperatureNewValue(){
        return $this->temperatureValue;
    }

    public function getUserId(){
        return $this->userId;
    }
}