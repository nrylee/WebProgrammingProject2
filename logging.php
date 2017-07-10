<?php 
    $debug = true;
    function writeToLog($message) {
        $logPath = '/home/nrylee1/public_html/Project2/log.log';
        $log = fopen($logPath, 'a');
        fwrite($log, '[' . date('Y.m.d H:i:s') . "]   $message\n");
        fclose($log);
    }
    function writeToLogWhenDebug($message) {
        global $debug;        
        if($debug) {
            writeToLog($message);
        }
    }
?>