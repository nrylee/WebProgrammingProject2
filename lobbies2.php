<?php
   /*require_once '/home/nrylee1/public_html/Project2/logging.php';
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
    }*/
    
    function getGameLobbies() 
    /* Use this to list all current game lobbies. They will need a button to join a game if there is an open seat.
     * I will update the function later to actually pull in real games. If you need it to pull in more information, 
     * let me know. If you feel comfortable doing it, add it to this placeholder array, and I will make it function
     * properly when I replace the placeholder.
     */
    {
        $gameList = array(
            'game1id' => array(
                array(
                    'id' => 'player1id', 
                    'username' => 'player1name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                ),
                array(
                    'id' => 'player2id', 
                    'username' => 'player2name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                ),
                array(
                    'id' => 'player3id', 
                    'username' => 'player3name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                ),
                array(
                    'id' => 'player4id', 
                    'username' => 'player4name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                )
            ),
            'game2id' => array(
                array(
                    'id' => 'player1id', 
                    'username' => 'player1name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                ),
                array(
                    'id' => 'player2id', 
                    'username' => 'player2name', 
                    'avatar' =>'avatar', 
                    'pokerface' => 'pokerface'
                ),
                array(
                    'id' => -1, 
                    'username' => '', 
                    'avatar' =>'', 
                    'pokerface' => ''
                ),
                array(
                    'id' => -1, 
                    'username' => '', 
                    'avatar' =>'', 
                    'pokerface' => ''
                )
            )
        );
        return $gameList;
    }
    // foreach ($getGameLobby as $gameid => $playerInfoList) {
        
    //     foreach($lobby as $value){
    //        $i = 0;
    //         $value=lobby[i];
    //         foreach($array as $value){
    //             if($value[0]==-1){
    //                 $displayOpenLobby;//a lobby is open, display open game
    //             }
    //         }
    //     }
        
    //     for($row=0; $row < 4; $row++){
    //        if($lobby[$row][0] == -1){
    //         echo "<p><div class=\"openGame\"></div></p>";
    //         echo "<ul>";
            
               
    //        }
    //     }
        
        
    //     //list of lobbies
    //     //game id arrays
    //     //write visibilty part of the page
    //     //link to join games
    //     //display lobbies
    //     //show open games

    //     # code...
    // }
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
                <div class="openGame">
                 <a href="GameResources/play.php?gid=aAyugaL" target="_blank">Join Game!</a>
                 </div>
                <a href="GameResources/play.php?gid=aAyugaL" target="_blank">Play!</a>
                <footer>Currently 0 Players</footer>
            </section>

            <?php
                foreach (getGameLobbies() as $gameid => $playerList) {
                    echo "<h1>Game $gameid</h1>";
                    foreach ($playerList as $player) {
                        echo '<div>';
                        if ($player['id']==-1) {
                            echo 'Open Seat';
                        }
                        else {
                            echo $player['username'];
                        }
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </body>
</html>