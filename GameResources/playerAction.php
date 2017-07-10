<?php

    echo $_POST['betValue'];

    function foldPlayer();
    function addToPlayerPot();

    function evaluateTurn($betToMatch, $currentPlayerPurse, $currentPlayerPot, $actionTaken, $value) {
        switch ($actionTaken) {
            case 'BET':
                {
                    switch ($value) {
                        case 'value':
                            # code...
                            break;
                        case 'ALLIN' {

                        }
                        default:
                            # code...
                            break;
                    }
                }
                break;
            case 'TURN':

                break;
            default:
                # code...
                break;
        }
    }
?>