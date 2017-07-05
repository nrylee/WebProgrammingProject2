<?php
    function getPlayerInfo($id) {
        $player = array(
            'id' => 0,
            'name' => 'username',
            'avatar' => '0.jpg',
            'pokerface' => '1.jpg'
        );
        return $player;
    }

    function updatePlayerInfo($player) {
    
    }

    /*
    session_start();
    $id = $_SESSION['pid'];
    $player = getPlayerInfo($id);
    $player['avatar'] = 'filename.jpg';
    updatePlayerInfo($player);

    //REDIRECTING
    header('pathtoredirect');
    */
?>