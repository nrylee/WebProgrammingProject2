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
        <meta http-equiv="refresh" content="30">
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
                    <img class="avatar" src="smallavatar.png" /><img class="poker-face" src="biggerone" />
                    <figcaption class="player-name">P1</figcaption>
                </figure>
                <div class="player-purse">
                    <div class="purse-graphic">
                    </div>
                    <div class="purse-value">2000</div>
                </div>
                <div id="playerControls">
                    <form action="playerAction.php" method="POST">
                        <input type="hidden" name="action" value="BET" />
                        <input type="hidden" name="gid" value="$gid" />
                        <input type="submit" name="betValue" value="25" />
                        <input type="submit" name="betValue" value="50" />
                        <input type="submit" name="betValue" value="100" />    
                    </form>
                    <form>
                        <input type="hidden" name="action" value="TURN" />
                        <input type="hidden" name="gid" value="$gid" />
                        <input type="submit" name="turnType" value="Check" />
                        <input type="submit" name="turnType" value="Call" />
                        <input type="submit" name="turnType" value="Fold" />
                    </form>
                </div>
            </div>
            <?php 
                for ($player=1; $player < 4; $player++) { 
                    $fixedPlayerNumber = ($pnum + $player);
                    if($fixedPlayerNumber > 4) $fixedPlayerNumber = $fixedPlayerNumber-4;
                    echo "<!-- START PLAYER $fixedPlayerNumber -->";
                    echo '<div id="playerTwo" class="player">';
                        echo '<div class="hand">';
                            if(playerIsRevealed($gameData, $fixedPlayerNumber)) {
                                displayHand(getPlayersHand($gameData, $fixedPlayerNumber);
                            }
                            else {
                                echo '<div class="card hidden"></div><div class="card hidden"></div>';
                            }
                        echo '</div>';
                        echo '<figure class="player-info">';
                            echo '<img src="smallavatar.png" />';
                            echo '<figcaption class="player-name">P' . ($player + 1) . '</figcaption>';
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
                        <span class="purse-value">400</span>
                    </div>
                </div>
                <div id="flop">
                    <div class="card" id="S3">
                    </div>
                    <div class="card" id="DQ">
                    </div>
                    <div class="card" id="CA">
                    </div>
                </div>
                <div id="turn-river">
                    <div class="card hidden">
                    </div>
                    <div class="card hidden">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>