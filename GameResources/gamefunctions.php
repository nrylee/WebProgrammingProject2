<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    function readGame($gameid) {
        writeToLogWhenDebug('reading game file');
        return parse_ini_file("/home/nrylee1/public_html/Project2/games/$gameid.game");
    }  

    function generateNewGame() {

    }

    function getPlayerNumber($game, $pid) {
        switch ($pid) {
            case $game['Player1Id']:
                return 1;
            case $game['Player2Id']:
                return 2;
            case $game['Player3Id']:
                return 3;
            case $game['Player4Id']:
                return 4;
            default:
                $error = "You are not in this game!";
                writeToLogWhenDebug("Player Id($pid) not found in Game " . $game['Id']);
                return -1;
        }
    }

    function getPlayersHand($game, $playerNum) {
        $hand = array($game['Player' . $playerNum . 'Card1'], $game['Player' . $playerNum . 'Card2']);
        return $hand;
    }

    function playerIsRevealed($game, $playerNum) {
        return $game['Player' . $playerNum . 'State'] == 'Reveal';
    }

    function getPlayerPurse($game, $playerNum) {
        return $game['Player' . $playerNum . 'Purse'];
    }

    function currentGameCards($game) {
        $cards = array(
            'Flop1' => $game['Flop1'],
            'Flop2' => $game['Flop2'],
            'Flop3' => $game['Flop3'],
            'Turn'  => $game['Turn'],
            'River' => $game['River']
        );
    }
?>