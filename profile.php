<?php
    require_once '/home/nrylee1/public_html/Project2/players/playerfunctions.php';
    require_once '/home/nrylee1/public_html/Project2/logging.php';
	if(session_start()) {
        //writeToLogWhenDebug('Session started successfully.');
    } else {
        //writeToLogWhenDebug('Session failed to start.');
    }

    $player = getPlayerInfo($_SESSION['pid']);
    $_SESSION['player'] = $player;
?>
<?php    
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
    <head>
        <title>Profile Photo Upload</title>
        <link rel="Stylesheet" type="text/css" href="profile1.css"/>
    </head>
    <body>
		<header>
		<img src="TexasLogo.png" alt="Texas Hold'em"/>
		</header>

        <p>Username: <?php echo $player['un']; ?></p>
        <p>ID: <?php echo $player['id']; ?></p>
        <p>Avatar: <img src=<?php echo '"avatar/'.$player['avatar'].'"'; ?>></p>
        <p>Poker-Face: <img src=<?php echo '"pokerface/'.$player['pface'].'"'; ?>></p>

        <h2>Update Image</h2> 
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label>Upload a Selfie :</label>
            <br>
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
        </form>
        <br>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label>Upload Your Poker Face :</label>
            <br>
            <input type="file" name="file">
            <button type="submit" name="pokerface">UPLOAD</button>
        </form>
    </body>
</html>