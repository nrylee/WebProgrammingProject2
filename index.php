<?php
    require_once '/home/nrylee1/public_html/Project2/logging.php';
    writeToLogWhenDebug('Accessed Index in Debug Mode');
?><!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h6><?php echo $_SERVER['DOCUMENT_ROOT']; ?>
        <h5>Please login:</h5>
        <h6>Username is your panther id (all lowercase), and your password is "password".</h6>
        <form action="http://codd.cs.gsu.edu/~nrylee1/Project2/login.php" method="POST">
            <div><input type="text" name="un" /></div>
            <div><input type="password" name="pw" /></div>
            <div><input type="submit" /></div>
        </form>
    </body>
</html>
