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
        
  function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

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
            <link rel="stylesheet" media="all" type="text/css" href="lobbies2.css" />
    </head>
    <body>
        <h4>Hello <?php $pid ?>, find a lobby and hit join!</h4>
        <div>
            <div><a href="createGame.php">Create New Game</a></div>
            <div class = "open">
            <form method ="post" action ="lobbies2.php">
               <input type="submit" name="submit" value="Open Seat">
                </form>
                </div>
            <?php
                foreach (getGameLobbies() as $gameid => $playerList) {
                    echo "<h1>Game $gameid</h1>";
                    $count = 0;
                    foreach ($playerList as $player) {
                        echo '<div>';
                        if ($player['id']==-1) {
                            echo "<a href=\"joinGame.php?gid=$gameid&seat=$count\">Open Seat</a>";
                        }
                        else {
                            echo $player['username'];
                        }
                        echo '</div>';
                        $count++;
                    }
                }
                //$numbers = range(1, 52);
                //shuffle($numbers);

               // print_r( UniqueRandomNumbersWithinRange(1,52,13));
            ?>
        </div>
    </body>
</html>
