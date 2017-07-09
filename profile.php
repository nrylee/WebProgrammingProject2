<?php
    //require_once '/home/nrylee1/public_html/Project2/logging.php';
    //writeToLogWhenDebug('Loading Player Action Page');
    if(session_start()) {
        //writeToLogWhenDebug('Session started successfully.');
    } else {
        //writeToLogWhenDebug('Session failed to start.');
    }

    /*
     * The Session values below are placeholders for once its integrated,
     * but for now you can try to make the page based on these values.
     */
    $_SESSION['pid'] = 26;
    $_SESSION['pusername'] = 'ding1temp';
    $_SESSION['pavatar'] = '596186cf5f45a1.78059262.png';
    $_SESSION['ppokerface'] = '5961871d0ef943.84990936.png';


    /* The functions below don't have to be on this page, they are probably
     * on the page where you process the images. They will return true if
     * everything works as far as setting the players image, else they will be
     * false. For now they don't do anything obviously, but are here so I can
     * easily integrate them later.
     * Use them in your code once the image is uploaded to the server.
     */
    function setPlayerAvatar($pid, $imgName) {
        return true;
    }
    function setPlayerPokerFace($pid, $imgName) {
        return true;
    }
?>
<!DOCTYPE html>
<html>
<html>