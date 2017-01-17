<?php
require('phpMQTT.php');
$boolean = false;
        $mqtt = new phpMQTT("146.87.2.99", 1883, "test");
        if (!$mqtt->connect()) { //connect to the server
            echo "connected";
            exit(1);
        }
         //currently subscribed topics
        $topics['/temp'] = array("qos" => 0, "function" => "procmsg");
        $mqtt->subscribe($topics, 0);

        while ($mqtt->proc()) {
        }

        $mqtt->close();


    function procmsg($topics, $msg) {
    echo $msg;

    }


