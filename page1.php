<?php
require ('Models/Dataset.php');
$view = new stdClass();
$DataSet = new DataSet();
$view->DataSet = $DataSet->fetchAllData();
$view->pageTitle = 'Data values';

require_once('Views/page1.phtml');