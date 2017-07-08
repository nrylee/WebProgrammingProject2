<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    require_once '/home/nrylee1/public_html/Project2/GameResources/gamefunctions.php';
    writeToLogWhenDebug('Loading Play Page');    
    if(session_start()) {
        writeToLogWhenDebug('Session started successfully.');
    } else {
        writeToLogWhenDebug('Session failed to start.');                
    }
    $gid = $_GET['gid'];
    if (empty($gid)) {
        header('Location: ../lobbies.php');
    }
    $gameData = readGame($_GET['gid']);
    $pnum = getPlayerNumber($gameData, $_SESSION['pid']);

    function displayHand($hand) {
        for ($i=0; $i < sizeof($hand); $i++) { 
            echo "<div class=\"card\" id=\"" . $hand[$i] . "\"></div>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Texas Hold'em</title>
        <link rel="stylesheet" media="all" type="text/css" href="main.css" />
        <link rel="stylesheet" media="all" type="text/css" href="cards.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="gameTable">
            <!-- START PLAYER ONE -->
            <div id="playerOne" class="player">
                <div class="hand">
                    <?php 
                        displayHand(getPlayersHand($gameData, $pnum));
                    ?>
                </div>
                <figure class="player-info">
                    <img src="smallavatar.png" />
                    <figcaption class="player-name">P1</figcaption>
                </figure>
                <div class="player-purse">
                    <div class="purse-graphic">
                    </div>
                    <div class="purse-value"><?php echo getPlayerPurse($gameData, $pnum); ?></div>
                    <form action="playerAction.php" method="POST">
                        <input type="hidden" name="action" value="Bet" />
                        <input type="hidden" name="gid" value=<?php echo '"'.$gameData['Id'].'"'; ?> />
                        <input type="submit" name="BetAmount" value="25" />
                        <input type="submit" name="BetAmount" value="50" />
                        <input type="submit" name="BetAmount" value="100" />
                    </form>
                </div>
                <div id="messages">
                    <div id="turnDisplay">Player <?php echo $gameData['PlayersTurn']; ?>'s Turn</div>
                    <?php
                        if ( ! empty($_GET['errormsg'])) {
                            echo '<div id="errorMsg">' . $_GET['errormsg'] . '</div>';
                        }
                    ?>    
                </div>
            </div>
            <?php 
                for ($player=2; $player < 5; $player++) { 
                    $fixedPlayerNumber = ($pnum + $player - 1);
                    if($fixedPlayerNumber > 4) $fixedPlayerNumber = $fixedPlayerNumber-4;
                    echo "<!-- START PLAYER $fixedPlayerNumber -->";
                    echo '<div id="player' . $player . '" class="player">';
                        echo '<div class="hand">';
                            if(playerIsRevealed($gameData, $fixedPlayerNumber)) {
                                displayHand(getPlayersHand($gameData, $fixedPlayerNumber));
                            }
                            else {
                                echo '<div class="card hidden"></div><div class="card hidden"></div>';
                            }
                        echo '</div>';
                        echo '<figure class="player-info">';
                            echo '<img src="smallavatar.png" />';
                            echo '<figcaption class="player-name">P' . ($player) . '</figcaption>';
                        echo '</figure>';
                        echo '<div class="player-purse">';
                            echo '<div class="purse-graphic">';
                            echo '</div>';
                            echo '<div class="purse-value">' . getPlayerPurse($gameData, $fixedPlayerNumber) . '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>

            <!-- START CARD POOL -->
            <div id="cardPool">
                <div id="deck">
                    <div class="card">
                    </div>
                    <div class="pot">
                        Pot: 
                        <span class="purse-value"><?php echo $gameData['PotPurse']; ?></span>
                    </div>
                </div>
                <div id="flop">
                    <?php
                        if($gameData['GameTurn'] > 0){
                            for ($i=1; $i < 4; $i++) { 
                                echo '<div class="card" id="' . $gameData["Flop$i"] . '"></div>';
                            }
                        }
                        else {
                            for ($i=0; $i < 3; $i++) { 
                                echo '<div class="card hidden"></div>';
                            }
                        }
                    ?>
                </div>
                <div id="turn-river">
                    <?php
                        if ($gameData['GameTurn'] > 1) {
                            echo '<div class="card" id="' . $gameData["Turn"] . '"></div>';
                        }
                        else {
                            echo '<div class="card hidden"></div>';
                        }
                        if ($gameData['GameTurn'] > 2) {
                            echo '<div class="card" id="' . $gameData["River"] . '"></div>';
                        }
                        else {
                            echo '<div class="card hidden"></div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>