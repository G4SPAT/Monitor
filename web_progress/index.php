<?php
require_once('phpMQTT.php');
require_once('Dataset.php');
$view = new stdClass();
$view->pageTitle = 'Setpoint 1';
$dataset = new Dataset();
$newTemp = $_POST['newTemp1'];
$point = 'setpoint1';
$val = 0;
$newVal=0;
date_default_timezone_set('GMT');
if(isset($_POST['set1'])) {

    if ($newTemp >= 10 && $newTemp <= 35) {
        //echo 'You have selected ' . $point . ' and the temperature has been changed to ' . $newTemp;
        $mqtt = new phpMQTT("146.87.2.99", 1883, 60); //Change client name to something unique
        if ($mqtt->connect()) {
            $mqtt->publish("/g4/$point", "$newTemp");
            $mqtt->close();
            $newVal = $newTemp;
            //session_start();
            $_SESSION['newVal'] = $newVal;
        }
    }else {
            echo "Sorry, please choose a new temp between 10 and 35";
        }

}
$view->dataset = $dataset->fetchAllData();

if(isset($_POST['downloadBtn'])){

$dataset->createCSV();

}else{

}




//require_once('setpoint.phtml');
require_once('index.phtml');