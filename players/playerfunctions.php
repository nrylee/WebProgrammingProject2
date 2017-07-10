<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    function getPlayerInfo($id) {
        $list = getUserList();
        return $list[$id];
    }

    function writePlayerFile($playerList) {
        writeToLogWhenDebug('writing player file');
        $filename = '/home/nrylee1/public_html/Project2/players/players.login';
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
        foreach($playerList as $player) {
            $line = $player['un'].' '.$player['pw'].' '.$player['avatar'].' '.$player['pface'];
            $line = trim($line)."\n";
            fwrite($file, $line);
        }
        writeToLogWhenDebug('finished writing');
        
        fclose($file);
    }

    function getUserList() {
        $userFile = fopen('/home/nrylee1/public_html/Project2/players/players.login', 'r');
        $list = array();
        $lineNum = 0;
        while(!feof($userFile)) {
            $data = explode(' ', fgets($userFile));
            $player;
            $player['id']=$lineNum;
            if(count($data)>0) {
                $player['un']=$data[0];
            }
            if(count($data)>1) {
                $player['pw']=$data[1];
            }
            if(count($data)>2) {
                $player['avatar']=$data[2];
            }
            if(count($data)>3) {
                $player['pface']=$data[3];
            }
            $list[$lineNum] = $player; 
            $lineNum++;
        }
        fclose($myfile);
        return $list;
    }
    function updatePlayerInfo($player) {
        $list = getUserList();
        if(empty($player['avatar'])) $player['avatar']='smallavatar.png';
        if(empty($player['pface'])) $player['pface']='smallavatar.png';
        $list[$player['id']] = $player;
        writePlayerFile($list);
        return $player;
    }

    /*
    session_start();
    $id = $_SESSION['pid'];
    $player = getPlayerInfo($id);
    $player['avatar'] = 'filename.jpg';
    updatePlayerInfo($player);

    //REDIRECTING
    header('pathtoredirect');
    */
?>