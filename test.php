<?php 
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    $debug = true;
    $gameData;
    $gid;
    $pid;
    $gameFilePath;
    $error_msg = null;
    

    function writeGameFile($filename, $valueArray) {
        writeToLogWhenDebug('writing game file');
        if(file_exists($filename)) {
            writeToLog('File Found');
            if (is_writable($filename)) {
                writeToLog('File is writeable');
            }
            else {
                writeToLog('File not writeable');
            }
        }
        else {
            writeToLog('File Not Found');
        }
        
        
        $file = fopen($filename, 'w');
        foreach($valueArray as $x => $x_value) {
            writeToLogWhenDebug("writing $x_value to $x ...");
            $line = "$x = $x_value \n";
            fwrite($file, $line);
        }
        writeToLogWhenDebug('finished writing');
        
        fclose($file);
    }
    function readGameFile($filename) {
        writeToLogWhenDebug('reading game file');
        return parse_ini_file($filename);
    }
    function displayGameData() {
        global $gameData;
        /* Write Changes */
        foreach($gameData as $x => $x_value) {
            echo "$x = $x_value";            
            echo "<br>";
        }
    }
    function getGameId() {
        $gid = $_GET['gid'];
        if (! defined($gid) || $gid == null || $gid == '') {
            $gid = 'aAyugaL';
        }
        return $gid;
    }
    function getPlayerId() {
        $pid = $_GET['pid'];
        if (! defined($pid) || $pid == null || $pid == '') {
            $pid = -1;
        }
        return $pid;
    }
    
    $pid = getPlayerId();
    $gid = getGameId();
    $gameFilePath = "/home/nrylee1/public_html/Project2/games/$gid.game";
    writeToLogWhenDebug('attempting to read game file');
    $gameData = readGameFile($gameFilePath);
    /* Write Original */
    foreach($gameData as $x => $x_value) {
        writeToLogWhenDebug("PreGameData[$gid]: $x = $x_value");
    }

    if ($pid == $gameData['PlayersTurn']) {
        /* Start Changes */
        $playerBet = $_GET['playerBet'];
        writeToLogWhenDebug($playerBet);

        $playerBet = $playerBet;
        if ($playerBet != 0) {
            $gameData['PotPurse'] = $gameData['PotPurse'] + $playerBet;
            $gameData['Player1Purse'] = $gameData['Player1Purse'] - $playerBet;                                
        }
        
        
        writeToLogWhenDebug('attempting to write game file');
        writeGameFile($gameFilePath, $gameData);
    }
    else {
        $error_msg = "It's not your turn!";
    }
    

    displayGameData(); 

?>
