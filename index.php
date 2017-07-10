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

<?php
    $_SESSION['pid'] = 26;
    $_SESSION['pusername'] = 'ding1temp';
    $_SESSION['pavatar'] = '596186cf5f45a1.78059262.png';
    $_SESSION['ppokerface'] = '5961871d0ef943.84990936.png';
?>
    <p>Username: <?php echo $_SESSION['pusername']; ?></p>
    <p>ID: <?php echo $_SESSION['pid']; ?></p>
   
    <p>Avatar: <img src=<?php echo $_SESSION['pavatar']; ?>></p>
    <p>Poker-Face: <img src=<?php echo $_SESSION['ppokerface']; ?>></p>

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