<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Logged Out</title>
    </head> -->
    <?php
        // remove session and session cookie
        session_start();
        if(isset($_SESSION['username']))
        {
            $_SESSION = array();
            setcookie(session_name(), '', time() - 2592000, '/');
            session_destroy();
        }
        header('Location: landingpage.php');
        exit();
    ?> 
    <!-- <body>
        <h1>Logged Out</h1>
        <p>
            You are now logged out of the website.
        </p>
        <p>
            <a href="login_page.php">Log in</a> again.
        </p>
    </body>
</html> -->