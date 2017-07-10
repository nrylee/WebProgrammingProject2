<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    require_once '/home/nrylee1/public_html/Project2/GameResources/gamefunctions.php';
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

    

    function getGameLobbies() 
    /* Use this to list all current game lobbies. They will need a button to join a game if there is an open seat.
     * I will update the function later to actually pull in real games. If you need it to pull in more information, 
     * let me know. If you feel comfortable doing it, add it to this placeholder array, and I will make it function
     * properly when I replace the placeholder.
     */
    {
        
        $gameList = array(
            'game1id' => array(
                array('player1id', 'player1name', 'avatar', 'pokerface'),
                array('player2id', 'player2name', 'avatar', 'pokerface'),
                array('player3id', 'player3name', 'avatar', 'pokerface'),
                array('player4id', 'player4name', 'avatar', 'pokerface')
            ),
            'game2id' => array(
                array('player1id', 'player1name', 'avatar', 'pokerface'),
                array('player2id', 'player2name', 'avatar', 'pokerface'),
                array(-1, '', '', '' /* Will return -1 as playerid if empty seat  */),
                array(-1, '', '', '')
            )
        );
        return $gameList;
    }

    function getGameLobby($gameid) 
    /* Use this to build Lobby Page (lobby.php) once player joins game, but is waiting for full set of players.
     * Copy and paste to that page if you need to. 
     */
    {
        $lobby = array(
            array('player1id', 'player1name', 'avatar', 'pokerface'),
            array('player2id', 'player2name', 'avatar', 'pokerface'),
            array('player3id', 'player3name', 'avatar', 'pokerface'),
            array( -1, '', '', '')
        );
        return $lobby;
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