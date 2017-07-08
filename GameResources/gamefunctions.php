<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    function readGame($gameid) {
        writeToLogWhenDebug('reading game file');
        return parse_ini_file("/home/nrylee1/public_html/Project2/games/$gameid.game");
    }  
    function writeGame($game) {
        $id = $game['Id'];
        writeToLogWhenDebug("Writing game file $id");
        $filename = "/home/nrylee1/public_html/Project2/games/$id.game";
        if(file_exists($filename)) {
            writeToLogWhenDebug('File Found');
            if (is_writable($filename)) {
                writeToLogWhenDebug('File is writeable');
            }
            else {
                writeToLogWhenDebug('File not writeable');
            }
        }
        else {
            writeToLogWhenDebug('File Not Found');
        }
        $file = fopen($filename, 'w');
        foreach($game as $x => $x_value) {
            writeToLogWhenDebug("writing $x_value to $x ...");
            $line = "$x = $x_value \n";
            fwrite($file, $line);
        }
        writeToLogWhenDebug('finished writing');
        
        fclose($file);
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
    function placeBet($game, $bet, $pnum) {
        if($bet = "ALLIN") {
            $bet = $game["Player$pnum".'Purse'];
        }
        else if($bet > $game["Player$pnum".'Purse']) {
            return false;
        }

        $game['PotPurse'] += $bet;
        $game['Player'.$pnum.'Purse'] -= $bet;
        $game['Player'.$pnum.'CurrentBet'] += $bet;

        writeGame($game);

        return true;
    }
?>