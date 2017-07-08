<?php
    require_once '/home/nrylee1/public_html/Project2/GameResources/gamefunctions.php';
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    writeToLogWhenDebug('Loading Player Action Page');
    if(session_start()) {
        writeToLogWhenDebug('Session started successfully.');
    } else {
        writeToLogWhenDebug('Session failed to start.');                
    }

    $gameData = readGame($_POST['gid']);
    $pnum = getPlayerNumber($gameData, $_SESSION['pid']);

    if ($gameData['PlayersTurn'] != $pnum) {
        header('Locaton: play.php?gid=' . $gameData['Id'] . '&errormsg=Wait%20your%20turn');
    }
    else {
        switch ($_POST['action']) {
            case 'Bet':
                if(placeBet($gameData, $_POST['BetAmount'], $pnum))
                break;
            
            default:
                # code...
                break;
        }
    }
?>