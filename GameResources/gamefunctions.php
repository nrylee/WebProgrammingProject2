<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    require_once '/home/nrylee1/public_html/Project2/players/playerfunctions.php';
    function readGame($gameid) {
        writeToLogWhenDebug('reading game file');
        return parse_ini_file("/home/nrylee1/public_html/Project2/games/$gameid.game");
    }  

    function generateNewGame() {

    }
    function joinPlayerToGame()

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
    function createNewGame() {
        session_start();
        $cardList = array(
            'HA', 'H2', 'H3', 'H4', 'H5', 'H6', 'H7', 'H8', 'H9', 'H10', 'HJ', 'HQ', 'HK',
            'DA', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D10', 'DJ', 'DQ', 'DK',
            'CA', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9', 'C10', 'CJ', 'CQ', 'CK',
            'SA', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7', 'S8', 'S9', 'S10', 'SJ', 'SQ', 'SK'
        );
        $cardNums = range(0,51);
        shuffle($cardNums);
        $gameid = createGameId(16);
        $game = readGame('basegame');
        $game['Id'] = $gameid;
        $game['Player1Id'] = $_SESSION['pid'];
        $game['Player1Card1'] = $cardList[$cardNums[0]];
        $game['Player1Card2'] = $cardList[$cardNums[1]];
        $game['Player2Card1'] = $cardList[$cardNums[2]];
        $game['Player2Card2'] = $cardList[$cardNums[3]];
        $game['Player3Card1'] = $cardList[$cardNums[4]];
        $game['Player3Card2'] = $cardList[$cardNums[5]];
        $game['Player4Card1'] = $cardList[$cardNums[6]];
        $game['Player4Card2'] = $cardList[$cardNums[7]];
        $game['Flop1'] = $cardList[$cardNums[8]];
        $game['Flop2'] = $cardList[$cardNums[9]];
        $game['Flop3'] = $cardList[$cardNums[10]];
        $game['Turn'] = $cardList[$cardNums[11]];
        $game['River'] = $cardList[$cardNums[12]];
        writeGame($game);
        return $gameid;    
    }
    function createGameId($length) {
        $alphaNumeric = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $string = '';
        for ($i=0; $i < $length; $i++) { 
            $string = $string.$alphaNumeric[rand(0,61)];
        }
        return $string;
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
    function getGameLobbies()
    {
        $gameList;
        $dir_f = "/home/nrylee1/public_html/Project2/games/";
        $files = scandir($dir_f);
        foreach ($files as $filename) {
            if($filename!='.' && $filename!='..' && $filename!='basegame.game') {
                $gameid = str_replace('.game', '', $filename);
                $game = readGame($gameid);
                $p[0] = $game['Player1Id'];
                $p[1] = $game['Player2Id'];
                $p[2] = $game['Player3Id'];
                $p[3] = $game['Player4Id'];
                for ($i=0; $i < 4; $i++) { 
                    if ($p[$i] < 0) {
                        $p[$i] = array(-1,'','','','');
                    }
                    else {
                        $p[$i] = getPlayerInfo($p[$i]);
                    }
                }
                $gameList[$gameid] = $p;
            }
        }
        return $gameList;
    }
?>