<?php
    $expiryTime = time() - (60 * 60 * 3); // set expiry time back three hours
    $cookieKey = 'username';
    $cookieVal = 'delete';
    setcookie($cookieKey, $cookieVal, $expiryTime);
?>

<html>

    <head>
        <title>Comic books'r us login</title>
        <meta charset="UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1">
        <link rel = 'stylesheet' href = 'shopStyle.css' />
        <link rel = 'stylesheet' href = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' />
    </head>
    <body>
        <?php
            echo '<section>';
            echo '<h3 class = \'simple_text\'>';
            echo 'See you next time';
            echo '</br>';
            echo '</br>';
            echo '<a href = \'/index.php\' class = \'back_home_button btn btn-primary\'>';
            echo 'Back to the home page';
            echo '</a>';
            echo '</section>';
        ?>
    </body>

</html>