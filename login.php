<?php 
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    function getUserList() {
        $userFile = fopen('/home/nrylee1/public_html/Project2/players/players.login', 'r');
        $list = array();
        $count = 0;
        while(!feof($userFile)) {
            $list[$count++] = explode(' ', fgets($userFile));
        }
        fclose($myfile);
        return $list;
    }
    writeToLogWhenDebug('Session root folder (' . $_SERVER['DOCUMENT_ROOT'] . ')');
    writeToLogWhenDebug('Loading login page');
    if(session_start()) {
        writeToLogWhenDebug('Session started successfully.');
    } else {
        writeToLogWhenDebug('Session failed to start.');                
    }
    $pid = $_SESSION['pid'];
    writeToLogWhenDebug("Login: current pid($pid)");
    if (isset($pid) && !empty($pid)) {
        writeToLogWhenDebug("Login: already logged in, redirecting to lobbies.php");
        header('Location: lobbies.php');
        return;
    }
    else {
        $un = $_POST['un'];
        $pw = $_POST['pw'];
        
        writeToLogWhenDebug("Login: attempted login with un: $un and pw: $pw");
        if ((isset($un) && !empty($un)) && (isset($pw) && !empty($pw))) {
            $users = getUserList();
            writeToLogWhenDebug("Login: searching through player list");
            $userfound = false;
            foreach ($users as $id => $info) {
                writeToLogWhenDebug("Login: Checking line $id: " . $info[0] . ':' . $info[1]);
                if (trim($info[0])==trim($un)) {
                    writeToLogWhenDebug("Login: matched username");
                    if(trim($info[1])==trim($pw)) {
                        writeToLogWhenDebug("Login: matched password");
                        $_SESSION['pid'] = (int)$id;
                        writeToLogWhenDebug("Login session assigned pid=$id, redirecting to lobbies.php");
                        $userfound = true;
                        $_SESSION['playerName'] = $info[0];
                        header('Location: lobbies.php');
                    }
                    else {
                        writeToLogWhenDebug("Login: password does not match " . $info[1]);
                        //Handle bad password
                    }
                    break;
                }
            }
            if( ! $userfound) {
                writeToLogWhenDebug("Login: login not found in list");
            }
        }
        else {
            writeToLogWhenDebug("Login: un or pw not set");
        }
    }
?>