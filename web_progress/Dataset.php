
<?php
require_once('Database.php');
require_once('phpMQTT.php');
require_once ('Data.php');
class Dataset {
    protected $_dbHandle, $_dbInstance;
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }
    public function fetchAllData() {
        $sqlQuery = 'SELECT * FROM AirTempMain LIMIT 5';
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new Data($row);
        }
        return $dataSet;
    }


    public function fetchLogs(){
        $sqlQuery = 'SELECT * FROM Logs';
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();
        $dataSet = [];
        while($row = $statement->fetch()){
            $dataSet[] = new Data($row);
        }

        return $dataSet;
    }

    public function pupolateLogs($userId, $temperatureValue, $setPointChanged){

        try {

            $sqlQuery = "INSERT INTO Logs (UserID, TemperatureValue, SetPointChanged)
            VALUES ($userId, $temperatureValue, $setPointChanged)";
            $statement = $this->_dbHandle->prepare($sqlQuery);
            $statement->execute($sqlQuery);
            echo "New record created successfully";
        }
        catch(PDOException $e)
        {
            echo $sqlQuery . "<br>" . $e->getMessage();
        }

        $statement = null;


    }

        public function setNewSetPointValue($point, $newValue){
            $mqtt = new phpMQTT("146.87.2.99", 1883, 60);
            if ($mqtt->connect()) { //connect to the server
                $mqtt->publish("/g4/$point", "$newValue"); //change setPoint to its new value
                $mqtt->close(); // close connection
            }
        }



    public function createCSV()
    {
        $sqlQuery = 'SELECT AirTempD_id from AirTempDay';

        try{
            $sqlQuery = $this->_dbHandle->prepare($sqlQuery);
            $sqlQuery->execute();
            $fileLocation = '/Users/Timea/Documents/';
            $fileName = "temp24SetPoint1-" . date('d.m.Y') . '.csv';
            $file_export = $fileLocation . $fileName;

            $data = fopen($file_export, 'w');

            $csv_fields = array();

            $csv_fields[] = 'Temp_id';
            $csv_fields[] = 'value';

            fputcsv($data, $csv_fields);

            while ($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($data, $row);
            }
        }
        catch (PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
        }
    }




















}