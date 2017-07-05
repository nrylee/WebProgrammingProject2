<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    writeToLogWhenDebug('Loading lobby page');
    if(session_start()) {
        writeToLogWhenDebug('Session started successfully.');
    } else {
        writeToLogWhenDebug('Session failed to start.');                
    }
    writeToLogWhenDebug('Lobby: SessionPid' . $_SESSION['pid']);
    $pid = $_SESSION['pid'];
    if( ! isset($pid) || empty($pid)) {
        header("Location: /Project2/login.php?error=loginerror");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h4>Hello <?php $pid ?>, find a lobby and hit join!</h4>
        <div>
            <section>
                <header>Lobby 1</header>
                <a href="GameResources/play.php?gid=aAyugaL" target="_blank">Play!</a>
                <footer>Currently 0 Players</footer>
            </section>
        </div>
    </body>
</html>