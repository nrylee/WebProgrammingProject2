<?php 
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    require_once '/home/nrylee1/public_html/Project2/players/playerfunctions.php';
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
            writeToLogWhenDebug('Login: Checking '.count($users).' Total Users');
            foreach ($users as $user) {
                writeToLogWhenDebug("Login: Checking user: " . $user['id'] . ' un:' . $user['un']);
                if (trim($user['un'])==trim($un)) {
                    writeToLogWhenDebug("Login: matched username");
                    if(trim($user['pw'])==trim($pw)) {
                        writeToLogWhenDebug("Login: matched password");
                        $_SESSION['pid'] = $user['id'];
                        writeToLogWhenDebug("Login session assigned pid=$id, redirecting to lobbies.php");
                        $userfound = true;
                        $_SESSION['playerName'] = $user['un'];
                        header('Location: lobbies.php');
                    }
                    else {
                        writeToLogWhenDebug("Login: password does not match " . $user['pw']);
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